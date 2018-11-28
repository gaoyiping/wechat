<?php
date_default_timezone_set('Asia/Chongqing');
require_once(dirname(__FILE__)."/webapp/config.php");
require_once(MO_APP_DIR."/mojavi.php");
require_once(dirname(__FILE__).'/webapp/config/db_config.php');
require_once(dirname(__FILE__).'/webapp/lib/DBAction.class.php');
require_once(dirname(__FILE__).'/webapp/lib/alipay/alipay_notify.class.php');
require_once(dirname(__FILE__).'/webapp/lib/alipay/alipay.config.php');
require_once(dirname(__FILE__).'/webapp/lib/SysConst.class.php');
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
		
			//商户订单号
		
			$out_trade_no = $_GET['out_trade_no'];
		
			//支付宝交易号
		
			$trade_no = $_GET['trade_no'];
		
			//交易状态
			$result = $_GET['result'];
		
		    header('Content-Type: text/html;charset=utf-8');
		    echo "<script type='text/javascript'>" .
		    		"alert('支付成功！');window.location.href='http://www.wyp1688.com/phone/index.php?module=cwzx';</script>";
		    return ;
		
			
}
else {
		    //验证失败
		    //如要调试，请看alipay_notify.php页面的verifyReturn函数
		    header('Content-Type: text/html;charset=utf-8');
							echo "<script type='text/javascript'>" .
									"alert('支付失败!');window.location.href='http://www.wyp1688.com/phone/index.php?module=cwzx';</script>";
							return ;
}
	

?>