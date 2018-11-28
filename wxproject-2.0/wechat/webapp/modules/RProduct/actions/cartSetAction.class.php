<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Cart.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class cartSetAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$do = trim($request->getParameter("do")) or $do = "none";

		//初始化 零售车
		$cart = $this->getContext()->getStorage()->read('_cart');
		if ($cart == null) {
			$userid = $this->getContext()->getStorage()->read('_user_id');
			$cart = new Cart($userid);
			$this->getContext()->getStorage()->write('_cart', $cart);
		}
		
		$result = array('result' => false); 
		$method = "cart_$do";
		if (method_exists($this, $method)) {
			$result = $this->$method($cart, $request->getParameters(), $result);
		}

		echo json_encode($result);
		exit;
	}

	function cart_count($cart){
		$counts = 0;
		$moneys = 0.0;
		foreach ($cart->rpros as $value) {
			$value->money = round($value->cost * $value->count, 2);
			$value->cost = moneyFormat($value->cost);
			$value->money = moneyFormat($value->money);
			$counts += $value->count;
			$moneys += $value->money;
		}
		$cart->base['counts'] = "$counts";
		$cart->base['moneys'] = moneyFormat(round($moneys, 2));
		$cart->base['emoneys'] = round($cart->base['moneys'], 0);		
	}

	function cart_add($cart, $params, $result){
		$id = isset($params['id']) ? intval($params['id']) : 0;
		if ( !isset($cart->rpros[$id])) {
			$db = DBAction::getInstance();
			$sql = "select id, pname, cost, 1 count, cost money, 0 withinfo " .
				"from ntc_rproducts " .
				"where id = '$id' and is_del = '0'";
			$r = $db->select($sql);
			if ($r) {
				$cart->rpros[$id] = $r[0];
				$this->cart_count($cart);
			} else {
				$result['result'] = false;
				return $result;
			}
		}
		$result['result'] = true;
		$result['base'] = $cart->base;
		$result['rpro'] = $cart->rpros[$id];
		return $result ;
	}

	function cart_update($cart, $params, $result){
		$id = isset($params['id']) ? intval($params['id']) : '0';
		$count = isset($params['count']) ? intval($params['count']) : '1';
		if ( !isset($cart->rpros[$id])) {
			$result['result'] = false ;
			return $result ;
		}
		$cart->rpros[$id]->count = $count;
		$this->cart_count($cart);
		$result['result'] = true;
		$result['base'] = $cart->base;
		$result['rpro'] = $cart->rpros[$id];
		return $result ;
	}

	function cart_withinfo($cart, $params, $r){
		$id = isset($params['id']) ? intval($params['id']) : '0';
		$withinfo = isset($params['withinfo']) ? intval($params['withinfo']) : '0';
		if ( !isset($cart->rpros[$id])) {
			$result['result'] = false ;
			return $result ;
		}
		$cart->rpros[$id]->withinfo = $withinfo;
		$result['result'] = true;
		return $result ;
	}

	function cart_del($cart, $params, $r){
		$id = isset($params['id']) ? intval($params['id']) : '0';
		unset($cart->rpros[$id]);
		$this->cart_count($cart);
		$result['result'] = true;
		$result['base'] = $cart->base;
		return $result ;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>