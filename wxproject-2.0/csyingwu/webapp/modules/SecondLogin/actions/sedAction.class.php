<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class sedAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$adminid = $this->getContext()->getStorage()->read('_admin_id');
		//二级密码
		$sedpwd = md5(strtolower($request->getParameter('spwd')));
		//查询
		$sql = "select admin_id from ntb_admin where admin_id = '$adminid' " .
			"and second_pwd = '$sedpwd'";
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