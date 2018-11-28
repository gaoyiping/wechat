<?php
class wxmall extends spMagic {
	public function __construct() {
		spController::__construct();
	}

	function index(){
		$products = Model('Product')->findAll();
		$this->products = $products;
		$this->display("wxmall-index.html");
	}

	function detail() {
		$pid = $this->spArgs('pid');
		$product = Model('Product')->product_get($pid);
		$this->product = $product;
		$this->display("wxmall-detail.html");
	}

	function productcontent() {
		$pid = $this->spArgs('pid');
		$product = Model('Product')->product_get($pid);
		echo json_encode($product['content']);
	}

	function ordercart() {
		$uid = $this->get_uid();
		$info = Model('Infomation')->find(array('uid'=> $uid));
		if ($info && $info['mail_people'] && $info['mail_cellphone'] && $info['mail_address']) {
			$cartprice = 0.00;
			$cartpoint = 0.00;
			$cartitemlist = Model('Cart')->cart_list($uid);
			foreach ($cartitemlist as $cart) {
				$cartprice += $cart['product']['price'] * $cart['product_count'];
				$cartpoint += $cart['product']['point'] * $cart['product_count'];
			}
			$this->userinfo = $info;
			$this->cartitemlist = $cartitemlist;
			$this->cartprice = $cartprice;
			$this->cartpoint = $cartpoint;
			$this->user = $this->get_user($uid);
			$this->display("wxmall-order.html");
		} else {
			$this->error("请先填写收货信息！", spUrl('userinfo', 'mailaddress'));
		}
	}

	function ordercreate() {
		$uid = $this->get_uid();
		$timestamp = time();
		$upcount = 1;
		$cartprice = 0.00;
		$cartpoint = 0.00;
		$cartlist = Model('Cart')->cart_list($uid);
		foreach ($cartlist as $cart) {
			$cartprice += $cart['product']['price'] * $cart['product_count'];
			$cartpoint += $cart['product']['point'] * $cart['product_count'];
			if ($cart['product']['bcount'] > 1) {
				$upcount = max($upcount, $cart['product']['bcount']);
			}
		}
		$info = Model('Infomation')->find("`uid`={$uid}");
		$pid = date('YmdHi') . 'PD' . mt_rand(1000, 9999);
		$paytype = $this->spArgs('paytype');
		if ($paytype == 'point') {
			$user = $this->get_user($uid);
			if ($user['point_gold'] < $cartprice) {
				$this->error("剩余积分不足！", spUrl('wxmall', 'ordercart'));
			}
			Model('User')->decrField(array('id'=> $uid), 'point_gold', $cartprice);
			$sqldata = array(
				'id'=>$pid,
				'uid'=> $uid,
				'paper_price'=> $cartprice,
				'paper_point'=> $cartpoint,
				'paper_pay'=> $cartprice,
				'paper_time'=> $timestamp,
				'mail_people'=> $info['mail_people'],
				'mail_cellphone'=> $info['mail_cellphone'],
				'mail_address'=> $info['mail_address'],
				'paper_note'=> '',
				'paper_status'=> 1);
			Model('Paper')->create($sqldata);
			foreach ($cartlist as $cart) {
				$sqldata = array('paper'=> $pid, 'product'=> $cart['product']['id'], 'product_count'=> $cart['product_count']);
				Model('PaperProduct')->create($sqldata);
			}
			Model('TaskTotal')->add_task($cartprice);
			if ($user['uplevel'] == 0) {
				Model('User')->upcount($uid, $upcount);
				Model('User')->uplevel($uid, 1);
			} else {
				Model('User')->check_uplevel($uid);
			}
			$percent = array(
				0 => array(null),
				1 => array(null, 0.1, 0.15),
				6 => array(null, 0.1, 0.15, 0.02, 0.02),
				7 => array(null, 0.1, 0.15, 0.02, 0.02, 0.02, 0.02),
				2 => array(null, 0.1, 0.15, 0.03, 0.03, 0.03, 0.03, 0.03, 0.03),
				3 => array(null, 0.1, 0.15, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04),
				4 => array(null, 0.1, 0.15, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04),
				5 => array(null, 0.1, 0.15, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04, 0.04),
			);
			$outlevel = array(
				0 => 0,  // 见习店小二
				1 => 2,  // 店小二
				6 => 4,  // 伙计
				7 => 6,  // 管家
				2 => 8,  // 掌柜
				3 => 10, // 东家
				4 => 12, // 富豪
				5 => 12, // 大富豪
			);
			$mxqlevel = array(2, 3, 4, 5);
			$relation_level = 0;
			while ($relation_level <= 11) {
				$relation_level++;
				$rid = Model('Relation')->get_level($uid, $relation_level);
				$relation = $this->get_user($rid);
				if ($relation) {
					$uplevel = $relation['uplevel'];
					if ($relation_level <= $outlevel[$uplevel]) {
						$point_gold = round($cartpoint * $percent[$uplevel][$relation_level], 2);
						$point_tzq = round($point_gold * 0.1, 2);
						if ($uplevel >= 2 && $uplevel <= 5) {
							$point_mxq = round($point_gold * 0.05, 2);
						} else {
							$point_mxq = 0;
						}
						$point_less = round($point_gold - $point_tzq - $point_mxq, 2);
						$sqldata = array(
							'uid'=> $uid,
							'rid'=> $rid,
							'uplevel'=> $uplevel,
							'deeplevel'=> $relation_level,
							'deepercent'=> $percent[$uplevel][$relation_level],
							'point_total'=> $cartpoint,
							'point_tzq'=> $point_tzq,
							'point_mxq'=> $point_mxq,
							'point_less'=> $point_less,
							'record_time'=> $timestamp);
						Model('RecordPoint')->create($sqldata);
						$sqlcmd = "UPDATE `" . Model('User')->tbl_name . "` SET `point_gold`=`point_gold`+{$point_less}, `point_tzq`=`point_tzq`+{$point_tzq}, `point_mxq`=`point_mxq`+{$point_mxq}, `point_ljxs`=`point_ljxs`+{$cartprice}, `point_yeji`=`point_yeji`+{$point_gold} WHERE `id`='{$rid}'";
						Model('User')->runSql($sqlcmd);
					} else {
						$point_gold = 0;
						$point_tzq = 0;
						$point_mxq = 0;
						$point_less = 0;
					}

					if ($point_less) {
						Model('TaskUser')->add_task($rid, $point_less);
					}

					Model('User')->check_uplevel($rid);
				}
			}
			Model('Cart')->cart_clear($uid);
			$this->success("结算成功！", spUrl('userinfo', 'index'));
		}
		if ($paytype == 'wxpay') {
			$openid = $this->wx_get_openid();
			$sqldata = array(
				'id'=>$pid,
				'uid'=> $uid,
				'paper_price'=> $cartprice,
				'paper_point'=> $cartpoint,
				'paper_time'=> $timestamp,
				'mail_people'=> $info['mail_people'],
				'mail_cellphone'=> $info['mail_cellphone'],
				'mail_address'=> $info['mail_address'],
				'paper_note'=> '');
			Model('Paper')->create($sqldata);
			foreach ($cartlist as $cart) {
				$sqldata = array('paper'=> $pid, 'product'=> $cart['product']['id'], 'product_count'=> $cart['product_count']);
				Model('PaperProduct')->create($sqldata);
			}
			Model('Cart')->cart_clear($uid);
			$this->jump(spUrl('wxpay', 'orderpay', array('pid'=> $pid)));
		}
	}
}