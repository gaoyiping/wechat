<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
class orderAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sql = "select a.* from ntb_user a where a.user_id = '$userid'";
		$r = $db->select($sql);
		$userinfo = $r[0];
		
		$sessionId = session_id();
		
		$sql="select b.typeID from ecs_cart a,ntc_rproducts b where b.id=a.goods_id and a.user_id='$userid' and a.session_id='$sessionId' group by b.typeID";
		$gp = $db->select($sql);

		$sql="select sum(goods_price*goods_number) as totalmoney from ecs_cart where user_id='$userid' and session_id='$sessionId'";
		$data = $db->select($sql);
		$totalmoney = $data[0]->totalmoney;
		
		$request->setAttribute('totalmoney',$totalmoney);
		
		$type = $gp[0]->typeID;
		$request->setAttribute('type',$type);
		$request->setAttribute('userinfo',$userinfo);
		return View::INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		// edit by gaoyiping 2016/02/25
		header('Content-Type: text/html;charset=utf-8');
		$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$userid}'";
		$user = $db->getone($sqlcmd);
		if (!$user) {
			echo '<script type="text/javascript">alert("请重新登陆！");location.href="index.php?module=cart";</script>';
			return;
		}

		if ($user['pid'] == $userid) {
			echo '<script type="text/javascript">alert("推荐人不能是自己！无法购买！");location.href="index.php?module=cart";</script>';
			return;
		}

		$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$user['pid']}'";
		$referee = $db->getone($sqlcmd);
		if (!$referee) {
			echo '<script type="text/javascript">alert("无效的推荐人！无法购买！");location.href="index.php?module=cart";</script>';
			return;
		}
		
		$post_name = (addslashes(trim($request->getParameter("user_name"))));
		$post_tel = (addslashes(trim($request->getParameter("mobile"))));
		$post_address = (addslashes(trim($request->getParameter("address"))));
		$sqlcmd = "UPDATE `ntb_user` SET `address`='{$post_address}', `user_name`='{$post_name}', `mobile`='{$post_tel}' WHERE `user_id`='{$userid}'";
		$db->query($sqlcmd);

		$sessionId = session_id();
		$dingdan = "DD" . date("ymdhis") . mt_rand(100000, 999999);

		$sqlcmd = "SELECT * FROM `ecs_cart` WHERE `user_id`='{$userid}' AND `session_id`='{$sessionId}'";
		$goods_data = $db->select($sqlcmd);
		$goods_count = 0;
		$goods_valid_count = 0;
		foreach ($goods_data as $goods) {
			$goods_count += $goods->goods_number;
			$goods_valid_count += $goods->goods_number;
		}

		$sqlcmd = "SELECT SUM(`goods_price`*`goods_number`) AS `totalmoney`, SUM(`pv`*`goods_number`) AS `totalpv` FROM `ecs_cart` WHERE `session_id`='{$sessionId}' AND `user_id`='{$userid}'";
		$result = $db->getone($sqlcmd);
		$jiage = $result['totalmoney'];
		$pv = $result['totalpv'];

		$paytype = trim($request->getParameter("payment"));
		if ($paytype == 'money') {
			if ($user['j_money'] < $jiage) {
				echo '<script type="text/javascript">alert("余额不足！无法购买！");location.href="index.php?module=cart";</script>';
				return;
			}
			$db->begin();

			$sqlcmd = "UPDATE `ntb_user` SET `j_money`=`j_money`-{$jiage} WHERE `user_id`='{$userid}' AND `j_money`>={$jiage}";
			$result = $db->update($sqlcmd);
			if ($result == -1) {
				$db->rollback();
				echo '<script type="text/javascript">alert("余额不足！无法购买！");location.href="index.php?module=cart";</script>';
				return;
			}

			$sqlcmd  = "INSERT INTO `ntc_rorder` (`user_id`, `post_name`, `post_tel`, `post_address`, `way`, `counts`, `moneys`, `emoneys`, `status`, `add_date`, `stype`, `sNo`, `type`) VALUES ";
			$sqlcmd .= "('{$userid}', '{$post_name}', '{$post_tel}', '{$post_address}', 1, {$goods_count}, {$jiage}, {$pv}, 0, CURRENT_TIMESTAMP, 0, '{$dingdan}', 1)";
			$order_id = $db->insert($sqlcmd, "last_insert_id");
			if ($order_id == -1) {
				$db->rollback();
				echo '<script type="text/javascript">alert("生成订单失败！请重试！");location.href="index.php?module=cart";</script>';
				return;
			}

			foreach ($goods_data as $goods) {
				$sqlcmd = "SELECT * FROM `ntc_rproducts` WHERE `id`={$goods->goods_id}";
				$product = $db->getone($sqlcmd);
				if ($product) {
					$sqlcmd  = "INSERT INTO `admin_cg_kucun` (`rname`, `pID`, `rsNo`, `typeID`, `rdate`, `rnum`, `rdanwei`, `rjiage`, `pubdate`, `rtype`, `rleixing`, `rliushui`, `user_id`, `yeji`) VALUES ";
					$sqlcmd .= "('{$goods->goods_name}', {$goods->goods_id}, '{$product['sNo']}', 0, CURRENT_TIMESTAMP, {$goods->goods_number}, '{$product['danwei']}', {$goods->goods_price}, CURRENT_TIMESTAMP, 1, 0, '{$dingdan}', '{$userid}', 0)";
					$cg_id = $db->insert($sqlcmd);
					if ($cg_id == -1) {
						$db->rollback();
						echo '<script type="text/javascript">alert("生成出库订单失败！请重试！");location.href="index.php?module=cart";</script>';
						return;
					}
				} else {
					$db->rollback();
					echo '<script type="text/javascript">alert("无效的商品！无法购买！");location.href="index.php?module=cart";</script>';
					return;
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
						exit('<script type="text/javascript">alert("业绩考核启动失败！");location.href="index.php?module=cart";</script>');
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
							exit('<script type="text/javascript">alert("业绩考核更新失败！请重试！");location.href="index.php?module=cart";</script>');
						}
					}
				}
				$sqlcmd = "UPDATE `ntb_user` SET `uplevel`=1 WHERE `user_id`='{$userid}'";
				$result = $db->update($sqlcmd);
				if ($result == -1) {
					$db->rollback();
					echo '<script type="text/javascript">alert("店铺升级失败！");location.href="index.php?module=cart";</script>';
					return;
				}

				$pid = $user['pid'];
				for ($i = 1; $i <= 3; $i++) {
					$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$pid}'";
					$relation = $db->getone($sqlcmd);
					$sqlcmd = "UPDATE `ntb_user` SET `t{$i}`=`t{$i}`+ 1 WHERE `user_id`='{$pid}'";
					$sid = $db->update($sqlcmd);
					if ($sid == -1) {
						$db->rollback();
						exit('<script type="text/javascript">alert("更新硒粉失败！请重试！");location.href="index.php?module=cart";</script>');
					}
					if ($relation['pid']) {
						$pid = $relation['pid'];
					} else {
						break;
					}
				}
			} else if ($user['uplevel'] >= 2) {
				$casecount = $caselevel[$user['uplevel']];
				$sqlcmd = "INSERT INTO `ntb_user_weektask` (`user_id`, `task_week`, `task_case`) SELECT '{$userid}', {$weekindex}, {$casecount} FROM DUAL WHERE NOT EXISTS (SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$userid}' AND task_week={$weekindex})";
				$sid = $db->insert($sqlcmd);
				if ($sid == -1) {
					$db->rollback();
					exit('<script type="text/javascript">alert("周任务未启用！请重试！");location.href="index.php?module=cart";</script>');
				}
				$sqlcmd = "SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$userid}' AND `task_week`={$weekindex}";
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
						$sqlcmd = "UPDATE `ntb_user_weektask` SET `task_case`={$case_less_count} WHERE `user_id`='{$userid}' AND `task_week`={$weekindex}";
					} else {
						$sqlcmd = "UPDATE `ntb_user_weektask` SET `task_case`=0, `task_done`=1, `task_day`={$weekday} WHERE `user_id`='{$userid}' AND `task_week`={$weekindex}";
					}
					$sid = $db->update($sqlcmd);
					if ($sid == -1) {
						$db->rollback();
						exit('<script type="text/javascript">alert("业绩考核更新失败！");location.href="index.php?module=cart";</script>');
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
						exit('<script type="text/javascript">alert("周任务未启用！请重试！");location.href="index.php?module=cart";</script>');
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
						$sqlcmd  = "INSERT INTO `ntb_money_point` (`userid`, `money`, `fx_money`, `tax_money`, `s_money`, `isf`, `type`, `fromuser`) VALUES ('{$pid}', {$money}, {$tzq}, {$mxq}, {$less}, 1, {$type}, '{$userid}')";
						$rid = $db->insert($sqlcmd);
						if ($rid == -1) {
							$db->rollback();
							echo '<script type="text/javascript">alert("积分计算失败！请重试！");location.href="index.php?module=cart";</script>';
							return;
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
						echo '<script type="text/javascript">alert("积分更新失败！请重试！");location.href="index.php?module=cart";</script>';
						return;
					}

					$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$pid}'";
					$relation = $db->getone($sqlcmd);
					if ($relation['uplevel'] == 1 && $relation['t1'] >= 30) {
						$sqlcmd = "UPDATE `ntb_user` SET `uplevel`=2 WHERE `user_id`='{$pid}'";
						$result = $db->update($sqlcmd);
						if ($result == -1) {
							$db->rollback();
							echo '<script type="text/javascript">alert("{$pid}升级掌柜失败！请重试！");location.href="index.php?module=cart";</script>';
							return;
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
								echo '<script type="text/javascript">alert("{$pid}升级东家失败！请重试！");location.href="index.php?module=cart";</script>';
								return;
							}
						}
						if ($relation['uplevel'] == 3 && $relation['t1'] + $relation['t2'] + $relation['t3'] >= 1000 && $score >= 35000) {
							$sqlcmd = "UPDATE `ntb_user` SET `uplevel`=4 WHERE `user_id`='{$pid}'";
							$result = $db->update($sqlcmd);
							if ($result == -1) {
								$db->rollback();
								echo '<script type="text/javascript">alert("{$pid}升级富豪失败！请重试！");location.href="index.php?module=cart";</script>';
								return;
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
									echo '<script type="text/javascript">alert("{$pid}升级大富豪失败！请重试！");location.href="index.php?module=cart";</script>';
									return;
								}
							}
						}
					}
					$pid = $relation['pid'];
				} else {
					break;
				}
			}

			$sqlcmd = "INSERT INTO `ntb_record` (`operation`, `amount`, `type`, `status`, `add_date`, `mtype`) VALUES ('$userid', '-{$jiage}', 1, 1, CURRENT_TIMESTAMP, 1)";
			$sid = $db->insert($sqlcmd);
			if ($sid == -1) {
				$db->rollback();
				echo '<script type="text/javascript">alert("购买记录失败！请重试！");location.href="index.php?module=cart";</script>';
				return;
			}
			
			for ($k = 0; $k < $goods_count; $k++) {
				$goods = $goods_data[$k];
				$sqlcmd = "UPDATE `ntc_rproducts` SET `good_number`=`good_number`-1 WHERE `id`={$goods->goods_id}";
				$sid = $db->update($sqlcmd);
			}

			$sqlcmd = "DELETE FROM `ecs_cart` WHERE `user_id`='{$userid}' AND `session_id`='{$sessionId}'";
			$db->query($sqlcmd);

			// 业务结束
			$db->commit();
			echo '<script type="text/javascript">alert("消费成功！");location.href="index.php?module=shop";</script>';
		}
		if ($paytype == 'wxzhifu') {
			$sqlcmd = "INSERT INTO `ntc_rorder_temp` (`user_id`, `post_name`, `post_tel`, `post_address`, `counts`, `totalcase`, `totalpv`, `add_date`, `sNo`,  `session_id`) VALUES ('{$userid}', '$post_name', '{$post_tel}', '{$post_address}', {$goods_count}, {$jiage}, {$pv}, CURRENT_TIMESTAMP, '{$dingdan}', '{$sessionId}')";
			$sid = $db->insert($sqlcmd, "last_insert_id");
			if ($sid == -1) {
				exit('<script type="text/javascript">alert("购买信息不正确，请重新下单！");location.href="index.php?module=cart";</script>');
			}
			header("Location:/wechat/js_api_call.php?dingdan={$dingdan}&wxqianbao={$jiage}");
		}
		return;
	}
	
	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>