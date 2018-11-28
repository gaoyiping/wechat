<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class syncAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$db = DBAction::getInstance();
		
		
		$sql="select * from ecs_weixin_config where id=1";
		$r = $db->select($sql);
		$appid = $r[0]->appid;
		$appsecret = $r[0]->appsecret;
		
		$sql = "select wxid from ntb_user where user_id = '$userid' ";
		$r = $db->select($sql);
		$wxid = $r[0]->wxid;
		
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
			$user_wecha = $this->getUser($access_token_,$wxid);
			if(!empty($user_wecha)){
					$user_wecha = explode("*",$user_wecha);
					$sql_="update ntb_user set headimgurl='$user_wecha[0]',wxname='$user_wecha[1]',pic=NULL,sex='$user_wecha[3]' where wxid='$wxid'";
					$db->update($sql_);
			}
		}

		header("Content-type: text/html;charset=utf-8");
		echo"<script language='javascript'>" . 
				"alert('同步成功！');" . 
				"location.href='index.php?module=index';</script>";
		return;
			
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}
	
	
	//获取微信的openid
	function GetOpenid($c_code,$appId,$ser)
	{
		 
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appId."&secret=".$ser."&code=".$c_code."&grant_type=authorization_code";
		$result = $this->getData_($url);
		$jsondecode = json_decode($result);
		if($jsondecode != null){
			if(property_exists ( $jsondecode, "openid" ) )
			{
				return $jsondecode->{"openid"};
			}else{
				return false;
			}
		}
		 
		return null;
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

}

?>