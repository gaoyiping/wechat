<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class viewAction extends Action {

	public function getDefaultView() {
				$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		$userid= $request->getParameter("userid");
	 
		$sql = "select a.*,(select p_node from ntb_user_ref b where b.node=a.user_id limit 1) as tuijian,(select G_CName from admin_cg_group s1 where s1.GroupID=a.sheng ) as s1,(select G_CName from admin_cg_group s2 where s2.GroupID=a.shi ) as s2,(select G_CName from admin_cg_group s3 where s3.GroupID=a.xian ) as s3  from ntb_user a where user_id = '$userid' ";
        $shengjistr="";
		$r2=$db->select($sql);
         if($r2)
		{
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