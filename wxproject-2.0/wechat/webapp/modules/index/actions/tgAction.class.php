<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class tgAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		$db = DBAction::getInstance();
		
		//收益排名
		$sql = "select * from ntb_user where pid='$userid'  order by id desc";
		$rr = $db->select($sql);
		
		$request->setAttribute('list',$rr);
		


		
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>