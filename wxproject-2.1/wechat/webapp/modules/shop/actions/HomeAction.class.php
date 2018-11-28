<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
class HomeAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();

		$sql="select * from ntb_const where id=1";
		$r = $db->select($sql);
		if($r){
			$request->setAttribute("system",$r[0]);
		}

		
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		$sql = "select * from ntc_type order by torder asc,tID desc ";
		$r = $db->select($sql);
		$request->setAttribute('category_data',$r);
		$request->setAttribute('category_data_count',count($r));
		$sql = "select * from ntc_rproducts order by sorder asc,id desc limit 0,20";
		$r = $db->selectarray($sql);
		$request->setAttribute('product_data',$r);
		
		$sql = "select a.* from ntb_user a where user_id='$userid' ";
		$r = $db->select($sql);
		
		$pid = $r[0]->pid;
		if($pid!=NULL){
			$sql = "select * from ntb_user  where user_id='$pid' ";
			$rr = $db->select($sql);
			$r[0]->pwxname = $rr[0]->wxname;
		}
		$request->setAttribute('user',$r[0]);
		
		
		return View :: INPUT;
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