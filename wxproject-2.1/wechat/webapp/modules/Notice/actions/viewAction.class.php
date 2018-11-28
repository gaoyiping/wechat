<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class viewAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$id = intval($request->getParameter("id"));
		$sql = "select title,content from ntb_notice where id='$id'";
		$result = $db->select($sql);
		if($result){
			$request->setAttribute("title",$result[0]->title);
			$request->setAttribute("content",$result[0]->content);	
		}			
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>