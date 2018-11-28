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
		}

		$sqlcmd = "SELECT SUM(`emoneys`) AS `count` FROM `ntc_rorder` WHERE `fh`=0";
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

		$NormalMoney = array(0, 0, $Normal2, $Normal3, $Normal4, $Normal5);

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
				for ($i = 0; $i < count($member_list); $i++) {
					$uid = $member_list[$i]->user_id;
					$money = $NormalMoney[$level];
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
						$sqlcmd = "UPDATE `ntb_user` SET `j_money`=`j_money`+{$less}, `e_money`=`e_money`+{$money}, `z_money`=`z_money`+{$tzq}, `f_money`=`f_money`+$mxq WHERE `user_id`='{$uid}'";
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
		return Request::POST;
	}

}
?>