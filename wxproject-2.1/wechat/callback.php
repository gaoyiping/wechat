<?php

class wechatCallbackapi{

    public function valid($db){

        $echoStr = $_GET["echostr"];

        if($this -> checkSignature($db)){
            echo $echoStr;
            return true;

        }

    }

    

    public function responseMsg($db,  $base_url){

        
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        $debug = 0;

        if($_GET['debug'] == 1){

            $debug = 1;

        }

        if (!empty($postStr) or $debug == 1){

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

            $fromUsername = $postObj -> FromUserName;

            $msgType = $postObj -> MsgType;

            $toUsername = $postObj -> ToUserName;

            $keyword = trim($postObj -> Content);

            if(empty($keyword)){

                $keyword = $_GET['keyword'];

            }

            if(empty($fromUsername)){

                $fromUsername = '';

            }

            $time = time();

            $lang = array();

            $ret = $db ->getone("SELECT * FROM  ntb_user  WHERE `wxid` = '$fromUsername'");

            $setp = $ret['setp'];

            $wxname = $ret['wxname'];

            $m_ret = $db -> getone("SELECT * FROM  ecs_weixin_cfg WHERE `cfg_name` = 'murl'");

            $base_ret = $db -> getone("SELECT * FROM  ecs_weixin_cfg WHERE `cfg_name` = 'baseurl'");

            if(empty($base_ret['cfg_value'])){

                $m_url = $base_url . $m_ret['cfg_value'];

            }else{

                $m_url = $base_ret['cfg_value'] . $m_ret['cfg_value'];

                $base_url = $base_ret['cfg_value'];

            }

            /* $user_id = $ret['user_id'];

            $ret = $db ->getone("SELECT `wxid` FROM ntb_user WHERE `wxid` = '$fromUsername'");

            if(empty($ret)){

                if(!empty($fromUsername)){

                    //暂时没有推荐人

                    $db -> query("INSERT INTO ntb_user ( `wxid`) VALUES ('$fromUsername')");

                }

            } */

            $textTpl = "<xml>

                            <ToUserName><![CDATA[%s]]></ToUserName>

                            <FromUserName><![CDATA[%s]]></FromUserName>

                            <CreateTime>%s</CreateTime>

                            <MsgType><![CDATA[%s]]></MsgType>

                            <Content><![CDATA[%s]]></Content>

                            <FuncFlag>0</FuncFlag>

                            </xml>";

            $imageTpl = "<xml>

                         <ToUserName><![CDATA[%s]]></ToUserName>

                         <FromUserName><![CDATA[%s]]></FromUserName>

                         <CreateTime>%s</CreateTime>

                         <MsgType><![CDATA[%s]]></MsgType>

                         <ArticleCount>%s</ArticleCount>

                         <Articles>

                         %s

                         </Articles>

                         <FuncFlag>0</FuncFlag>

                         </xml>";

            $newsTpl = "<xml>

                         <ToUserName><![CDATA[%s]]></ToUserName>

                         <FromUserName><![CDATA[%s]]></FromUserName>

                         <CreateTime>%s</CreateTime>

                         <MsgType><![CDATA[%s]]></MsgType>

                         <ArticleCount>%s</ArticleCount>

                         <Articles>

                         %s

                         </Articles>

                         <FuncFlag>0</FuncFlag>

                         </xml>";

            

            if ($postObj->MsgType == 'event') { //第一次关注

                

                $Eventkeyword = $postObj->EventKey;

                

                if ($Eventkeyword ==''){

                    $retuser = $db -> getone( "select * from ntb_user WHERE `wxid`= '$fromUsername'");

                    $msgType = "text";

                    $lang = $db ->getone ("SELECT `lang_value` FROM ecs_weixin_lang WHERE `lang_name` = 'regmsg'");

                    $lang['regmsg'] = $lang['lang_value'];

                    if(empty($retuser)){

                        $contentgz = $lang['regmsg'];

                        

                        $ret = $db -> getone("select max(id) as userid from ntb_user ");

                        $user_id = "wrj".($ret['userid']+1);
                        
                        $headimgurl='';
                        $wxname='';
                        //获取access_token   ---------edit--------
                        $sql="select * from ecs_weixin_config where id=1";
                        $rs = $db->select($sql);
                        $appid = $rs[0]->appid;
                        $appsecret = $rs[0]->appsecret;
                        $url_access_token = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
                        $result_access_token = $this->getData_($url_access_token);
                        $jsondecode = json_decode($result_access_token);
                        if($jsondecode != null){
                            if(property_exists ( $jsondecode, "access_token" ) )
                            {
                                $access_token_ = $jsondecode->{"access_token"};
                            }
                        }
                        if(!empty($access_token_)){
                            //获取用户信息
                            $user_wecha = $this->getUser($access_token_,$fromUsername);
                            if(!empty($user_wecha)){
                                $user_wecha = explode("*",$user_wecha);
                                $headimgurl=$user_wecha[0];
                                $wxname=$user_wecha[1];
                                $sex = $user_wecha[3];
                            }
                        }
                        // --------end-----

                        $r = $db -> insert("INSERT INTO ntb_user (`user_id`,`wxid`,`headimgurl`,`wxname`,`sex`) VALUES ('$user_id','$fromUsername','$headimgurl','$wxname',$sex)");

                        
                        $contentStr = $lang['regmsg'];

                        $contentStr = str_replace("@", $ret['userid']+1,$contentStr);

                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                        echo $resultStr;

                        exit;

                    }else{

                        $contentStr = $lang['regmsg'];

                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                        echo $resultStr;

                        exit;

                    }

                }else{

                    //场景二维码

                    $Event = $postObj->Event;

                    if($Event=='subscribe' || $Event=='SCAN'){

                        $ticket = $postObj->EventKey;

                        $ticket = str_replace('qrscene_', '', $ticket);

                        $retuser = $db -> getone( "select * from ntb_user WHERE `wxid`= '$fromUsername'");

                        $msgType = "text";

                        $lang = $db ->getone ("SELECT `lang_value` FROM ecs_weixin_lang WHERE `lang_name` = 'regmsg'");

                        $lang['regmsg'] = $lang['lang_value'];

                        if(empty($retuser)){

                            

                            $contentgz = $lang['regmsg'];

                            $ret = $db ->getone("select max(id) as userid from ntb_user");

                            $user_id = "wrj".($ret['userid']+1);

                            $sql = "select * from ntb_user where id in ($ticket)";

                            $rrr = $db->getone($sql);

                            $pid =$rrr['user_id'];
                            
                            
                            $headimgurl='';
                            $wxname='';
                            //获取access_token   ---------edit--------
                            $sql="select * from ecs_weixin_config where id=1";
                            $rs = $db->select($sql);
                            $appid = $rs[0]->appid;
                            $appsecret = $rs[0]->appsecret;
                            $url_access_token = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
                            $result_access_token = $this->getData_($url_access_token);
                            $jsondecode = json_decode($result_access_token);
                            if($jsondecode != null){
                                if(property_exists ( $jsondecode, "access_token" ) )
                                {
                                    $access_token_ = $jsondecode->{"access_token"};
                                }
                            }
                            if(!empty($access_token_)){
                                //获取用户信息
                                $user_wecha = $this->getUser($access_token_,$fromUsername);
                                if(!empty($user_wecha)){
                                    $user_wecha = explode("*",$user_wecha);
                                    $headimgurl=$user_wecha[0];
                                    $wxname=$user_wecha[1];
                                    $sex = $user_wecha[3];
                                }
                            }
                            // --------end-----
                            
                            $r = $db -> insert("INSERT INTO ntb_user (`user_id`,`wxid`,`pid`,`headimgurl`,`wxname`,`sex`) VALUES ('$user_id','$fromUsername','$pid','$headimgurl','$wxname',$sex)");

                            
                            $contentStr = $lang['regmsg'];

                            $contentStr = str_replace("@", $ret['userid']+1,$contentStr);

                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                            echo $resultStr;

                            exit;

                        }else{

                            $sql = "select * from ntb_user where id in ($ticket)";
                            $rrr = $db->getone($sql);
                            $pid =$rrr['user_id'];
                            
                            if($pid!=$retuser['user_id']){

                                if($retuser['pid']!=NULL || $retuser['pid']!=''){
                                    
                                }else{
                                    $retuser = $db -> select( "select * from ntb_user where wxid='$fromUsername'");
                                    $contentgz = $lang['regmsg'];
                                    $user_id = $retuser[0]->user_id;
                                    $r = $db -> update("update ntb_user set pid ='$pid' where user_id='$user_id'");
                                }
                                
                            }

                            $contentStr = $lang['regmsg'];

                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                            echo $resultStr;

                            exit;

                        }

                    }else{

                        $keyword = $postObj->EventKey;


                    }               

                }

            }

            

            $auto_res = $db -> selectarray("SELECT * FROM  ecs_weixin_keywords ");

            if(count($auto_res) > 0){

                foreach($auto_res as $k => $v){

                    $res_ks = explode(' ', $v['keyword']);

                    if($v['type'] == 1){

                        $msgType = "text";

                        foreach($res_ks as $kk => $vv){

                            if($vv == $keyword){

                                $contentStr = $v['contents'];

                                $db -> update("UPDATE ecs_weixin_keywords SET `count` = `count`+1 WHERE `id` =$v[id]");

                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                                echo $resultStr;

                               exit;

                            }

                        }

                    }

                    if($v['type'] == 2){

                        $msgType = "news";

                        foreach($res_ks as $kk => $vv){

                            if($vv == $keyword){

                                $ArticleCount = 1;

                                $v['images'] = $base_url .'upfile/'. $v['pic'];

                                $items .= "<item>

                                 <Title><![CDATA[" . $v['pic_tit'] . "]]></Title>

                                 <Description><![CDATA[" . $v['desc'] . "]]></Description>

                                 <PicUrl><![CDATA[" . $v['images'] . "]]></PicUrl>

                                 <Url><![CDATA[" . $v['pic_url'] . "]]></Url>

                                </item>";

                                $db -> update("UPDATE ecs_weixin_keywords SET `count` = `count`+1 WHERE `id` =$v[id]");

                                $resultStr = sprintf($imageTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);

                                echo $resultStr;

                                exit;

                            }

                        }

                    }

                }

            }

            

            if($keyword == 'debug'){

                $msgType = "text";

                $contentStr = "Welcome to here!";

                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                echo $resultStr;

                exit;

            }

        }else{

            echo "";

            exit;

        }

    }

    

    

