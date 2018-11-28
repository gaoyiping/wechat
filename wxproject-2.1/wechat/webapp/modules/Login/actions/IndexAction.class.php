<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
        error_reporting(0);
		$request = $this->getContext()->getRequest();
		
		$db=DBAction::getInstance();
		$code = !empty($_GET['code']) ? $_GET['code'] : '';
		$go = !empty($_GET['go']) ? $_GET['go'] :NULL;
		$sql="select * from ecs_weixin_config where id=1";
		$r = $db->select($sql);
		$appid = $r[0]->appid;
		$appsecret = $r[0]->appsecret;
		
		//$wxid = 'oxgHDjiJJPnb0BIIyUJ-YlMnrl5Y';
		

		
		
		if(!empty($code)){
			$wxid = $this->GetOpenid($code,$appid,$appsecret);
		}else{
			$wxid = !empty($_GET['wxid']) ? $_GET['wxid'] : '';
		}
		
		
		
	
		
	
		
		
		
		if(strlen($wxid) == 28){
			
			$sql = "select * from ntb_user where wxid='$wxid'";
			$w_res = $db->select($sql);
			
			if(!empty($w_res)){
				//是否已经获取用户信息
				$w_res_edit = $w_res[0];
				
				if(empty($w_res_edit->headimgurl) || empty($w_res_edit->wxname) ){
					//获取access_token   ---------edit--------
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
							$sql_="update ntb_user set headimgurl='$user_wecha[0]',wxname='$user_wecha[1]' where wxid='$wxid'";
							$db->update($sql_);
						}
					}
					// --------end-----
				}
				
				//验证成功
				$this->getContext()->getUser()->setAuthenticated(true);
				$_SESSION['user_id'] = $w_res_edit->user_id;
				$this->getContext()->getStorage()->write('_user_id',$w_res_edit->user_id);
				$this->getContext()->getStorage()->write('_user_name',$w_res_edit->wxname);
				$_SESSION['checkpass'] = true;
				if($go=='home'){
					$this->getContext()->getController()->redirect("index.php?module=index");
				}if($go=='question'){
					$this->getContext()->getController()->redirect("index.php?module=index&action=question");
				}else{
					$this->getContext()->getController()->redirect("index.php?module=shop&cid=1");
				}
				return ;
			}else{
				$ret = $db -> getone("select max(id) as userid from ntb_user ");
				$user_id = "wrj".($ret['userid']+1);
				$db->insert("INSERT INTO ntb_user (`user_id`,`wxid`) VALUES ('$user_id','$wxid')");
				
				$sql = "select * from ntb_user where wxid='$wxid'";
				$w_res = $db->select($sql);
				
				
				//是否已经获取用户信息
				$w_res_edit = $w_res[0];
				
				 if(empty($w_res_edit->headimgurl) || empty($w_res_edit->wxname) ){
				//获取access_token   ---------edit--------
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
				$sql_="update ntb_user set headimgurl='$user_wecha[0]',wxname='$user_wecha[1]' where wxid='$wxid'";
				$db->update($sql_);
				}
				}
				// --------end-----
				}
				
				//验证成功
				$this->getContext()->getUser()->setAuthenticated(true);
				$_SESSION['user_id'] = $w_res_edit->user_id;
				$this->getContext()->getStorage()->write('_user_id',$w_res_edit->user_id);
				$this->getContext()->getStorage()->write('_user_name',$w_res_edit->wxname);
				$_SESSION['checkpass'] = true;
				if($go=='home'){
					$this->getContext()->getController()->redirect("index.php?module=index");
				}if($go=='question'){
					$this->getContext()->getController()->redirect("index.php?module=index&action=question");
				}else{
					$this->getContext()->getController()->redirect("index.php?module=shop&cid=1");
				}
				return ;
			}
		}
		
		else{
			if(empty($_SESSION['user_id']) ){
				$zhy_url= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$zhy_url=urlencode($zhy_url);
				$zhy_url= 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$zhy_url.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
				header('Location:'.$zhy_url);
			}
		
		
		}
		
		return ;
	}

	public function execute(){
		$db=DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//获取参数
		$uID = addslashes(trim(strtolower($request->getParameter("uID"))));
		$uPwd = md5(strtolower($request->getParameter("uPwd")));
		$ValiNumber = trim($request->getParameter("validateNum"));
		//验证码检查
		if (!isset($_SESSION["authnum_session"]) ||
			strtolower($_SESSION["authnum_session"]) != strtolower($ValiNumber) ){
							header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('验证码输入不正确，请重新登录！');" . 
				"location.href='index.php?module=Login';</script>";
			return ;
			
		}
		//新建SQL查询
		$sql = "select user_id,user_name,first_pwd from ntb_user where " .
			   "user_id = '$uID' and first_pwd = '$uPwd'";
		$result = $db->select($sql);
		if($result==false){
							header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('登录信息不正确，请重新登录！');" . 
				"location.href='index.php?module=Login';</script>";
			return ;
		
		}
		$_user_id = $result[0]->user_id;
		$_user_name = $result[0]->user_name;
		//验证成功
		$this->getContext()->getUser()->setAuthenticated(true); 
		$this->getContext()->getStorage()->write('_user_id',$_user_id);		
		$this->getContext()->getStorage()->write('_user_name',$_user_name);	
		

		//设置页面跳转
		//ADD BY FLY AT 2011-2-17
		//提示修改简单密码
		if (!(preg_match("/[0-9]/", strtolower($request->getParameter("uPwd"))) 
					&& preg_match("/[a-z]/", strtolower($request->getParameter("uPwd"))))) {
			$_SESSION['checkpass'] = true;
		}
		//ADD END
		$this->getContext()->getController()->redirect("index.php?module=index");
	}

	public function getRequestMethods(){
		return Request :: POST;
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
			return $headimgurl."*".$nickname."*".$subscribe_time;
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
