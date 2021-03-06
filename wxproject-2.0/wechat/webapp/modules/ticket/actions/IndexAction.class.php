<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $request->getParameter("userid");
		//$userid = $this->getContext()->getStorage()->read('_user_id');
		$db = DBAction::getInstance();
		$sql="select * from ecs_weixin_config where id=1";
		$r = $db->select($sql);
		$appid = $r[0]->appid;
		$appsecret = $r[0]->appsecret;
		//gQEl8ToAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL0xIVUJrLTNtVHY4M1BpWmhjVm1CAAIEUa2bVAMEAAAAAA==

		$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='$userid'";
		$user = $db->getone($sqlcmd);
		if ($user && $user['uplevel'] > 0) {
		} else {
			header('Content-Type: text/html;charset=utf-8');
			exit('<script type="text/javascript">alert("请先购买一款产品，才能生成你的推广二维码！");location.href="index.php?module=shop";</script>');
		}


		$sql = "select * from ntb_user where user_id='$userid'";
		$tickets = $db->select($sql);
		$pic = $tickets[0]->pic;
		$uid = $tickets[0]->id;
		$headimgurl = $tickets[0]->headimgurl;
		$wxname = $tickets[0]->wxname;
		if(empty($pic) || $pic==NULL){
			
			$qrcode = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$uid.'}}}';
			//获取access_token   ---------edit--------
			$url_token = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
			$result_access_token = $this->getData_($url_token);
			$jsondecode = json_decode($result_access_token);
			if($jsondecode != null){
				if(property_exists ( $jsondecode, "access_token" ) )
				{
					$access_token_ = $jsondecode->{"access_token"};
				}
			}
			if(!empty($access_token_)){
				$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token_;
				$result = $this->https_post($url,$qrcode);
				$jsoninfo = json_decode($result);
				$ticket = $jsoninfo->{"ticket"};
				if($ticket){
					$imgurl = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$ticket;
					//设置保存后的文件名
					$filename = time().rand(0,9).'.jpg';
					
					$ch = curl_init ();
					curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
					curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
					curl_setopt ( $ch, CURLOPT_URL, $imgurl );
					ob_start ();
					curl_exec ( $ch );
					$file = ob_get_contents ();
					ob_end_clean ();
					
					//设置文件保存路径
					$dirName = './picture/';
					
					if(!file_exists($dirName)){
						mkdir($dirName, 0777, true);
					}
					//保存文件
					$res = fopen($dirName.$filename,'a');
					fwrite($res,$file);
					fclose($res);
					
					//组合图片
					$headfilename = time().rand(0,9).'.jpg';
						
					$ch = curl_init ();
					curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
					curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
					curl_setopt ( $ch, CURLOPT_URL, $headimgurl );
					ob_start ();
					curl_exec ( $ch );
					$headfile = ob_get_contents ();
					ob_end_clean ();
						
					//设置文件保存路径
					$dirName = './picture/';
						
					if(!file_exists($dirName)){
						mkdir($dirName, 0777, true);
					}
					//保存文件
					$res = fopen($dirName.$headfilename,'a');
					fwrite($res,$headfile);
					fclose($res);
					
					
					$dest = imagecreatefromjpeg('./picture/bk.jpg');
					$src = imagecreatefromjpeg($dirName.$filename);
					$image=imagecreatetruecolor(281, 281);
					imagecopyresampled($image, $src, 0, 0, 0, 0, 281, 281, 430,430);
					imagecopymerge($dest, $image,144, 442, 0, 0, 281, 281, 100);
					
					$tou = imagecreatefromjpeg($dirName.$headfilename);
					
					list($width, $height, $type, $attr) = getimagesize($dirName.$headfilename);
					$image=imagecreatetruecolor(84, 84);
					imagecopyresampled($image, $tou, 0, 0, 0, 0, 84, 84, $width,$height);
					imagecopymerge($dest, $image,97, 67, 0, 0, 84, 84, 100);
					
					$black = imagecolorallocate($dest,255, 255, 255 );
					
					
					$instring = $wxname;
					//header("Content-type: image/jpeg");
					$font = ($_SERVER['DOCUMENT_ROOT']).'/wechat/picture/SIMHEI.TTF';
					imagettftext($dest, 20, 360, 298, 98, $black, $font, $instring);
					//imagejpeg($dest);
					//exit;
					
					$pic = time().rand(0,9).'best.jpg';
					imagejpeg($dest,$dirName.$pic);
					
					
				}else{
					$pic = 1;
						
				}
		
				$sql = "update ntb_user set pic='$pic' where user_id='$userid'";
				$db->update($sql);
			}else{
				$pic = 1;
			}
		}
		
		$request->setAttribute('img',$pic);
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}
	
	//获取https的get请求结果
	function getData_($c_url)
	{
		$curl = curl_init(); // 启动一个CURL会话
		curl_setopt($curl, CURLOPT_URL, $c_url); // 要访问的地址
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
		//curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
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
		//curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
	
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