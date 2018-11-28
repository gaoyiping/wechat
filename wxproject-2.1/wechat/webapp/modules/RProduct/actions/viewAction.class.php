<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class viewAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$id = intval($request->getParameter("id"));
		$sql = "select * from ntc_rproducts where id='$id'";
		$result = $db->select($sql);
		if ($result) {
			$rpro  = $result[0];
			$rpro->cost = moneyFormat($rpro->cost);
		} else {
			$rpro = new stdClass;
		}
		$request->setAttribute("rpro", $rpro);
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>