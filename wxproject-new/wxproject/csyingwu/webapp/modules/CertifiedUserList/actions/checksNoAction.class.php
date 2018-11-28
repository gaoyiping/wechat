<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class checksNoAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$sNo = trim($request->getParameter('sNo'));
		
		$sql = "select user_id from ntb_user where idno = '$sNo'";
		$r = $db->select($sql);


			if(!$r) {
				echo "1|"; 
			} else {
				echo "0|";
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