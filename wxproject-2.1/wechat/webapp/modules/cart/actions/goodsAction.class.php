<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class goodsAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$id = trim($request->getParameter("id"));
		$sql="select * from ntc_rproducts where id=$id";
		$goods_data = $db->selectarray($sql);
		$goods_data[0]['promote_price'] = $goods_data[0]['zhuanmaijia']*$goods_data[0]['zhekou']/100;
		$goods_data[0]['total'] = $goods_data[0]['promote_price']*$goods_data[0]['qidingnum'];
		$request->setAttribute('goods_info',$goods_data[0]);
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>