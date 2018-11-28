<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
class IndexAction extends Action {
	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');

		$sqlcmd = "SELECT * FROM `ntb_user_benefit` WHERE `user_id`='{$userid}'";
		$benefit = $db->getone($sqlcmd);
		if ($benefit) {
			$request->setAttribute("benefit",$benefit);
		}
		return View::INPUT;
	}

	public function execute() {}

	public function getRequestMethods(){
		return Request::POST;
	}
}