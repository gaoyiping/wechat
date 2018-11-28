<?php
class M_RecordPoint extends spModel {
	var $pk = "id";
	var $table = "record_point";
	/*
	积分类型
	1 可兑换积分(Point_Gold)购买消耗
	2 绩效&提成
	*/

	function get_ddjf($uid) {
		$sqldata = "SELECT SUM(`point_less`) AS `point_less` FROM `" . $this->tbl_name . "` WHERE `rid`={$uid} AND `deeplevel`<=2";
		$result = $this->findSql($sqldata);
		if ($result) {
			$result = array_pop($result);
			return $result['point_less'];
		}
		return 0.00;
	}

	function get_xifen($uid) {
		$sqldata = "SELECT SUM(`point_less`) AS `point_less` FROM `" . $this->tbl_name . "` WHERE `rid`={$uid} AND `deeplevel`>2";
		$result = $this->findSql($sqldata);
		if ($result) {
			$result = array_pop($result);
			return $result['point_less'];
		}
		return 0.00;
	}
}