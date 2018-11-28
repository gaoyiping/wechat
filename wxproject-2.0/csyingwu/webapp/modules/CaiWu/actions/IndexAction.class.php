<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		
		$db =  DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$type = $request->getParameter('type');
		$request->setAttribute('type',$type);
		if($type == 1){
			return $this->getContext()->getController()->forward("CaiWu","list");
		}
		if($type == 2){
			return $this->getContext()->getController()->forward("CaiWu","org");
		}
		if($type == 3){
			return $this->getContext()->getController()->forward("CaiWu","retail");
		}
		return $this->getContext()->getController()->forward("CaiWu","emoney");
	}
	
	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>