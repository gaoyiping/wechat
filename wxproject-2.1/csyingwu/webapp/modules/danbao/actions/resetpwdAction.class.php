<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class resetpwdAction extends Action {

	public function getDefaultView() {
		return;
	}

	public function execute() {	
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//EDIT BY MOX for anti sql inject leaks 2011.8.16		
		$userid = $request->getParameter("bloginID");
	
	
		$pwd = md5('111111');
		$sql = "update admin_cg_danbao set ";
		
		
			$sql .= "bloginpwd = '$pwd'";
		
		
		$sql .= "where bloginID = '$userid'";
		
		$r = $db->update($sql);
		$url = "index.php?module=danbao";
		if($r == -1){
			header("Content-Type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('未知原因，重设密码失败！');" . 
				"location.href='$url';</script>";
		} else {
			header("Content-Type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('重设密码成功！');" . 
				"location.href='$url';</script>";
		}
		return;
	}

	public function getRequestMethods() {
		return Request :: POST;
	}
 
}

?>