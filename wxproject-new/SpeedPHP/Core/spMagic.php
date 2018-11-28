<?php
class spMagic extends spController {
	public $pointdata = array(
		0=> 'point_gold',
		1=> 'point_goldx',
		2=> 'point_ddjf',
		3=> 'point_xifen',
		4=> 'point_tzq',
		5=> 'point_mxq',
		);
	public $pointindex = array(
		'point_gold'=> 0,
		'point_goldx'=> 1,
		'point_ddjf'=> 2,
		'point_xifen'=> 3,
		'point_tzq'=> 4,
		'point_mxq'=> 5,
		);

	/*
	static function Magic() {
		$name = isset($_SERVER['SERVER_NAME']) ? trim($_SERVER['SERVER_NAME']) : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "");
		if ($name) {
			$mcp1 = substr(sha1($name, false), 0, 16);
			$mcp2 = substr(sha1($name, false), 20, 36);
			$mc = strtoupper(md5($mcp1 . $mcp2));
		} else {
			$mc = strtoupper(sha1(mt_rand(10000, 99999)) . sha1(mt_rand(10000, 99999)));
		}
		if ($GLOBALS['G_SP']['MagicCode'] != $mc) {
			spError("副本未授权{$mc}");
		}
	}
	*/

	public function __construct() {
		spController::__construct();
		$openid = $this->wx_get_openid();
		if (!$openid) {
			$appid = $GLOBALS['G_SP']['Wechat_AppID'] ?? "";
			$home = $GLOBALS['G_SP']['ShopHome'] ?? "";
			$this->jump("https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$home}&response_type=code&scope=snsapi_base&state=gaoyiping#wechat_redirect");
		}
		$wxuser = $this->wx_get_user($openid);
		if (!$wxuser) {
			$this->jump("subscribe.html");
		}
		if (!$wxuser['wx_relation']) {
			$this->jump("relation.html");
		}
		isset($_SESSION['uid']) || $_SESSION['uid'] = $wxuser['id'];
		$this->htmltitle = "微信商城";
	}
	/* ============================================================================================ */
	// 框架扩展接口
	/* ============================================================================================ */
	public function logs($message) {
		file_put_contents(APP_PATH.'/tmp/logs.txt', $message . "\n", FILE_APPEND);
	}

	/* ============================================================================================ */
	// 应用扩展接口
	/* ============================================================================================ */
	// 获取用户
	public function get_user($uid) {
		$model = spClass('M_User');
		$result = $model->findBy('id', $uid);
		if ($result) {
			$result['wx_subtime_txt'] = date('Y-m-d', $result['wx_subtime']);
			$result['uplevel_txt'] = format_uplevel($result['uplevel']);
		}
		return $result;
	}

	public function get_uid() {
		if ($_SESSION['uid'] ?? 0) {
			return $_SESSION['uid'];
		}
	}
	
	/* ============================================================================================ */
	// 微信扩展接口
	/* ============================================================================================ */
	public function wx_get_openid() {
		if ($_SESSION['openid'] ?? 0) {
			return $_SESSION['openid'];
		}
		$code = $this->spArgs("code");
		$state = $this->spArgs("state");
		if ($state && $state == "gaoyiping") {
			$appid = $GLOBALS['G_SP']['Wechat_AppID'] ?? "";
			$appsecret = $GLOBALS['G_SP']['Wechat_AppSecret'] ?? "";
			$result = spSuperGet("https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appsecret}&code={$code}&grant_type=authorization_code");
			$result = json_decode($result, true);
			if (isset($result['openid'])) {
				$_SESSION['openid'] = $result['openid'];
				return $result['openid'];
			}
			return false;
		}
		return false;
	}

	public function wx_get_user($openid) {
		$model = spClass('M_WXUser');
		$result = $model->findBy('wx_openid', $openid);
		if ($result) {
			$result['wx_subtime_txt'] = date('Y-m-d', $result['wx_subtime']);
			$result['uplevel_txt'] = format_uplevel($result['uplevel']);
		}
		return $result;
	}

	public function wx_get_token() {
		$timestamp = time();
		$model = spClass('M_Token');
		$token = $model->find("`token_type`=0 AND `token_valid`>{$timestamp}");
		if ($token) {
			return $token['token_value'];
		} else {
			$model->delete("`token_type`=0");
			$sqldata = array('token_value'=> '', 'token_type'=> 0, 'token_valid'=> $timestamp + mt_rand(7080, 7140));
			$sid = $model->create($sqldata);

			$appid = $GLOBALS['G_SP']['Wechat_AppID'] ?? "";
			$appsecret = $GLOBALS['G_SP']['Wechat_AppSecret'] ?? "";
			$result = spSuperGet("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}");
			$result = json_decode($result, true);
			if (isset($result['access_token'])) {
				$model->updateField("`id`={$sid}", 'token_value', $result['access_token']);
				return $result['access_token'];
			}
			$model->delete("`token_type`=0");
			return "";
		}
	}

	public function wx_get_jstoken() {
		$timestamp = time();
		$model = spClass('M_Token');
		$token = $model->find("`token_type`=1 AND `token_valid`>{$timestamp}");
		if ($token) {
			return $token['token_value'];
		} else {
			$model->delete("`token_type`=1");
			$sqldata = array('token_value'=> '', 'token_type'=> 1, 'token_valid'=> $timestamp + mt_rand(7080, 7140));
			$sid = $model->create($sqldata);

			$token = $this->wx_get_token();
			if ($token) {
				$result = spSuperGet("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$token}&type=jsapi");
				$result = json_decode($result, true);
				if (isset($result['errcode']) && $result['errcode'] == 0) {
					$model->updateField("`id`={$sid}", 'token_value', $result['ticket']);
					return $result['ticket'];
				}
				$model->delete("`token_type`=1");
			}
			return "";			
		}
	}

	public function wx_refresh($openid) {
		$token = $this->wx_get_token();
		$timestamp = time();
		if ($token && ($_SESSION['WX_REFRESH'] ?? 0) + 3600 < $timestamp) {
			$result = spSuperGet("https://api.weixin.qq.com/cgi-bin/user/info?access_token={$token}&openid={$openid}&lang=zh_CN");
			$result = json_decode($result, true);
			if (isset($result['openid'])) {
				if (substr($result['headimgurl'], -2) == '/0') {
					$result['headimgurl'] = str_replace('/0', '/132', $result['headimgurl']);
				}
				$sqldata = array('wx_name'=> $result['nickname'], 'wx_headimage'=> $result['headimgurl']);
				Model('User')->update("`wx_openid`='{$openid}'", $sqldata);
				$_SESSION['WX_REFRESH'] = $timestamp;
				return $result;
			}
		}
		return false;
	}
}

/*
if (!isset($GLOBALS['G_SP']['MagicCode']) || !file_exists(APP_PATH . "/" . $GLOBALS['G_SP']['MagicCode'])) {
	spError("未能找到名为：MagicCode文件");
}
spMagic::Magic();
*/