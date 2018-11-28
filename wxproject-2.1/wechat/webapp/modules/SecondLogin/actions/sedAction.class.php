<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class sedAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		return View :: INPUT;
	}

	public function execute() {	
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$spwd = md5(strtolower($request->getParameter("spwd")));
		$sql = "select id from ntb_user where user_id = '$userid' and second_pwd = '$spwd'";
		$r = $db->select($sql);
		if(!$r){
			$request->setError("error","你输入的二級密码有误，请重新输入！");	
			return View :: INPUT;
		}
		//确定过滤完成
		$_SESSION['_sed_module']['value'] = 'on';
		$_SESSION['_sed_action']['value'] = 'on';
		$this->getContext()->getController()->redirect($_SESSION['_sed_url']);
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>