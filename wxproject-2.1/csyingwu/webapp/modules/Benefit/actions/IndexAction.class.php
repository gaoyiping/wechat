<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
class IndexAction extends Action {
	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		$total = 0.0;
		$sqlcmd = "SELECT * FROM `ntb_user_benefit` WHERE `benefit_less`>0.1 ORDER BY `id` ASC";
		$benefitlist = $db->select($sqlcmd);
		foreach ($benefitlist as $benefit) {
			$total += $benefit->benefit_once;
		}
		$request->setAttribute("total", $total);
		$request->setAttribute("benefitlist", $benefitlist);
		return View::INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$sqlcmd = "SELECT * FROM `ntb_user_benefit` WHERE `benefit_less`>0 ORDER BY `user_id` ASC";
		$benefitlist = $db->select($sqlcmd);

		header('Content-Type: text/html;charset=utf-8');
		$db->begin();
		foreach ($benefitlist as $benefit) {
			$count = round($benefit->benefit_less - $benefit->benefit_once, 2);
			if ($count >= -0.5) {
				$sqlcmd = "UPDATE `ntb_user_benefit` SET `benefit_less`={$count} WHERE `user_id`='{$benefit->user_id}'";
				$sid = $db->update($sqlcmd);
				if ($sid == -1) {
					$db->rollback();
					exit("<script type='text/javascript'>alert('积分调整失败！');location.href='index.php?module=Benefit';</script>");
				}
				$sqlcmd = "UPDATE `ntb_user` SET `j_money`=`j_money`+{$benefit->benefit_once} WHERE `user_id`='{$benefit->user_id}'";
				$sid = $db->update($sqlcmd);
				if ($sid == -1) {
					$db->rollback();
					exit("<script type='text/javascript'>alert('积分添加失败！');location.href='index.php?module=Benefit';</script>");
				}
			}
		}
		$db->commit();
		exit("<script type='text/javascript'>alert('分红成功！');location.href='index.php?module=Benefit';</script>");
	}

	public function getRequestMethods() {
		return Request::POST;
	}
} 