<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');





class okAction extends Action {

	public function getDefaultView() {

		$request = $this->getContext()->getRequest();
		$id = $request->getParameter("id");
		
		$db = DBAction::getInstance();
		$sql = "select *  from ntc_rproducts where  id= $id";
		$r = $db->select($sql);
		
		$zhekou =$r[0]->zhekou;
		$r[0]->zhekou =($r[0]->zhuanmaijia)*($zhekou/100);
		
	    $request->setAttribute('pingzheng', $r[0]);
				
		return View :: INPUT;
	}
 

	public function execute(){
	
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>