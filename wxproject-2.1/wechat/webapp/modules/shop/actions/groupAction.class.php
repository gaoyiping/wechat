<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class groupAction extends Action {
	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$pid = $request->getParameter("id");
		$sqlcmd = "SELECT * FROM `ntc_rproducts` WHERE `id`={$pid} AND `isgroup`=1";
		$goods = $db->select($sqlcmd);
		
		$sqlcmd = "UPDATE `ntc_rproducts` SET `click`=`click`+1 WHERE `id`={$pid} AND `isgroup`=1";
		$db->update($sqlcmd);
		
		$request->setAttribute('goods',$goods[0]);
		return View::INPUT;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request::NONE;
	}

}

?>