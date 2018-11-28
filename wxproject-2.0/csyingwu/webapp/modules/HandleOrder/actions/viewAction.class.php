<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class viewAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//取得参数
		$sNo = $request->getParameter("sNo");
		
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		//总计

		$sql = "select a.*,(select G_CName from admin_cg_group s1 where s1.GroupID=a.sheng ) as s1,(select G_CName from admin_cg_group s2 where s2.GroupID=a.shi ) as s2,(select G_CName from admin_cg_group s3 where s3.GroupID=a.xian ) as s3 from ntc_rorder as a where sNo='$sNo'";
		
		$r = $db->select($sql);
	
		if($r)
		{
			$dianpu = $r[0]->dianpu;
			$sql = "select a.*,(select G_CName from admin_cg_group s1 where s1.GroupID=a.sheng ) as s1,(select G_CName from admin_cg_group s2 where s2.GroupID=a.shi ) as s2,(select G_CName from admin_cg_group s3 where s3.GroupID=a.xian ) as s3 from ntb_user a where a.user_id='$dianpu'";
			$rr = $db->select($sql);
			
		  $request->setAttribute('pinfo',$r[0]);
		  
           $sql = "select * from admin_cg_kucun  where  rliushui='$sNo'";
		   $r = $db->select($sql);
		   if($r)
		   {
			   $request->setAttribute('num',count($r));
		       $request->setAttribute('list',$r);
		   }
         
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