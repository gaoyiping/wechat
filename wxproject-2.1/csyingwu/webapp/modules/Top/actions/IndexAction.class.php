<?php

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');
        $admin_id = $this->getContext()->getStorage()->read('_admin_id');
		$request->setAttribute('userID',$userid);
        $request->setAttribute('admin_id',$admin_id);
		return View :: INPUT;
	}

	public function execute(){

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>