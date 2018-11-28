<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class okallAction extends Action {

	public function getDefaultView() {
		return;
	}

	public function execute(){		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$ids = $request->getParameter("ids");
		$url = $_SESSION['tixian_url'];
		if($ids == ''){
			header("Content-Type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('请选择审核项！');" .
				"location.href='$url';</script>";
			return;
		}
		$ids_str = implode(',',$ids);
		$sql = "update ntb_record set status = '1',replay_date = CURRENT_TIMESTAMP " .
			"where id in ($ids_str)";
		$r = $db -> update($sql);
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

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>