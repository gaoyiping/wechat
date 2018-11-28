<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sessionId = session_id();

		$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$userid}'";
		$result = $db->select($sqlcmd);
		$request->setAttribute('userinfo',$result[0]);

		$sqlcmd = "DELETE FROM `ecs_cart` WHERE `user_id`='{$userid}' AND `isgroup`=1";
		$db->query($sqlcmd);

		$sqlcmd = "SELECT * FROM `ecs_cart` WHERE `user_id`='{$userid}' AND `session_id`='{$sessionId}' AND `isgroup`=0";
		$goods_data = $db->selectarray($sqlcmd);
		$request->setAttribute('goods_list',$goods_data);
		$request->setAttribute('total',count($goods_data));
		
		$sql="select sum(goods_price*goods_number) as totalmoney from ecs_cart where user_id='$userid' and session_id='$sessionId' AND `isgroup`=0";
		$data = $db->select($sql);
		$totalmoney = $data[0]->totalmoney;
		$request->setAttribute('totalmoney',$totalmoney);
		
		return View::INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request::NONE;
	}

}

?>