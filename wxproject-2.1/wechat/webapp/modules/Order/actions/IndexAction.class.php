<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read("_user_id");
		$cart = $this->getContext()->getStorage()->read("_cart");
		
		if ($cart == null || count($cart->rpros) == 0) {
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
				"alert('还未选购商品，无法下单！');" .
				"location.href='index.php?module=RProduct&action=cartView';</script>" ;
		}
		//选择 货运信息
		$db = DBAction::getInstance();
		$sql = "select user_id, e_money, card_name, address, mobile " .
			"from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		if ($r) {
			$express = $r[0];
		} else {
			$express = new stdClass;
		}

		$request->setAttribute('cart', $cart);
		$request->setAttribute('express', $express);
		return View :: INPUT;
	}

	public function execute(){	
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read("_user_id");
		$cart = $this->getContext()->getStorage()->read("_cart");

		//添加订单
		$rollback = false;
		$rollcode = 0;
		$db->begin();
		do{
			// 1,减少 电子货币
			$sql_1 = "update ntb_user set e_money = e_money - '{$cart->base['emoneys']}' " .
				"where user_id = '$userid' and e_money >= '{$cart->base['emoneys']}'";
			$r_1 = $db->update($sql_1);
			if ($r_1 < 1) { $rollback = true; $rollcode = 1; break; }
			// 2.订单
			$sql_2 = "insert into ntc_rorder(" .
				"user_id, post_name, post_tel, post_address, " .
				"way, counts, moneys, emoneys, status, add_date) " .
				"select user_id, card_name, mobile, address, " .
				"'1', '{$cart->base['counts']}', '{$cart->base['moneys']}', " .
				"'{$cart->base['emoneys']}', '0', CURRENT_TIMESTAMP " .
				"from ntb_user where user_id = '$userid'";
			$r_2 = $db->insert($sql_2, "last_insert_id");
			if ($r_2 < 1) { $rollback = true; $rollcode = 2; break; }
			$orderid = $r_2;
			// 3.订单详情
			$t_sqls = array();
			foreach ($cart->rpros as $value) {
				$t_sqls[] = "('$orderid', '$userid', '{$value->id}', '{$value->cost}', " .
					"'{$value->count}', '{$value->money}' )";
			}
			$sql_3 = "insert into ntc_rorder_detail(" .
				"order_id, user_id, pro_id, cost, count, money) " .
				"values " . implode(',', $t_sqls);
			$r_3 = $db->insert($sql_3);
			if ($r_3 < 1) { $rollback = true; $rollcode = 3; break; }
			// 4,操作记录
			$sql_4 = "insert into ntb_record ( " .
				"operation, amount, cfnumber, type, status, add_date, replay_date) " .
				"values (" .
				"'$userid', '{$cart->base['emoneys']}', 'order_1_$orderid', " .
				"'".E_MONEY_ORDER."', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)" ;
			$r_4 = $db->insert($sql_4);
			if ($r_4 < 1) { $rollback = true; $rollcode = 4; break; }
		} while(0);
		if ($rollback) { $db->rollback(); } else { $db->commit(); }

		if ($rollcode != 0) {
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
				"alert('未知原因，下单失败！[{$rollcode}]');" .
				"location.href='index.php?module=Order';</script>" ;
		}
		//删除 零售车
		$this->getContext()->getStorage()->remove("_cart");
		$this->getContext()->getController()->redirect(
			"index.php?module=Order&action=view&orderid=$orderid"); 
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>