    public function curl_get_contents($url) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_TIMEOUT, 1);

        curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);

        curl_setopt($ch, CURLOPT_REFERER, _REFERER_);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);

        $r = curl_exec($ch);

        curl_close($ch);

        return $r;

    }

    

    public function curl_grab_page($url, $data, $proxy = '', $proxystatus = '', $ref_url = ''){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");

        curl_setopt($ch, CURLOPT_TIMEOUT, 40);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        if ($proxystatus == 'true'){

            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);

            curl_setopt($ch, CURLOPT_PROXY, $proxy);

        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if(!empty($ref_url)){

            curl_setopt($ch, CURLOPT_HEADER, TRUE);

            curl_setopt($ch, CURLOPT_REFERER, $ref_url);

        }

        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        ob_start();

        return curl_exec ($ch);

        ob_end_clean();

        curl_close ($ch);

        unset($ch);

    }

    

    private function checkSignature($db){

        $thistable = 'ecs_weixin_config';

        $signature = $_GET["signature"];

        $timestamp = $_GET["timestamp"];

        $nonce = $_GET["nonce"];

        $ret = $db -> getone("SELECT * FROM ecs_weixin_config WHERE `id` = 1");

        $token = $ret['token'];

        $tmpArr = array($token, $timestamp, $nonce);

        sort($tmpArr,SORT_STRING);

        $tmpStr = implode($tmpArr);

        $tmpStr = sha1($tmpStr);

        if($tmpStr == $signature){

            return true;

        }else{

            return false;

        }

    }
    
    
    //获取https的get请求结果
    function getData_($c_url)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $c_url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno'.curl_error($curl);//捕抓异常
        }
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo; // 返回数据
    }
    
    
    function https_post($url,$data = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Errno'.curl_error($ch);//捕抓异常
        }
        curl_close($ch); // 关闭CURL会话
        return $output;
    }
    
    // 获取用户信息
    function getUser($token,$openId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$token."&openid=".$openId."&lang=zh_CN";
        $result = $this->getData_($url);
        $jsondecode = json_decode($result);
        if($jsondecode != null){
            if(property_exists ( $jsondecode, "headimgurl" ) )
            {
                $headimgurl =  $jsondecode->{"headimgurl"};
            }
            if(property_exists ( $jsondecode, "nickname" ) )
            {
                $nickname =  $jsondecode->{"nickname"};
            }
            if(property_exists ( $jsondecode, "subscribe_time" ) )
            {
                $subscribe_time =  $jsondecode->{"subscribe_time"};
            }
            if(property_exists ( $jsondecode, "sex" ) )
            {
                $sex =  $jsondecode->{"sex"};
            }
            return $headimgurl."*".$nickname."*".$subscribe_time."*".$sex;
        }
    
    }

}

?>