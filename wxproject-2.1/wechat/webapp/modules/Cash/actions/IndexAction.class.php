<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		$cfnumber = confirmNum($userid);
		$request->setAttribute("cfnumber",$cfnumber);

		$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='$userid'";
		$result = $db->select($sqlcmd);
		if ($result) {
			$request->setAttribute("User", $result[0]);
		}
		return View::INPUT;
	}

	public function execute(){
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$db = DBAction::getInstance();

		header("Content-type:text/html;charset=utf-8");
		$amount = intval($request->getParameter('amount'));
		$tax = round($amount * 0.05, 2);
		$case = round($amount - $tax, 2);
		if ($amount <= 0 || $amount > 100000) {
			echo '<script type="text/javascript">alert("提现金额错误！请重试！");location.href="index.php?module=Cash";</script>';
			return;
		}
		$cash1day = array(3, 4, 5);
		$cash2day = array(18, 19, 20);
		$dayindex = (int)date("j");
		if (in_array($dayindex, $cash1day)) {
			$datestamp1 = date('Y-m-03 00:00:00');
			$datestamp2 = date('Y-m-05 00:00:00');
			$sqlcmd = "SELECT * FROM `ntb_record` WHERE `add_date`>='{$datestamp1}' AND `add_date`<='{$datestamp2}' AND `type`=4 AND `operation`='{$userid}'";
			$option = $db->getone($sqlcmd);
			if ($option) {
				exit('<script type="text/javascript">alert("申请失败！3~5日只允许提现一次！");location.href="index.php?module=Cash&action=List";</script>');
			}
		} else if (in_array($dayindex, $cash2day)) {
			$datestamp1 = date('Y-m-18 00:00:00');
			$datestamp2 = date('Y-m-20 00:00:00');
			$sqlcmd = "SELECT * FROM `ntb_record` WHERE `add_date`>='{$datestamp1}' AND `add_date`<='{$datestamp2}' AND `type`=4 AND `operation`='{$userid}'";
			$option = $db->getone($sqlcmd);
			if ($option) {
				exit('<script type="text/javascript">alert("申请失败！18~20日只允许提现一次！");location.href="index.php?module=Cash&action=List";</script>');
			}
		} else {
			exit('<script type="text/javascript">alert("申请失败！请于3~5日或18~20日进行提现操作！");location.href="index.php?module=Cash&action=List";</script>');
		}

		$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$userid}'";
		$user = $db->getone($sqlcmd);
		if (!$user || $amount > $user['j_money']) {
			$request->setError('error', "提现金额超出可兑换积分！");
			return $this->getDefaultView();
		}
		$cfnumber = addslashes(trim($request->getParameter("cfnumber")));

		$db->begin();
		$sqlcmd = "UPDATE `ntb_user` SET `j_money`=`j_money`-{$amount} WHERE `user_id`='{$userid}' AND `j_money`>={$amount}";
		$sid = $db->update($sqlcmd);
		if ($sid != 1) {
			$db->rollback();
			echo '<script type="text/javascript">alert("兑换积分失败！请重试！");location.href="index.php?module=Cash";</script>';
			return;
		}
		$sqlcmd = "INSERT INTO `ntb_record` (`operation`, `amount`, `cfnumber`, `type`, `status`, `add_date`, `mtype`) VALUES ('{$userid}', {$case}, '{$cfnumber}', 4, 0, CURRENT_TIMESTAMP, 1)";
		$sid = $db->insert($sqlcmd);
		if ($sid != 1) {
			$db->rollback();
			echo '<script type="text/javascript">alert("兑换积分记录失败！请重试！");location.href="index.php?module=Cash";</script>';
			return;
		}
		$cardname = addslashes(trim($request->getParameter("cardname")));
		$provcity = addslashes(trim($request->getParameter("provcity")));
		$cardnumber = addslashes(trim($request->getParameter("cardnumber")));
		$cardnumber = str_replace(' ','',$cardnumber);
		$cardtype = addslashes(trim($request->getParameter("cardtype")));

		$sqlcmd = "UPDATE `ntb_user` SET `card_type`='{$cardtype}', `card_name`='{$cardname}', `card_number`='{$cardnumber}', `provcity`='{$provcity}' WHERE `user_id`='{$userid}'";
		$sid = $db->update($sqlcmd);
		
		$db->commit();
		echo '<script type="text/javascript">alert("申请提现成功！请等待审核！");location.href="index.php?module=Cash&action=List";</script>';
	}

	public function getRequestMethods(){
		return Request::POST;
	}

}
?>