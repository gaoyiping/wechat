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
		$sql = "select * from user_weitongguo  where   sNo='$sNo'";
		$r = $db->select($sql);
	
		if($r)
		{
			
		  $request->setAttribute('pinfo',$r[0]);

           $sql = "select * from user_weitongguo_list  where  rliushui='$sNo'";
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