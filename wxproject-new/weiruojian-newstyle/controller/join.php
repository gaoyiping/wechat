<?php
import("WxPay.Api.php");
import("WxPay.JsApiPay.php");
class join extends spMagic {
	function index() {
		$this->display("join.html");
	}

	function order() {
		$openid = $this->wx_get_openid();
		$user = $this->wx_get_user($openid);
		if ($user) {
			$pid = $this->spArgs("product");
			if ($pid == '1') {
				$body = "店小二";
				$case = '1';
			}
			if ($pid == '2') {
				$body = "伙计";
				$case = '1';
			}
			if ($pid == '3') {
				$body = "掌柜";
				$case = '1';
			}
			$paper = date('Ymd') . mt_rand(1000, 9999) . chr(mt_rand(65, 90)) . chr(mt_rand(65, 90));

			// 微信下单
			$input = spClass('WxPayUnifiedOrder');
			$input->SetBody("唯若健商城 {$body}");
			$input->SetOut_trade_no($paper);
			$input->SetTotal_fee($case);
			$input->SetTime_start(date("YmdHis"));
			$input->SetTime_expire(date("YmdHis", time() + 600));
			$input->SetNotify_url("http://wx.weiruojian.com/wxpaycb.php");
			$input->SetTrade_type("JSAPI");
			$input->SetOpenid($_SESSION['openid']);
			$order = WxPayApi::unifiedOrder($input);
			$order['_Title_'] = "唯若健商城 {$body}";

			$this->order = $order;

			$api = spClass('JsApiPay');
			$params = $api->GetJsApiParameters($order);
			$this->params = $params;

			$this->display('wxpay.html');
		}
	}
}