<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class okAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();		
		$id = $request->getParameter("id");
		$sql = "update ntb_tuan set status = '1',replay_date = CURRENT_TIMESTAMP " .
			"where id = '$id'";
		$r = $db -> update($sql);
		
		$sql = "select * from ntb_tuan where id = $id";
		$r = $db -> select($sql);
		$userid = $r[0]->operation;
		$amount =  $r[0]->amount;
		$name =  $r[0]->name;
		
		$sql = "select * from ntb_user_ref where node = '$userid'";
		$r = $db->select($sql);
		$tuanpid = $r[0]->tuanpid;
		$lt = $r[0]->lt;
		$rt = $r[0]->rt;
		$level = $r[0]->level;
		$level6 = $level+1;
		$level31 = $level+2;
		
		if($amount==6){
			$sql = "update ntb_user_ref set tuanpid = '$userid' where p_node = '$userid'";
			$r = $db -> update($sql);
			
			$sql = "update ntb_user_ref set tuanpid = '$userid',tuan=$amount,tuanname='$name' where node = '$userid'";
			$r = $db -> update($sql);
		}else{
			
			$sql = "update ntb_user_ref set tuanpid = '$userid' where lt>=$lt and rt<=$rt and level<=$level31";
			$r = $db -> update($sql);
			
			$sql = "update ntb_user_ref set tuanpid = '$userid',tuan=$amount,tuanname='$name' where node = '$userid'";
			$r = $db -> update($sql);
		}
		
		$url = $_SESSION['tuan_url'];
		if($r == -1){
			header("Content-Type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，审核失败！');" .
				"location.href='$url';</script>";
		}else{
			header("Content-Type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('审核成功！');" .
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