<?php
error_reporting(0);
require_once(MO_LIB_DIR . '/DBAction.class.php');
class IndexAction extends Action {
	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();

		$userid = $this->getContext()->getStorage()->read('_user_id');

		$sqlcmd = "SELECT * FROM `ntc_rproducts` ORDER BY `id` DESC";
		$goodlist = $db->select($sqlcmd);
		$request->setAttribute('goodlist',$goodlist);
		return View::INPUT;
	}

	public function execute(){}

	public function getRequestMethods(){
		return Request::NONE;
	}
}