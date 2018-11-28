<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class rqAction extends Action {
	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$pid = trim($request->getParameter("pid"));
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$db = DBAction::getInstance();

		$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$userid}'";
		$user = $db->getone($sqlcmd);

		$uplevel = intval($request->getParameter("uplevel"));
		$uplevel = min(max($uplevel, 1), 3);

		$level1 = $this->getCount1($db, $userid);
		$level2 = $this->getCount2($db, $userid);
		$level3 = $this->getCount3($db, $userid);
		$sqlcmd = "UPDATE `ntb_user` SET `t1`={$level1}, `t2`={$level2}, `t3`={$level3} WHERE `user_id`='{$userid}'";
		$db->update($sqlcmd);

		if ($uplevel == 1) {
			$userlist = $this->getRelation1($db,$userid);
		}
		if ($uplevel == 2) {
			$userlist = $this->getRelation2($db,$userid);
		}
		if ($uplevel == 3) {
			$userlist = array();
		}
		$request->setAttribute('Level1', $level1);
		$request->setAttribute('Level2', $level2);
		$request->setAttribute('Level3', $level3);
		$request->setAttribute('userlist', $userlist);
		$request->setAttribute('uplevel', $uplevel);
		return View::INPUT;
	}

	function getRelation1($db, $userid) {
		$sqlcmd = "SELECT `e_money`, `uplevel`, `wxname`, `headimgurl` FROM `ntb_user` WHERE `pid`='{$userid}' AND `uplevel`>0 ORDER BY `e_money` DESC";
		$relation = $db->select($sqlcmd);
		return $relation;
	}

	function getCount1($db, $userid) {
		$sqlcmd = "SELECT SUM(`upcount`) AS `count` FROM `ntb_user` WHERE `pid`='{$userid}' AND `uplevel`>0 ORDER BY `e_money` DESC";
		$relation = $db->getone($sqlcmd);
		return $relation['count'];
	}

	function getRelation2($db, $userid) {
		$sqlcmd = "SELECT `e_money`, `uplevel`, `wxname`, `headimgurl` FROM `ntb_user` WHERE `pid` IN (SELECT `user_id` FROM `ntb_user` WHERE `pid`='{$userid}' AND `uplevel`>0) AND `uplevel`>0 ORDER BY `e_money` DESC";
		$relation = $db->select($sqlcmd);
		return $relation;
	}

	function getCount2($db, $userid) {
		$sqlcmd = "SELECT SUM(`upcount`) AS `count` FROM `ntb_user` WHERE `pid` IN (SELECT `user_id` FROM `ntb_user` WHERE `pid`='{$userid}' AND `uplevel`>0) AND `uplevel`>0 ORDER BY `e_money` DESC";
		$relation = $db->getone($sqlcmd);
		return $relation['count'];
	}

	function getRelation3($db, $userid) {
		$sqlcmd = "SELECT SUM(`upcount`) FROM `ntb_user` WHERE `pid` IN (SELECT `user_id` FROM `ntb_user` WHERE `pid` IN (SELECT `user_id` FROM `ntb_user` WHERE `pid`='{$userid}' AND `uplevel`>0) AND `uplevel`>0) AND `uplevel`>0 ORDER BY `e_money` DESC";
		$relation = $db->select($sqlcmd);
		return $relation;
	}
	function getCount3($db, $userid) {
		$sqlcmd = "SELECT SUM(`upcount`) AS `count` FROM `ntb_user` WHERE `pid` IN (SELECT `user_id` FROM `ntb_user` WHERE `pid` IN (SELECT `user_id` FROM `ntb_user` WHERE `pid`='{$userid}' AND `uplevel`>0) AND `uplevel`>0) AND `uplevel`>0 ORDER BY `e_money` DESC";
		$relation = $db->getone($sqlcmd);
		return $relation['count'];
	}

	public function execute(){		
	}

	public function getRequestMethods(){
		return Request::NONE;
	}

}

?>