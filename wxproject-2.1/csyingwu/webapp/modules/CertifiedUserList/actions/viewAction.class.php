<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class viewAction extends Action {

	public function getDefaultView() {
				$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		$userid= $request->getParameter("userid");
	 
		$sql = "select * from ntb_user where user_id = '$userid' ";
		$r2=$db->select($sql);
		if($r2) {
			$request->setAttribute('userinfo',$r2[0]);
		}
		return View :: INPUT;
	}

	public function execute() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		


		return View :: INPUT;
	}




	public function getRequestMethods() {
		return Request :: POST;
	}

}

?>