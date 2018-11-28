<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/cls_json.php');
class updateAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sessionId = session_id();
		$rec_id = $_GET['rec_id'];
		$number = $_GET['number'];
		$goods_id = $_GET['goods_id'];
		
		
		
		$sql = "update ecs_cart set goods_number=$number where user_id='$userid' and session_id='$sessionId' and goods_id=".$goods_id;
		$db->update($sql);
			
		$sql="select sum(goods_price*goods_number) as totalmoney from ecs_cart where user_id='$userid' and session_id='$sessionId'";
		$data = $db->select($sql);
		$totalmoney = $data[0]->totalmoney;
		
		$result['error']   = 0;
		$result['cart_amount_desc'] = $totalmoney;
		
		$json  = new JSON;
		die($json->encode($result));
		
		return ;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}
	
	
	

}

?>