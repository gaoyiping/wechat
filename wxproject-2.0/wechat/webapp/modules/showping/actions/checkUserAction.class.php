<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class checkUserAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = addslashes(trim($request->getParameter('uid')));
		$type = $request->getParameter('type');
		$sql = "select user_id from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		//
		if($type == 'pid'){
			if($r) {
				echo "推荐人 $userid 存在 √"; 
			} else {
				echo "推荐人 $userid 不存在 ×";
			}
		}
		if($type == 'uid'){
			if(!$r) {
				echo "恭喜你，用户名 $userid 可以使用 √"; 
			} else {
				echo "对不起，用户名 $userid 已存在 ×";
			}
		}
		return;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>