<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/cls_json.php');
class addgroupAction extends Action {
	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$pid = (int)$_POST['goods'];
		$session_id = session_id();
		$sqlcmd = "SELECT * FROM `ntc_rproducts` WHERE `id`={$pid} AND `isgroup`=1";
		$goods = $db->getone($sqlcmd);
		$sqlcmd = "INSERT INTO `ecs_cart` (`user_id`, `session_id`, `goods_id`, `goods_name`, `goods_price`, `goods_number`, `pv`, `isgroup`, `iscount`) VALUES ('{$userid}', '{$session_id}', {$pid}, '{$goods['pname']}', {$goods['zhuanmaijia']}, 1, {$goods['jifen']}, 1, {$goods['iscount']})";
		$db->insert($sqlcmd);
		exit(json_encode(1));
	}

	public function execute(){}

	public function getRequestMethods(){
		return Request::NONE;
	}
}