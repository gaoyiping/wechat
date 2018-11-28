<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class detailAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter("id"));
		$sql = "select * from ntb_newslist where id = '$id'";
		$r = $db->select($sql);
		if($r){
			$detail = $r[0];
		}
		$request->setAttribute("detail",$detail);
		return View :: INPUT;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>