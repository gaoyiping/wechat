<?php

class IndexAction extends Action {

	public function getDefaultView() {
				$request = $this->getContext()->getRequest();
					$dianputype = $this->getContext()->getStorage()->read('_dianputype');

						$request->setAttribute("dianputype",$dianputype);
		return View :: INPUT;
		
	}

	public function execute(){

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>