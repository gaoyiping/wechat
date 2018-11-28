<?php
class M_Cart extends spModel {
	var $pk = "id";
	var $table = "user_cart";

	public function cart_clear($uid) {
		$this->delete(array('uid'=>$uid));
	}

	public function cart_list($uid, $format = 1) {
		$cartlist = $this->findAll(array('uid'=> $uid));
		if ($cartlist) {
			if ($format) {
				for ($i = 0; $i < count($cartlist); $i++) {
					$product = Model('Product')->product_get($cartlist[$i]['product']);
					$cartlist[$i]['product'] = $product;
				}
			}
			return $cartlist;
		}
		return array();
	}
}