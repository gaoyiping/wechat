<?php
date_default_timezone_set('Asia/Chongqing');
set_time_limit(0);
require_once(dirname(__FILE__)."/webapp/config.php");
require_once(MO_APP_DIR."/mojavi.php");
require_once(dirname(__FILE__).'/webapp/config/db_config.php');
require_once(dirname(__FILE__).'/webapp/lib/DBAction.class.php');
require_once(dirname(__FILE__).'/webapp/lib/alipay/alipay_notify.class.php');
require_once(dirname(__FILE__).'/webapp/lib/alipay/alipay.config.php');
require_once(dirname(__FILE__).'/webapp/lib/SysConst.class.php');
require_once(dirname(__FILE__).'/webapp/lib/Tools.class.php');
$db = DBAction::getInstance();
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();
		
if($verify_result) {//验证成功
			
			//解析notify_data
			//注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
			$doc = new DOMDocument();
			if ($alipay_config['sign_type'] == 'MD5') {
				$doc->loadXML($_POST['notify_data']);
			}
			
			if ($alipay_config['sign_type'] == '0001') {
				$doc->loadXML($alipayNotify->decrypt($_POST['notify_data']));
			}
			
			
			if( ! empty($doc->getElementsByTagName( "notify" )->item(0)->nodeValue) ) {
				//商户订单号
				$out_trade_no = $doc->getElementsByTagName( "out_trade_no" )->item(0)->nodeValue;
				//支付宝交易号
				$trade_no = $doc->getElementsByTagName( "trade_no" )->item(0)->nodeValue;
				//交易状态
				$trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;
			
				if($trade_status == 'TRADE_FINISHED') {
					
			
					//调试用，写文本函数记录程序运行情况是否正常
					//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
						
					echo "success";		//请不要修改或删除
				}
				else if ($trade_status == 'TRADE_SUCCESS') {
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
					$jiage = $money;
					//2、给前几代的会员分红
					$sql="SELECT * FROM ntb_user_ref WHERE lt<$lt and rt>$rt  and dianpu=0 order by id desc  limit 0,$ds";
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
					
					
						//用户信息
						$sql = "select *  from ntb_user where user_id = '$userid'";
						$r = $db->select($sql);
						
						
						$phone = $r[0]->mobile;
						$message ="恭喜,你已成功充值:$jiage元";
					
					
						// 短信接口用户名 $uid
						$uid = 'wyp1688';
						// 短信接口密码 $passwd
						$passwd = 'zd4006262665';
						// 发送到的目标手机号码 $telphone
						if(strlen(trim($phone))>0){
							// 短信内容 $message
							//$message = iconv ( "utf-8", "gbk", $message );
							$gateway = "http://115.29.184.65:8081/sms.aspx?action=send&userid=1627&account=$uid&password=$passwd&mobile=$phone&content=$message&sendTime=&extno=";
							$result = file_get_contents ( $gateway );
						}
						
						
					
					}
					
					
					
			
					//调试用，写文本函数记录程序运行情况是否正常
					//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
						
					echo "success";		//请不要修改或删除
				}
			}
			
	
}
		else {
			//验证失败
			echo "fail";
		
			//调试用，写文本函数记录程序运行情况是否正常
			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}

?>