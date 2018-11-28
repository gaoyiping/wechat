<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class ajaxAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = addslashes(trim($request->getParameter('id')));
		$type = $request->getParameter('type');
		$sql = "select permission from ntb_admin where admin_id = '$userid'";
		$r = $db->select($sql);
		echo json_encode(unserialize($r[0]->permission));
		return;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>