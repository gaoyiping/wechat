<?php

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		return View :: INPUT;
	}

	public function execute(){

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>