<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class viewAction extends Action {

	public function getDefaultView() {
				$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sNo= $request->getParameter("sNo");
	 
		$sql = "select * " .
				"from user_cg_list where user_id = '$userid' and sNo='$sNo'";
         $r = $db->select($sql);

		 if($r)
		{
		  $sql1 = "select * " .
				"from user_cg_kucun where user_id = '$userid' and rliushui='".$sNo."'";
         $r1 = $db->select($sql1);
		 }

		 $sql2 = "select * " .
				"from ntb_user where user_id = '$userid'";
         $r2 = $db->select($sql2);
         if($r2)
		{
		   $request->setAttribute('userinfo',$r2[0]);
		 }
			
			$request->setAttribute('dingdaninfo',$r[0]);
			$request->setAttribute('list',$r1);
	
    

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