<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');


class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();	
				

	    

		return View :: INPUT;
	}

	public function execute(){		
		
	}

	
	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>