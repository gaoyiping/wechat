<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class detailAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter("id"));
		$sql = "select * from ntc_rproducts where id = '$id'";
		$r = $db->select($sql);
		if($r){
			$rpro = $r[0];
		} else {
			$rpro = new stdClass;
		}
		$request->setAttribute("rpro",$rpro);		
		return View :: INPUT;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>