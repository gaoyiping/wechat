<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class phAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');

		$db = DBAction::getInstance();

		$sqlcmd = "SELECT COUNT(*) AS `level` FROM `ntb_user` WHERE `e_money` > (SELECT `e_money` FROM `ntb_user` WHERE `user_id`='{$userid}')";
		$result = $db->getone($sqlcmd);
		if ($result['level'] <= 40) {
			$request->setAttribute('level', $result['level']);
			$sqlcmd = "SELECT * FROM `ntb_user` WHERE `uplevel`>=2 ORDER BY `e_money` DESC LIMIT 40";
			$userlist = $db->select($sqlcmd);
			$request->setAttribute('userlist', $userlist);
		} else {
			$request->setAttribute('level', 999);
		}
		return View::INPUT;		
	}

	public function execute(){}

	public function getRequestMethods(){
		return Request::NONE;
	}
}

?>