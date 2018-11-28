<?php
import("WxPay.Api.php");
import("WxPay.JsApiPay.php");
class wxpay extends spMagic {
	public function orderpay() {
		$pid = $this->spArgs('pid');
		if ($pid) {
			$uid = $this->get_uid();
			$openid = $this->wx_get_openid();

			$model_paper = spClass('M_Paper');
			$paper = $model_paper->find("`id`='{$pid}' AND `uid`={$uid}");
			if ($paper) {
				$wxorder = spClass('WxPayUnifiedOrder');
				$wxorder->SetBody("唯若健商城");
				$wxorder->SetOut_trade_no($pid);
				$wxorder->SetTotal_fee(round($paper['paper_price'] * 100));
				$wxorder->SetTime_start(date("YmdHis"));
				$wxorder->SetTime_expire(date("YmdHis", time() + 1200));
				$wxorder->SetNotify_url("http://wx.weiruojian.com/wxpaycb.php");
				$wxorder->SetTrade_type("JSAPI");
				$wxorder->SetOpenid($openid);
				$order = WxPayApi::unifiedOrder($wxorder);
				$this->order = $order;
				$api = spClass('JsApiPay');
				$params = $api->GetJsApiParameters($order);
				$this->params = $params;
				$this->pid = $pid;
				return $this->display('wxpay.html');
			}
		}
		$this->error("错误的订单！#{$pid}", spUrl('userinfo', 'index'));
	}
}