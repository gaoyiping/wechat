<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class tgAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		$db = DBAction::getInstance();
		$sqlcmd = "SELECT * FROM `ntb_user` WHERE `pid`='{$userid}' ORDER BY `id` DESC";
		$rr = $db->select($sqlcmd);
		$request->setAttribute('list',$rr);
		return View :: INPUT;
	}

	public function execute(){}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>