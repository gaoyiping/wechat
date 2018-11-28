<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class newsAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$user_name = $this->getContext()->getStorage()->read('_user_name');
				
		$db = DBAction::getInstance();

		$id = intval($request->getParameter("id"));
		//详情
		$sql = "select * from ntb_notice where id=$id";
		$r = $db->select($sql);
		
		$request->setAttribute("notice",$r[0]);

		
		return View :: INPUT;
	}
	
	

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>