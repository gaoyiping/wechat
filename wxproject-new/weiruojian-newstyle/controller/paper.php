<?php
class paper extends spMagic {
	function index() {
		$timestamp = time();
		$uid = $this->get_uid();
		$paperlist = array();
		$resultlist = Model('Paper')->findAll("`uid`={$uid}", "`paper_time` DESC");
		foreach ($resultlist as $result) {
			if ($result['paper_status'] == 0 && $timestamp - $result['paper_time'] > 1200) {
				Model('Paper')->delete("`id`='{$result['id']}'");
				Model('PaperProduct')->delete("`paper`='{$result['id']}'");
				continue;
			}
			$productlist = array();
			$paperinfo = Model('PaperProduct')->findAll("`paper`='{$result['id']}'");
			foreach ($paperinfo as $info) {
				$product = Model('Product')->find("`id`={$info['product']}");
				$product['product_count'] = $info['product_count'];
				$productlist[] = $product;
			}
			$result['product'] = $productlist;
			if ($result['paper_status'] == 0) {
				$result['paper_status_txt'] = '未支付';
			}
			if ($result['paper_status'] == 1) {
				$result['paper_status_txt'] = '已支付';
			}
			$paperlist[] = $result;
		}
		$this->paperlist = $paperlist;
		$this->display("paper-index.html");
	}

	function detail() {
		$uid = $this->get_uid();
		$pid = $this->spArgs("pid");

		$paper = Model('Paper')->find("`id`='{$pid}' AND `uid`={$uid}");
		if ($paper) {
			$cartprice = 0.00;
			$cartpoint = 0.00;
			$paperitemlist = array();
			$resultlist = Model('PaperProduct')->findAll("`paper`='{$paper['id']}'");
			foreach ($resultlist as $result) {
				$product = Model('Product')->find("`id`={$result['product']}");
				$product['product_count'] = $result['product_count'];

				$cartprice += $product['price'] * $result['product_count'];
				$cartpoint += $product['point'] * $result['product_count'];
				$paperitemlist[] = $product;
			}
			if ($paper['paper_status'] == 0) {
				$paper['paper_status_txt'] = '未支付';
			}
			if ($paper['paper_status'] == 1) {
				$paper['paper_status_txt'] = '已支付';
			}
			$this->paperitemlist = $paperitemlist;
			$this->cartprice = $cartprice;
			$this->cartpoint = $cartpoint;
			$this->paper = $paper;
			$this->display('paper-detail.html');
		}
	}
}