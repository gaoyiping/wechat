<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class viewAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$id = intval($request->getParameter("id"));
		$sql = "select * from ntb_user where id='$id'";
		$result = $db->select($sql);
		if($result){
			$request->setAttribute("user_id",$result[0]->user_id);
			$request->setAttribute("add_date",$result[0]->add_date);	
			$request->setAttribute("user_name",$result[0]->user_name);
			$request->setAttribute("address",$result[0]->address);	
			$request->setAttribute("e_mail",$result[0]->e_mail);
			$request->setAttribute("mobile",$result[0]->mobile);	
			$request->setAttribute("tel",$result[0]->tel);
		
		}			
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>