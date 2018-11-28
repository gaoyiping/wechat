<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/alipay/alipay_notify.class.php');
require_once(MO_LIB_DIR . '/alipay/alipay.config.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
class NotifyUrlAction extends Action {

	public function getDefaultView() {
		$alipay_config['partner']		= '2088611403331972';
		$alipay_config['key']			= '7dgpyjeb1p7rvuitga34ku06euelgd1t';
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = getcwd().'/cacert.pem';
		$alipay_config['transport']    = 'http';
		
		$db = DBAction::getInstance();
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		
		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代
		
		
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		
			//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
		
			//商户订单号
		
			$out_trade_no = $_POST['out_trade_no'];
		
			//支付宝交易号
		
			$trade_no = $_POST['trade_no'];
		
			//交易状态
			$trade_status = $_POST['trade_status'];
		
		
			if($_POST['trade_status'] == 'TRADE_FINISHED') {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
		
				//注意：
				//该种交易状态只在两种情况下出现
				//1、开通了普通即时到账，买家付款成功后。
				//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。
				
				
				//调试用，写文本函数记录程序运行情况是否正常
				//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
			}else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
				
				//财务记录
				$sql = "select * from  ntb_record where cfnumber='$out_trade_no'";
				$r = $db->select($sql);
				$status = $r[0]->status;
				$userid =  $r[0]->operation;
				$money = $r[0]->amount;
				if($status==0){
					$sql = "update  ntb_record set status =1 where cfnumber='$out_trade_no'";
					$r = $db->update($sql);
				
					$sql = "update ntb_user set z_money = z_money + $money where user_id = '$userid'";
					$r = $db->update($sql);
					
					$jiage=$money;
					
					//领导奖
					//找出所有直推线的上级
					//1、找出当前会员的lt、rt
					$sql="select lt,rt from ntb_user_ref where node='$userid'";
					$r = $db->select($sql);
					$lt = $r[0]->lt;
					$rt = $r[0]->rt;
						
					//取出代数,点数
					$sql="select * from ntb_const where id=1";
					$r = $db->select($sql);
					$ds=0;
					$tcbl = array();
					if($r){
						$ds=$r[0]->ds;
						$tcbl = explode(",",$r[0]->tcbl);
					}
					
					//2、给前几代的会员分红
					$sql="SELECT * FROM ntb_user_ref WHERE lt<$lt and rt>$rt order by id desc  limit 0,$ds";
					$r = $db->select($sql);
					for ($i=0;$i<count($r);$i++){
						$money = $jiage*$tcbl[$i];
						$user = $r[$i];
						$uuid = $user->node;
						$sql = "insert into ntb_money_point (userid,money,s_money,isf,type,fromuser) values ('$uuid','$money','$money',1,0,'$userid');";
						$r1 = $db->insert ( $sql );
						
							
						$sql2="update ntb_user set e_money=e_money+$money where user_id='$uuid'";
						$r2 = $db->update ( $sql2 );
					}
					
				}
				
		
				//注意：
				//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。
		
				//调试用，写文本函数记录程序运行情况是否正常
				//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
			}
		
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
		
			echo "success";		//请不要修改或删除
		
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
			//验证失败
			echo "fail";
		
			//调试用，写文本函数记录程序运行情况是否正常
			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
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