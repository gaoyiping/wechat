<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$season = ceil((date('n'))/3);//当月是第几季度
       
	    $jshouci=0;
	    $sql = "select jshouci from ntb_user where user_id = '$userid' ";
		$r = $db->select($sql);
        if($r)
		{
		  $jshouci=$r[0]->jshouci;
		}

		$sql = "select emoneys from ntc_rorder where user_id = '$userid' and "
		." add_date>='".date('Y-m-d H:i:s', mktime(0, 0, 0,$season*3-3+1,1,date('Y')))."' and "
		." add_date<= '".date('Y-m-d H:i:s', mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y')))."'";
		$r = $db->select($sql);
		$money=0;
		if($r)
		{
		   foreach($r as $value)
			{
		      $money=$money+ $value->emoneys;
		   }
		}
		 
		 if($jshouci==0)
		 {
		   $money=$money-100086;
		 }
		
	     $xumoney=0;
		 $xumoney=100000-$money;
       
$request->setAttribute("jidukaishi",date('Y-m-d H:i:s', mktime(0, 0, 0,$season*3-3+1,1,date('Y'))));
$request->setAttribute("jidujieshu",date('Y-m-d H:i:s', mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'))));
       $request->setAttribute("money",$money);
         $request->setAttribute("xumoney",$xumoney);
		
	
		return View :: INPUT;
	}

	public function execute() {
		
	}

	public function getRequestMethods() {
		return Request :: NONE;
	}

}
?>