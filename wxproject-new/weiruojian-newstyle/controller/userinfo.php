<?php
class userinfo extends spMagic {
	function index(){
		$openid = $this->wx_get_openid();
		$this->wx_refresh($openid);

		$uid = $this->get_uid();
		$user = $this->get_user($uid);
		$user['point_ddjf'] += Model('RecordPoint')->get_ddjf($uid);
		$user['point_xifen'] += Model('RecordPoint')->get_xifen($uid);
		$this->user = $user;
		$this->display("userinfo.html");
	}

	private function create_qrcode($uid, $fullpath, $validtime = 604800) {
		$timestamp = time();
		if ($validtime > 0) {
			$postdata = array('expire_seconds'=> $validtime, 'action_name'=> 'QR_SCENE', 'action_info'=> array('scene'=> array('scene_id'=> $uid)));
		} else {
			//$postdata = array('action_name'=> 'QR_LIMIT_SCENE', 'action_info'=> array('scene'=> array('scene_id'=> $uid)));
		}
		$token = $this->wx_get_token();
		$result = spSuperPost("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$token}", json_encode($postdata));
		$result = json_decode($result, true);
		if ($result['ticket'] ?? 0) {
			$code = urlencode($result['ticket']);
			file_put_contents($fullpath, spSuperGet("https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={$code}"));
			$qrcode = imagecreatefromjpeg($fullpath);
			$user = $this->get_user($uid);
			$headname = sprintf($GLOBALS['G_SP']['HEAD_FILE'] ?? "", $user['id'], md5('QR'. $user['id']));
			$headpath = "QRI/" . $headname;
			file_put_contents($headpath, spSuperGet($user['wx_headimage']));
			$image_head = imagecreatefromjpeg($headpath);
			$background = imagecreatefromjpeg("QRI/background.jpg");
			imagecopyresampled($background, $image_head, 120, 135, 0, 0, 64, 64, imagesx($image_head) , imagesy($image_head));
			imagecopyresampled($background, $qrcode, 128, 445, 0, 0 , 320, 320, imagesx($qrcode) , imagesy($qrcode));
			imagettftext($background, 20, 0, 283, 161, imagecolorallocate($background, 0, 0, 0), "QRI/microhei.ttf", $user['wx_name']);
			imagejpeg($background, $fullpath, 90);
		}
	}

	function qrcode() {
		$timestamp = time();
		$uid = $this->get_uid();
		$filename = sprintf($GLOBALS['G_SP']['QR_FILE'] ?? "", $uid, md5('QR'. $uid));
		$fullpath = "QRI/" . $filename;
		$qrcode = Model('QRCode')->find(array('uid'=> $uid));
		if ($qrcode) {
			if ($qrcode['validtime'] < 0 || $qrcode['validtime'] > $timestamp) {
				$this->validtime = '';
				$this->fullpath = $fullpath;
				$this->display("qrcode.html");
			} else {
				$this->create_qrcode($uid, $fullpath);
				Model('QRCode')->updateField("`uid`={$uid}", 'validtime', $timestamp + 601200);
				$this->validtime = date("Y-m-d H:i", $timestamp + 601200);
				$this->fullpath = $fullpath;
				$this->display("qrcode.html");
			}
		} else {
			$this->create_qrcode($uid, $fullpath);
			$this->validtime = $timestamp + 601200;
			$sqldata = array('uid'=> $uid, 'validtime'=> $timestamp + 601200);
			Model('QRCode')->create($sqldata);
			$this->validtime = date("Y-m-d H:i", $timestamp + 601200);
			$this->fullpath = $fullpath;
			$this->display("qrcode.html");
		}
	}

	function mailaddress() {
		$uid = $this->get_uid();
		$this->info = Model('Infomation')->find("`uid`={$uid}");
		$this->display("userinfo-mailaddress.html");
	}

	function setmailaddress() {
		$uid = $this->get_uid();
		$people = $this->spArgs('people');
		$cellphone = $this->spArgs('cellphone');
		$address = $this->spArgs('address');
		Model('Infomation')->update(array('uid'=> $uid), array('mail_people'=> $people, 'mail_cellphone'=> $cellphone, 'mail_address'=> $address));
		$this->jump(spUrl('userinfo', 'infolist'));
	}

	function infolist() {
		$uid = $this->get_uid();
		$this->userinfo = Model('Infomation')->find("`uid`={$uid}");
		$this->display("userinfo-infolist.html");
	}
}