<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class delAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();		
		$id = intval($request->getParameter('id'));
		$sql = "delete from  admin_cg_danbao where bID = '$id'";
		$db->delete($sql);
		header("Content-type:text/html;charset=utf-8");
		echo "<script type='text/javascript'>" .
			"alert('删除成功！');" .
			"location.href='index.php?module=danbao';</script>";
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