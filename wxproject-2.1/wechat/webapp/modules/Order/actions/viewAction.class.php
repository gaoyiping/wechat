<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class viewAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read("_user_id");
		$orderid = intval($request->getParameter("orderid"));
		
		$sql = "select t1.way, t1.counts, t1.moneys, t1.emoneys, t1.status, t1.add_date, " .
			"t2.cost, t2.count, t2.money, " .
			"t3.pname, t4.e_money " .
			"from ntc_rorder t1, ntc_rorder_detail t2, ntc_rproducts t3, ntb_user t4 " .
			"where t1.user_id = '$userid' and t1.id = '$orderid' " .
			"and t2.order_id = t1.id and t3.id = t2.pro_id and t4.user_id = t1.user_id";
		$result = $db->select($sql);
		if ($result) {
			$order = $result[0];
			$order->moneys = moneyFormat($order->moneys);
			$orderdetail = $result;
			foreach ($orderdetail as $value) {
				$value->cost = moneyFormat($value->cost);
				$value->money = moneyFormat($value->money);
			}
		} else {
			$order = new stdClass;
			$orderdetail = array();
		}

		$request->setAttribute("orderid", $orderid);
		$request->setAttribute("order", $order);
		$request->setAttribute("orderdetail", $orderdetail);
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>