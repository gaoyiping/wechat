<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class confirmAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$id = $request->getParameter("id");
		$sNo= $request->getParameter("sNo");
		$sql = "update ntc_rorder set status = '2',qianshou_date = CURRENT_TIMESTAMP " .
			"where sNo = '$sNo'";
       		 $r = $db -> update($sql);
			
			
			$sql1 = "update user_cg_kucun set qianshou = '1' " .
			"where user_id = '$userid' and rliushui='$sNo'";

             $r1 = $db -> update($sql1);
	
		$url = $_SESSION['handleretail_url'];
		if($r == -1){
			header("Content-Type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，签收失败！');" .
				"location.href='$url';</script>";
		}else{
			header("Content-Type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('签收成功！');" .
				"location.href='$url';</script>";
		}
		return;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>