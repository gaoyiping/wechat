<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class ok2Action extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//取得参数
		$sNo = $request->getParameter("sNo");
		
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		//总计
		$sql = "select * from ntc_rorder  where user_id='$userid' and sNo='$sNo'";
		$r = $db->select($sql);
	
		if($r)
		{
			
		  $request->setAttribute('pinfo',$r[0]);

           $sql = "select * from admin_cg_kucun  where user_id='$userid' and rliushui='$sNo'";
		   $r = $db->select($sql);
		   if($r)
		   {
		       $request->setAttribute('list',$r);
		   }
         
		}
		
		
	
		return View :: INPUT;
	}

	

	public function execute(){	
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$post_name = $request->getParameter("post_name");
		$post_tel = $request->getParameter("post_tel");
		$post_address = $request->getParameter("post_address");
		$jine = $request->getParameter("jine");
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sNo = $request->getParameter("sNo");

		$sql="update ntc_rorder set post_name='$post_name' , post_tel='$post_tel' , post_address='$post_address' where sNo='$sNo' and user_id='$userid'";
        $db->update($sql);
          header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"location.href='index.php?module=caigou&action=ok&sNo=".$sNo."&jine=".$jine."';</script>";

	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>