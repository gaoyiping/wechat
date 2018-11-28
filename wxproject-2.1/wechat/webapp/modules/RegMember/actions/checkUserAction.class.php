<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class checkUserAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = addslashes(trim($request->getParameter('uid')));
		$type = $request->getParameter('type');
		$sql = "select * from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		//**********************会员开卡
		
		if($r) {
				echo "1[!]".$r[0]->wxname."[!]".$r[0]->headimgurl;
		} else {
				echo "2[!]";
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