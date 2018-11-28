<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/alipay/alipay_notify.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
class ReturnUrlAction extends Action {

	public function getDefaultView() {
		
		$alipay_config['partner']		= '2088611403331972';
		$alipay_config['key']			= '7dgpyjeb1p7rvuitga34ku06euelgd1t';
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = getcwd().'/cacert.pem';
		$alipay_config['transport']    = 'http';
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
			$trade_status = $_GET['trade_status'];
		
		
		    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序
		    }
		    else {
		      //echo "trade_status=".$_GET['trade_status'];
		    }
			
		    header('Content-Type: text/html;charset=utf-8');
		    echo "<script type='text/javascript'>" .
		    		"alert('支付成功，请关闭窗口！');</script>";
		    return ;
		
			
		}
		else {
		    //验证失败
		    //如要调试，请看alipay_notify.php页面的verifyReturn函数
		    header('Content-Type: text/html;charset=utf-8');
							echo "<script type='text/javascript'>" .
									"alert('支付失败，请关闭窗口');</script>";
							return ;
		}
		return ;
	}

	public function execute(){
		
		return;
	}
	
	
	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>