<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class okAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();		
		$id = $request->getParameter("id");
		$sql = "update ntb_record set status = '1',replay_date = CURRENT_TIMESTAMP " .
			"where id = '$id'";
		$r = $db -> update($sql);
		$url = $_SESSION['tixiandanbao_url'];
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