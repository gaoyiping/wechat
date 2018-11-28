<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class suodingAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();		
		$id = $request->getParameter('id');
		$is_suoding = $request->getParameter('is_suoding');
        $sql="update  admin_cg_danbao set bsuoding='".$is_suoding."' where bloginID='".$id."'";

		$db->update($sql);
		header("Content-type:text/html;charset=utf-8");
		echo "<script type='text/javascript'>" .
			
			"location.href='index.php?module=danbao';</script>";
		return;
	}

	public function execute(){
		return $this->getDefaultView();
	}


	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>