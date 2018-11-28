<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/cls_json.php');
class addtocartAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sessionId = session_id();
		$_POST['goods']=strip_tags(urldecode($_POST['goods']));
		$_POST['cp']=strip_tags(urldecode($_POST['cp']));
		
		$result = array('error' => 0, 'message' => '', 'content' => '', 'goods_id' => '');
		$json  = new JSON;
		
		if (empty($_POST['goods']))
		{
			$result['error'] = 1;
			die($json->encode($result));
		}
		
		$goods = $json->decode($_POST['goods']);
	
		if($_POST['cp']=='add_cart'){
			$result['ctype']   = 1;
		}else{
			$result['ctype']   = 0;
		}
		/* 检查：商品数量是否合法 */
		if (!is_numeric($goods->number) || intval($goods->number) <= 0)
		{
			$result['error']   = 1;
			$result['message'] = "对不起，您输入了一个非法的商品数量。";
		}
		/* 更新：购物车 */
		else
		{
			
			
			$sql = "select * from ntc_rproducts where id=".$goods->id;
			$r = $db->select($sql);
			$zhuanmaijia = $r[0]->zhuanmaijia;
			$zhekou = $r[0]->zhekou;
			$pname = $r[0]->pname;
			$goods_qiding = $r[0]->qidingnum;
			$goods_id = $r[0]->id;
			$goods_price = $r[0]->zhuanmaijia * ($r[0]->zhekou)/100;
			$goods_number = $goods->number;
			$goods_img = $r[0]->imgURL;
			$jifen = $r[0]->jifen;
			
			$sql="select * from  ecs_cart where user_id='$userid' and session_id='$sessionId' and goods_id=".$goods->id;
			$r = $db->select($sql);
			if($r){
				$sql = "update ecs_cart set goods_number=goods_number+$goods_number where user_id='$userid' and session_id='$sessionId' and goods_id=".$goods->id;
				$db->update($sql);
			}else{
				$sql = "insert into ecs_cart (user_id,session_id,goods_id,goods_name,market_price,goods_price,goods_number,goods_qiding,goods_img,pv) values('$userid','$sessionId',$goods_id,'$pname',$zhuanmaijia,$goods_price,$goods_number,$goods_qiding,'$goods_img',$jifen)";
				$db->insert($sql);
			}
			
			$result['error']   = 0;
			$result['message'] = "商品已添加到购物车！";
			
		}
		
		die($json->encode($result));
		
		return ;
	}

	public function execute(){}

	public function getRequestMethods(){
		return Request :: NONE;
	}
	
	
	

}

?>