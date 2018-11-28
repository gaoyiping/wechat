<?php
class wechat extends spMagic {
	public function __construct() {
		spController::__construct();
	}

	private function send_welcome($mpid, $openid, $message) {
		$template = "<xml><ToUserName><![CDATA[{$openid}]]></ToUserName><FromUserName><![CDATA[{$mpid}]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[{$message}]]></Content></xml>";
		exit($template);
	}

	function index() {
		// 验证时使用
		//exit($this->spArgs("echostr"));
		$message = file_get_contents("php://input");
		if ($message) {
			$result = simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);

			$mpid = $result->ToUserName;
			$openid = $result->FromUserName;
			$type = $result->MsgType;

			if ($type == 'event') {
				if ($result->Event == "subscribe") {
					$user = $this->wx_get_user($openid);
					if ($user) {
						$this->wx_refresh($openid);
						$this->send_welcome($mpid, $openid, "欢迎回来");
					} else {
						if ($result->EventKey) {
							$code = (int)str_replace("qrscene_", '', $result->EventKey);
							$relations = $this->get_user($code);
							if ($relations) {
								$sqldata = array('wx_openid'=> $openid, 'wx_subtime'=> time(), 'wx_relation'=> $code);
							} else {
								$sqldata = array('wx_openid'=> $openid, 'wx_subtime'=> time());
							}
							$model = spClass('M_User');
							$uid = $model->create($sqldata);
							$model = spClass('M_Infomation');
							$model->create(array('uid'=> $uid));
							if ($relations) {
								$model = spClass('M_Relation');
								$count = $model->findCount("`uid`={$uid}");
								if ($count) {
									$model->delete("`uid`={$uid}");
								}
								$sqldata = array('uid'=> $uid, 'rid'=> $relations['id'], 'level'=> 1);
								$model->create($sqldata);

								$relation_list = $model->findAll("`uid`={$relations['id']}", '`level` ASC');
								if ($relation_list) {
									foreach ($relation_list as $relation) {
										$sqldata = array('uid'=> $uid, 'rid'=> $relation['rid'], 'level'=> $relation['level'] + 1);
										$model->create($sqldata);
									}
								}
							}
							$_SESSION['uid'] = $uid;
							$_SESSION['openid'] = $openid;
						} else {
							$sqldata = array('wx_openid'=> $openid, 'wx_subtime'=> time());
							$model = spClass('M_User');
							$uid = $model->create($sqldata);
							$_SESSION['uid'] = $uid;
							$_SESSION['openid'] = $user['wx_openid'];
						}
						$this->send_welcome($mpid, $openid, "欢迎关注");
					}
				}
			}
		}
		echo "";
	}
}