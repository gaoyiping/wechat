<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();

		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$request->setAttribute('userID',$userid);
	


		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>