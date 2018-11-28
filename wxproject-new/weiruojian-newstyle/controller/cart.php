<?php
class cart extends spMagic {
	function index(){
		$uid = $this->get_uid();
		$cartlist = Model('Cart')->cart_list($uid);
		$this->cartlist = $cartlist;
		$this->display("cart-index.html");
	}

	function cartputin() {
		$uid = $this->get_uid();
		$pid = $this->spArgs('pid', 0);
		if ($pid) {
			$cart = Model('Cart')->find(array('uid'=> $uid, 'product'=> $pid));
			if (!$cart) {
				$sqldata = array('uid'=> $uid, 'product'=> $pid, 'product_count'=> 1);
				Model('Cart')->create($sqldata);
				exit(json_encode(1));
			}
		}
		exit(json_encode(0));
	}

	function cartcount() {
		$uid = $this->get_uid();
		$pid = $this->spArgs('pid', 0);
		$count = $this->spArgs('count', 0);
		if ($count > 0) {
			Model('Cart')->update(array('uid'=> $uid, 'product'=> $pid), array('product_count'=> $count));
			exit(json_encode(1));
		}
		exit(json_encode(0));
	}

	function cartremove() {
		$uid = $this->get_uid();
		$pid = $this->spArgs('pid', 0);
		if ($pid) {
			Model('Cart')->delete(array('uid'=> $uid, 'product'=> $pid));
			exit(json_encode(1));
		}
		exit(json_encode(0));
	}
}