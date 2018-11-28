<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/alipay/alipay_notify.class.php');

class ReturnUrlAction extends Action {

	public function getDefaultView() {
		require_once(MO_LIB_DIR . '/alipay/alipay.config.php');
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($aliapy_config);
		$verify_result = $alipayNotify->verifyReturn();
		
		$r = 0;
		if($verify_result) {//验证成功
			//请在这里加上商户的业务逻辑程序代码
			
		    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
		    $out_trade_no	= $_GET['out_trade_no'];	//获取订单号
		    $trade_no		= $_GET['trade_no'];		//获取支付宝交易号
		    $total_fee		= $_GET['total_fee'];		//获取总价格
		
		    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				$request = $this->getContext()->getRequest();
				$db = DBAction::getInstance();
				$userid = $this->getContext()->getStorage()->read('_user_id');
				$sql = "update ntb_user set z_money = z_money + $total_fee where user_id = '$userid'";
				$r = $db->update($sql);
				
				//财务记录
				$type = E_MONEY_CHONGZHI;
				$sql = "insert into ntb_record (operation,amount,type,status,add_date,mtype) values ('$userid','$total_fee','$type',1,CURRENT_TIMESTAMP,1)";
				$r = $db->insert($sql);
		    }
		    else {
		      	echo "trade_status=".$_GET['trade_status'];
		    }
				
			if($r >= 0){
				header("Content-type: text/html;charset=utf-8");
				echo"<script language='javascript'>" .
						"alert('充值成功！');" .
						"location.href='index.php?module=OnlinePay';</script>";
				return;
			} else {
				header("Content-type: text/html;charset=utf-8");
				echo"<script language='javascript'>" .
						"alert('未知原因,充值失败！');" .
						"location.href='index.php?module=OnlinePay';</script>";
				return;
			}
			
			
		}
		else {
		    header("Content-type: text/html;charset=utf-8");
				echo"<script language='javascript'>" .
						"alert('未知原因,充值失败！');" .
						"location.href='index.php?module=OnlinePay';</script>";
				return;
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