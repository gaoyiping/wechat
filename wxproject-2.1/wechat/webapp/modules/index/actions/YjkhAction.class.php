<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class YjkhAction extends Action {
	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$db = DBAction::getInstance();

		$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$userid}'";
		$user = $db->getone($sqlcmd);

		$weekindex = date('W');
		$weekday = array(null, "一", "二", "三", "四", "五", "六", "天");
		$caselevel = array(0, 0, 1, 2, 3, 4);
		$casecount = max($caselevel[$user['uplevel']], 0);

		$sqlcmd = "INSERT INTO `ntb_user_weektask` (`user_id`, `task_week`, `task_case`) SELECT '{$userid}', {$weekindex}, {$casecount} FROM DUAL WHERE NOT EXISTS (SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$userid}' AND task_week={$weekindex})";
		$sid = $db->insert($sqlcmd);

		$sqlcmd = "SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$userid}' AND `task_week`={$weekindex}";
		$mission = $db->getone($sqlcmd);
		$request->setAttribute('casedone',$mission['task_done']);
		$request->setAttribute('casecount',$mission['task_case']);
		$request->setAttribute('caseday', $weekday[$mission['task_day']]);

		$weekindex = $weekindex - 1;
		$sqlcmd = "INSERT INTO `ntb_user_weektask` (`user_id`, `task_week`, `task_case`) SELECT '{$userid}', {$weekindex}, {$casecount} FROM DUAL WHERE NOT EXISTS (SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$userid}' AND task_week={$weekindex})";
		$sid = $db->insert($sqlcmd);

		$sqlcmd = "SELECT * FROM `ntb_user_weektask` WHERE `user_id`='{$userid}' AND `task_week`={$weekindex}";
		$mission = $db->getone($sqlcmd);
		$request->setAttribute('lastcasedone',$mission['task_done']);
		$request->setAttribute('lastcaseday', $weekday[$mission['task_day']]);

		$benefitlevel = array(999999999, 999999999, 10000, 35000, 60000, 60000);
		$benefitlimit = array(0, 0, 30000, 100000, 200000, 200000);
		$sqlcmd = "SELECT SUM(`money`) AS `mp` FROM `ntb_money_point` WHERE (`type`=0 OR `type`=1) AND `userid`='$userid'";
		$result = $db->select($sqlcmd);
		$mp = round($result[0]->mp, 2);
		$sqlcmd = "SELECT SUM(`money`) AS `xz` FROM `ntb_money_point` WHERE `type`=2 AND `userid`='$userid'";
		$result = $db->select($sqlcmd);
		$xz = round($result[0]->xz, 2);
		$bcount = (int)floor($mp / $benefitlevel[$user['uplevel']]);
		$blimit = $bcount * $benefitlimit[$user['uplevel']] + $benefitlimit[$user['uplevel']];
		$sqlcmd = "UPDATE `ntb_user` SET `benefit_count`={$bcount}, `benefit_limit`={$blimit} WHERE `user_id`='{$userid}'";
		$db->query($sqlcmd);
		$request->setAttribute('bvalue', $xz);
		$request->setAttribute('bcount', $bcount);
		$request->setAttribute('blimit', $blimit);

		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>