<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class checkdianpuAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = addslashes(trim($request->getParameter('uid')));
		
		

		$sql1 = "select bloginID from admin_cg_danbao where bloginID = '$userid'";
		$r1 = $db->select($sql1);

			if(!$r1) {
				echo "归属店铺帐号 $userid 可不存在 ×"; 
			} else {
				echo "归属店铺帐号 $userid 正确 √";
			}
		
		
		return;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>