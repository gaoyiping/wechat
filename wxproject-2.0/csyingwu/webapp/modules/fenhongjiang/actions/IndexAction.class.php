<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {
	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$weekindex = (int)date("W") - 1;

		for ($i = 2; $i <= 5; $i++) {
			$sqlcmd = "SELECT COUNT(*) AS `count` FROM `ntb_user` WHERE `uplevel`={$i}";
			$result = $db->select($sqlcmd);
			$request->setAttribute("Total{$i}", $result[0]);

			$sqlcmd = "SELECT COUNT(*) AS `count` FROM `ntb_user` AS `user`, `ntb_user_weektask` AS `task` WHERE `task`.`user_id`=`user`.`user_id` AND `task`.`task_week`={$weekindex} AND `task`.`task_done`=1 AND `user`.`uplevel`={$i}";
			$result = $db->select($sqlcmd);
			$request->setAttribute("Level{$i}", $result[0]);
		}

		$sqlcmd = "SELECT SUM(`moneys`) AS `count` FROM `ntc_rorder` WHERE `fh`=0";
		$result = $db->select($sqlcmd);
		$request->setAttribute("Money", $result[0]);

		$sqlcmd = "SELECT MAX(`sNo`) AS `sNo`, MAX(`add_date`) AS `add_date` FROM `ntb_fenhongjiesuan`";
		$result = $db->select($sqlcmd);
		$request->setAttribute("Paper", $result[0]);

		return View::INPUT;
	}

	public function execute() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$sNo = intval($request->getParameter('sNo'));
		header('Content-Type: text/html;charset=utf-8');

		$adminid = $this->getContext()->getStorage()->read('_admin_id');
		$password = md5(addslashes(trim($request->getParameter('password'))));
		$sql = "select admin_id,first_pwd,admin_atype,permission from ntb_admin where admin_id = '$adminid' and second_pwd = '$password'";
		$result = $db->select($sql);
		if($result==false){
		    exit("<script type='text/javascript'>alert('二级密码有误！');location.href='index.php?module=fenhongjiang';</script>");
		}

		$weekindex = (int)date("W") - 1;
		$Normal2 = floatval($request->getParameter('Normal2'));
		$Normal3 = floatval($request->getParameter('Normal3'));
		$Normal4 = floatval($request->getParameter('Normal4'));
		$Normal5 = floatval($request->getParameter('Normal5'));

		$Vip2 = floatval($request->getParameter('Vip2'));
		$Vip3 = floatval($request->getParameter('Vip3'));
		$Vip4 = floatval($request->getParameter('Vip4'));
		$Vip5 = floatval($request->getParameter('Vip5'));

		$NormalMoney = array(0, 0, $Normal2, $Normal3, $Normal4, $Normal5);
		$VipMoney = array(0, 0, $Vip2, $Vip3, $Vip4, $Vip5);

		$db->begin();
		$datestamp = date("Y-m-d");
		$sid = $db->insert("INSERT INTO `ntb_fenhongjiesuan` (`sNo`,`fenhongdate`) VALUES ('{$sNo}','{$datestamp}')");
		if ($sid == -1) {
			$db->rollback();
		    exit("<script type='text/javascript'>alert('结算启动失败！');location.href='index.php?module=fenhongjiang';</script>");
		}
		for ($level = 2; $level <=5; $level++) {
			$sqlcmd = "SELECT * FROM `ntb_user` WHERE `uplevel`={$level}";
			$member_list = $db->select($sqlcmd);
			if ($member_list && count($member_list)) {
				$member_vip = array();
				$sqlcmd = "SELECT * FROM `ntb_user` AS `user`, `ntb_user_weektask` AS `task` WHERE `task`.`user_id`=`user`.`user_id` AND `task`.`task_week`={$weekindex} AND `task`.`task_done`=1 AND `user`.`uplevel`={$level}";
				$vip_list = $db->select($sqlcmd);
				if ($vip_list && count($vip_list)) {
					for ($i = 0; $i < count($vip_list); $i++) {
						$member_vip[] = $vip_list[$i]->user_id;
					}
				}
				for ($i = 0; $i < count($member_list); $i++) {
					$uid = $member_list[$i]->user_id;
					if (in_array($uid, $member_vip)) {
						$sqlcmd = "SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$uid}' AND `task_week`={$weekindex} AND `task_done`=1";
						$mission = $db->getone($sqlcmd);
						$piece = 8 - $mission['task_day'];
						$money = round($VipMoney[$level] / 7.0 * $piece, 2);
					} else {
						$money = $NormalMoney[$level];
					}
					$benefitlevel = array(999999999, 999999999, 10000, 35000, 60000, 60000);
					$benefitlimit = array(0, 0, 30000, 100000, 200000, 200000);
					$sqlcmd = "SELECT SUM(`money`) AS `mp` FROM `ntb_money_point` WHERE (`type`=0 OR `type`=1) AND `userid`='$uid'";
					$result = $db->select($sqlcmd);
					$mp = round($result[0]->mp, 2);
					$bcount = (int)floor($mp / $benefitlevel[$level]);
					$uplevel = $member_list[$i]->uplevel;
					$blimit = $bcount * $benefitlimit[$level] + $benefitlimit[$uplevel];

					$sqlcmd = "SELECT SUM(`money`) AS `xz` FROM `ntb_money_point` WHERE `type`=2 AND `userid`='{$uid}'";
					$result = $db->select($sqlcmd);
					$xz = round($result[0]->xz, 2);

					if ($xz < $blimit) {
						if ($xz + $money > $blimit) {
							$money = round($blimit - $xz, 2);
						}
					} else {
						$money = 0;
					}

					if ($money > 0) {
						$tzq = round($money * 0.1, 2);
						$mxq = round($money * 0.05, 2);
						$less = round($money - $tzq - $mxq, 2);
						$sqlcmd  = "INSERT INTO `ntb_money_point` (`userid`, `money`, `fx_money`, `tax_money`, `s_money`, `isf`, `type`) VALUES ('{$uid}', {$money}, {$tzq}, {$mxq}, {$less}, 1, 2)";
						$sid = $db->insert ($sqlcmd);
						if ($sid == -1) {
							$db->rollback();
							exit("<script type='text/javascript'>alert('结算失败！请重试！');location.href='index.php?module=fenhongjiang';</script>");
						}
						$sqlcmd = "UPDATE `ntb_user` SET `j_money`=`j_money`+{$less}, `e_money`=`e_money`+{$money}, `z_money`=`z_money`+{$tzq}, `f_money`=`f_money`+$mxq, `benefit_count`={$bcount}, `benefit_limit`={$blimit} WHERE `user_id`='{$uid}'";
						$sid = $db->update($sqlcmd);
						if ($sid == -1) {
							$db->rollback();
							exit("<script type='text/javascript'>alert('结算失败！请重试！');location.href='index.php?module=fenhongjiang';</script>");
						}
					}
				}
			}
		}
		$sid = $db->update("UPDATE `ntc_rorder` SET `fh`=1 WHERE `fh`=0");
		if ($sid == -1) {
			$db->rollback();
			exit("<script type='text/javascript'>alert('标记失败！请重试！');location.href='index.php?module=fenhongjiang';</script>");
		}
		$db->commit();
		exit("<script type='text/javascript'>alert('结算成功！');location.href='index.php?module=fenhongjiang';</script>");
	}

	

	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>