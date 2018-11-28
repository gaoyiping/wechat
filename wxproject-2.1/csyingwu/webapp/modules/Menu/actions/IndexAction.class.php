<?php

class IndexAction extends Action {

	public function getDefaultView() {
		
		$request = $this->getContext()->getRequest();	
		$admin_atype = $this->getContext()->getStorage()->read('_admin_atype');
		$admin_id = $this->getContext()->getStorage()->read('_admin_id');
		$request->setAttribute("admin_atype",$admin_atype);
		$request->setAttribute("admin_id",$admin_id);
		return View :: INPUT;
	}

	public function execute(){

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>