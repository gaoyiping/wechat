<?php
/**
 * 通用通知接口demo
 * ====================================================
 * 支付完成后，微信会把相关支付和用户信息发送到商户设定的通知URL，
 * 商户接收回调信息后，根据需要设定相应的处理流程。
 * 
 * 这里举例使用log文件形式记录回调信息。
*/
session_name("money_mojavi");
session_start();
date_default_timezone_set('Asia/Chongqing');
set_time_limit(0);
require_once(dirname(__FILE__)."/webapp/config.php");
require_once(MO_APP_DIR."/mojavi.php");
require_once(dirname(__FILE__).'/webapp/config/db_config.php');
require_once(dirname(__FILE__).'/webapp/lib/DBAction.class.php');
require_once(dirname(__FILE__).'/webapp/lib/WxPayPubHelper/WxPayPubHelper.php');
require_once(dirname(__FILE__).'/webapp/lib/WxPayPubHelper/log_.php');
require_once(dirname(__FILE__) . '/webapp/lib/SysConst.class.php');
$db = DBAction::getInstance();
    //使用通用通知接口
	$notify = new Notify_pub();
	//存储微信的回调
	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];	
	$notify->saveData($xml);
	//验证签名，并回应微信。
	//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
	//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
	//尽可能提高通知的成功率，但微信不保证通知最终能成功。
	if($notify->checkSign() == FALSE){
		$notify->setReturnParameter("return_code","FAIL");//返回状态码
		$notify->setReturnParameter("return_msg","签名失败");//返回信息
	}else{
		$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
	}
	$returnXml = $notify->returnXml();
	echo $returnXml;
	//==商户根据实际情况设置相应的处理流程，此处仅作举例=======
	//以log文件形式记录回调信息
	$log_ = new Log_();
	$log_name="./notify_url.log";//log文件路径
	$log_->log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");

	if($notify->checkSign()) {
		if ($notify->data["return_code"] == "FAIL") {
			$log_->log_result($log_name,"【通信出错】:\n".$xml."\n");
		} elseif($notify->data["result_code"] == "FAIL") {
			$log_->log_result($log_name,"【业务出错】:\n".$xml."\n");
		} else {
			$sNo = $notify->data["out_trade_no"];
			$sqlcmd = "SELECT * FROM `ntc_rorder_temp` WHERE `sNo`='{$sNo}'";
			$order = $db->getone($sqlcmd);
			if ($order) {
				$session_id = $order['session_id'];
				$user_id = $order['user_id'];
				$post_name = $order['post_name'];
				$post_tel = $order['post_tel'];
				$post_address = $order['post_address'];

				$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$user_id}'";
				$user = $db->getone($sqlcmd);

				$sqlcmd = "SELECT * FROM `ntb_record` WHERE `cfnumber`='{$sNo}'";
				$repay = $db->getone($sqlcmd);
				if ($repay) {
					$log_->log_result($log_name,"【重复支付】:\n".$xml."\n");
					exit;
				}

				$sqlcmd = "SELECT * FROM `ecs_cart` WHERE `user_id`='{$user_id}' AND `session_id`='{$session_id}'";
				$goods_data = $db->select($sqlcmd);
				$goods_count = 0;
				$goods_valid_count = 0;
				foreach ($goods_data as $goods) {
					$goods_count += $goods->goods_number;
					$goods_valid_count += $goods->goods_number;
				}

				$sqlcmd = "SELECT SUM(`goods_price`*`goods_number`) AS `totalmoney`, SUM(`pv`*`goods_number`) AS `totalpv` FROM `ecs_cart` WHERE `session_id`='{$session_id}' AND `user_id`='{$user_id}'";
				$result = $db->getone($sqlcmd);
				$jiage = $result['totalmoney'];
				$pv = $result['totalpv'];

				$db->begin();

				$sqlcmd  = "INSERT INTO `ntc_rorder` (`user_id`, `post_name`, `post_tel`, `post_address`, `way`, `counts`, `moneys`, `emoneys`, `status`, `add_date`, `stype`, `sNo`, `type`) VALUES ";
				$sqlcmd .= "('{$user_id}', '{$post_name}', '{$post_tel}', '{$post_address}', 1, {$goods_count}, {$jiage}, {$pv}, 0, CURRENT_TIMESTAMP, 0, '{$sNo}', 1)";
				$order_id = $db->insert($sqlcmd, "last_insert_id");
				if ($order_id == -1) {
					$db->rollback();
					$log_->log_result($log_name,"【订单插入失败】:\n".$xml."\n");
					exit;
				}

				foreach ($goods_data as $goods) {
					$sqlcmd = "SELECT * FROM `ntc_rproducts` WHERE `id`={$goods->goods_id}";
					$product = $db->getone($sqlcmd);
					if ($product) {
						$sqlcmd  = "INSERT INTO `admin_cg_kucun` (`rname`, `pID`, `rsNo`, `typeID`, `rdate`, `rnum`, `rdanwei`, `rjiage`, `pubdate`, `rtype`, `rleixing`, `rliushui`, `user_id`, `yeji`) VALUES ";
						$sqlcmd .= "('{$goods->goods_name}', {$goods->goods_id}, '{$product['sNo']}', 0, CURRENT_TIMESTAMP, {$goods->goods_number}, '{$product['danwei']}', {$goods->goods_price}, CURRENT_TIMESTAMP, 1, 0, '{$sNo}', '{$user_id}', 0)";
						$cg_id = $db->insert($sqlcmd);
						if ($cg_id == -1) {
							$db->rollback();
							$log_->log_result($log_name,"【生成出库订单失败】:\n".$xml."\n");
							exit;
						}
					} else {
						$db->rollback();
						$log_->log_result($log_name,"【无效的商品】:\n".$xml."\n");
						exit;
					}
				}

				$weekindex = (int)date('W');
				$weekday = (int)date('w');
				$weekday = $weekday ? $weekday++ : $weekday = 7;
				$caselevel = array(0, 0, 1, 2, 3, 4);
				$percent = array(null, 0.1, 0.1, 0.03, 0.03, 0.03, 0.03, 0.03, 0.03, 0.03, 0.03, 0.01);
				$outlvel = array(0, 3, 6, 7, 9, 11);

				if ($user['uplevel'] == 0) {
					$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$user['pid']}'";
					$relation = $db->getone($sqlcmd);
					if ($relation['uplevel'] >= 2) {
						$casecount = $caselevel[$relation['uplevel']];
						$sqlcmd = "INSERT INTO `ntb_user_weektask` (`user_id`, `task_week`, `task_case`) SELECT '{$user['pid']}', {$weekindex}, {$casecount} FROM DUAL WHERE NOT EXISTS (SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$user['pid']}' AND task_week={$weekindex})";
						$sid = $db->insert($sqlcmd);
						if ($sid == -1) {
							$db->rollback();
							$log_->log_result($log_name,"【业绩考核启动失败】:\n".$xml."\n");
							exit;
						}
						$sqlcmd = "SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$user['pid']}' AND `task_week`={$weekindex}";
						$mission = $db->getone($sqlcmd);
						if (!$mission['task_done']) {
							$case_less_count = $mission['task_case'] - 1;
							$goods_valid_count = $goods_valid_count - 1;
							if ($case_less_count) {
								$sqlcmd = "UPDATE `ntb_user_weektask` SET `task_case`={$case_less_count} WHERE `user_id`='{$user['pid']}' AND `task_week`={$weekindex}";
							} else {
								$sqlcmd = "UPDATE `ntb_user_weektask` SET `task_case`=0, `task_done`=1, `task_day`={$weekday} WHERE `user_id`='{$user['pid']}' AND `task_week`={$weekindex}";
							}
							$sid = $db->update($sqlcmd);
							if ($sid == -1) {
								$db->rollback();
								$log_->log_result($log_name,"【绩考核更新失败】:\n".$xml."\n");
								exit;
							}
						}
					}
					$sqlcmd = "UPDATE `ntb_user` SET `uplevel`=1 WHERE `user_id`='{$user_id}'";
					$result = $db->update($sqlcmd);
					if ($result == -1) {
						$db->rollback();
						$log_->log_result($log_name,"【店铺升级失败】:\n".$xml."\n");
						exit;
					}

					$pid = $user['pid'];
					for ($i = 1; $i <= 3; $i++) {
						$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$pid}'";
						$relation = $db->getone($sqlcmd);
						$sqlcmd = "UPDATE `ntb_user` SET `t{$i}`=`t{$i}`+ 1 WHERE `user_id`='{$pid}'";
						$sid = $db->update($sqlcmd);
						if ($sid == -1) {
							$db->rollback();
							$log_->log_result($log_name,"【更新硒粉失败】:\n".$xml."\n");
							exit;
						}
						if ($relation['pid']) {
							$pid = $relation['pid'];
						} else {
							break;
						}
					}
				} else if ($user['uplevel'] >= 2) {
					$casecount = $caselevel[$user['uplevel']];
					$sqlcmd = "INSERT INTO `ntb_user_weektask` (`user_id`, `task_week`, `task_case`) SELECT '{$user_id}', {$weekindex}, {$casecount} FROM DUAL WHERE NOT EXISTS (SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$user_id}' AND task_week={$weekindex})";
					$sid = $db->insert($sqlcmd);
					if ($sid == -1) {
						$db->rollback();
						$log_->log_result($log_name,"【周任务未启用】:\n".$xml."\n");
						exit;
					}
					$sqlcmd = "SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$user_id}' AND `task_week`={$weekindex}";
					$mission = $db->getone($sqlcmd);
					if (!$mission['task_done']) {
						if ($mission['task_case'] <= $goods_count) {
							$goods_valid_count = $goods_valid_count - $mission['task_case'];
							$case_less_count = 0;
						} else {
							$case_less_count = $mission['task_case'] - $goods_valid_count;
							$goods_valid_count = 0;
						}
						if ($case_less_count) {
							$sqlcmd = "UPDATE `ntb_user_weektask` SET `task_case`={$case_less_count} WHERE `user_id`='{$user_id}' AND `task_week`={$weekindex}";
						} else {
							$sqlcmd = "UPDATE `ntb_user_weektask` SET `task_case`=0, `task_done`=1, `task_day`={$weekday} WHERE `user_id`='{$user_id}' AND `task_week`={$weekindex}";
						}
						$sid = $db->update($sqlcmd);
						if ($sid == -1) {
							$db->rollback();
							$log_->log_result($log_name,"【业绩考核更新失败】:\n".$xml."\n");
							exit;
						}
					}
				}

				$pv = $goods_valid_count * 310;
				$jiage = $goods_valid_count * 399;

				$pid = $user['pid'];
				$relation_level = 0;
				while ($relation_level <= 11) {
					$relation_level++;
					$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$pid}'";
					$relation = $db->getone($sqlcmd);
					if ($relation) {
						$casecount = $caselevel[$relation['uplevel']];
						$sqlcmd = "INSERT INTO `ntb_user_weektask` (`user_id`, `task_week`, `task_case`) SELECT '{$pid}', {$weekindex}, {$casecount} FROM DUAL WHERE NOT EXISTS (SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$pid}' AND task_week={$weekindex})";
						$sid = $db->insert($sqlcmd);
						if ($sid == -1) {
							$db->rollback();
							$log_->log_result($log_name,"【周任务未启用】:\n".$xml."\n");
							exit;
						}

						$money = 0;
						if ($relation_level <= $outlvel[$relation['uplevel']]) {
							$money = round($pv * $percent[$relation_level], 2);
						}
						$type = $relation_level > 2 ? 1 : 0;
						$ljxse = $relation_level <= 2 ? $jiage : 0;
						if ($money > 0) {
							$tzq = round($money * 0.1, 2);
							$mxq = 0;
							if ($relation['uplevel'] >= 2) {
								$mxq = round($money * 0.05, 2);
							}
							$less = round($money - $tzq - $mxq, 2);
							$sqlcmd  = "INSERT INTO `ntb_money_point` (`userid`, `money`, `fx_money`, `tax_money`, `s_money`, `isf`, `type`, `fromuser`) VALUES ('{$pid}', {$money}, {$tzq}, {$mxq}, {$less}, 1, {$type}, '{$user_id}')";
							$rid = $db->insert($sqlcmd);
							if ($rid == -1) {
								$db->rollback();
								$log_->log_result($log_name,"【积分计算失败】:\n".$xml."\n");
								exit;
							}
						} else {
							$tzq = 0;
							$mxq = 0;
							$less = 0;
						}
						
						$sqlcmd = "UPDATE `ntb_user` SET `e_money`=`e_money`+{$money}, `j_money`=`j_money`+{$less}, `f_money`=`f_money`+{$mxq}, `ljyj`=`ljyj`+{$money}, `ljxse`=`ljxse`+{$ljxse} WHERE `user_id`='{$pid}'";
						$sid = $db->update($sqlcmd);
						if ($sid == -1) {
							$db->rollback();
							$log_->log_result($log_name,"【积分更新失败】:\n".$xml."\n");
							exit;
						}

						$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$pid}'";
						$relation = $db->getone($sqlcmd);
						if ($relation['uplevel'] == 1 && $relation['t1'] >= 30) {
							$sqlcmd = "UPDATE `ntb_user` SET `uplevel`=2 WHERE `user_id`='{$pid}'";
							$result = $db->update($sqlcmd);
							if ($result == -1) {
								$db->rollback();
								$log_->log_result($log_name,"【{$pid}升级掌柜失败】:\n".$xml."\n");
								exit;
							}
						} else {
							$sqlcmd = "SELECT SUM(`money`) AS `score` FROm `ntb_money_point` WHERE (`type`=0 OR `type`=1 OR `type`=2) AND `userid`='{$pid}'";
							$result = $db->select($sqlcmd);
							$score = $result[0]->score;
							if ($relation['uplevel'] == 2 && $relation['t1'] + $relation['t2'] + $relation['t3'] >= 600 && $score >= 25000) {
								$sqlcmd = "UPDATE `ntb_user` SET `uplevel`=3 WHERE `user_id`='{$pid}'";
								$result = $db->update($sqlcmd);
								if ($result == -1) {
									$db->rollback();
									$log_->log_result($log_name,"【{$pid}升级掌柜失败】:\n".$xml."\n");
									exit;
								}
							}
							if ($relation['uplevel'] == 3 && $relation['t1'] + $relation['t2'] + $relation['t3'] >= 1000 && $score >= 35000) {
								$sqlcmd = "UPDATE `ntb_user` SET `uplevel`=4 WHERE `user_id`='{$pid}'";
								$result = $db->update($sqlcmd);
								if ($result == -1) {
									$db->rollback();
									$log_->log_result($log_name,"【{$pid}升级富豪失败】:\n".$xml."\n");
									exit;
								}
							}
							if ($relation['uplevel'] == 4 && $relation['t1'] + $relation['t2'] + $relation['t3'] >= 5000 && $score >= 1000000) {
								$sqlcmd = "SELECT SUM(`money`) AS `score` FROm `ntb_money_point` WHERE (`type`=0 OR `type`=1) AND `userid`='{$pid}'";
								$result = $db->select($sqlcmd);
								$score = $result[0]->score;
								if ($score >= 200000) {
									$sqlcmd = "UPDATE `ntb_user` SET `uplevel`=5 WHERE `user_id`='{$pid}'";
									$result = $db->update($sqlcmd);
									if ($result == -1) {
										$db->rollback();
										$log_->log_result($log_name,"【{$pid}升级大富豪失败】:\n".$xml."\n");
										exit;
									}
								}
							}
						}
						$pid = $relation['pid'];
					} else {
						break;
					}
				}

				$sqlcmd = "INSERT INTO `ntb_record` (`operation`, `amount`, `type`, `status`, `add_date`, `mtype`) VALUES ('$user_id', '-{$jiage}', 1, 1, CURRENT_TIMESTAMP, 1)";
				$sid = $db->insert($sqlcmd);
				if ($sid == -1) {
					$db->rollback();
					$log_->log_result($log_name,"【购买记录失败！】:\n".$xml."\n");
					exit;
				}
				
				for ($k = 0; $k < $goods_count; $k++) {
					$goods = $goods_data[$k];
					$sqlcmd = "UPDATE `ntc_rproducts` SET `good_number`=`good_number`-1 WHERE `id`={$goods->goods_id}";
					$sid = $db->update($sqlcmd);
				}

				$sqlcmd = "DELETE FROM `ecs_cart` WHERE `user_id`='{$user_id}' AND `session_id`='{$session_id}'";
				$db->query($sqlcmd);

				// 业务结束
				$db->commit();
				$log_->log_result($log_name,"【支付成功】:\n".$xml."\n");
			} else {
				$log_->log_result($log_name,"【查无订单】:\n".$xml."\n");
			}
		}
	}
?>