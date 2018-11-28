<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class checkUserAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = addslashes(trim($request->getParameter('uid')));
		$type = $request->getParameter('type');
		

		$sql1 = "select bloginID from admin_cg_danbao where bloginID = '$userid'";
		$r1 = $db->select($sql1);
		//
		if($type == 'pid'){
			if($r1) {
				echo "归属店铺账号 $userid 存在 √"; 
			} else {
				echo "归属店铺账号 $userid 不存在 ×";
			}
		}

		if($type == 'uid')
		{
			if(!$r1) {
				echo "恭喜你，店铺帐号 $userid 可以使用 qq√"; 
			} else {
				echo "对不起，店铺 $userid 账号已经存在 ×";
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