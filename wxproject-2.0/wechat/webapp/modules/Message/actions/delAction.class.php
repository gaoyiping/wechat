<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class delAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();		
		$id = intval($request->getParameter('id'));
		$sql = "update ntb_message set isdu=1 where id = '$id'";
		$db->update($sql);
		header("Content-type:text/html;charset=utf-8");
		echo "<script type='text/javascript'>" .
			"alert('处理成功！');" .
			"location.href='index.php?module=Message&action=geted';</script>";
		return;
	}

	public function execute(){
		return $this->getDefaultView();
	}


	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>