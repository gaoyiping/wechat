<?php
class M_User extends spModel {
	var $pk = "id";
	var $table = "user";

	public function upcount($uid, $count) {
		$sqlcmd = "UPDATE {$this->tbl_name} SET `upcount`={$count} WHERE `id`={$uid}";
		return $this->_db->exec($sqlcmd);
	}

	public function uplevel($uid, $level) {
		Model('RecordUplevel')->create(array('uid'=> $uid, 'uplevel'=> $level, 'record_time'=> time()));
		$sqlcmd = "UPDATE {$this->tbl_name} SET `uplevel`={$level} WHERE `id`={$uid}";
		return $this->_db->exec($sqlcmd);
	}

	public function check_uplevel($uid) {
		$user = Model('User')->find(array('id'=> $uid));
		$uplevel = $user['uplevel'];
		$lv1 = Model('Relation')->findCount(array('rid'=> $uid, 'level'=> 1));
		if ($lv1 >= 7) {
			if ($lv1 >= 15) {
				if ($lv1 >= 30) {
					$lv2 = Model('Relation')->findCount(array('rid'=> $uid, 'level'=> 2));
					$lv3 = Model('Relation')->findCount(array('rid'=> $uid, 'level'=> 3));
					$user['point_ddjf'] += Model('RecordPoint')->get_ddjf($uid);
					$user['point_xifen'] += Model('RecordPoint')->get_xifen($uid);
					if ($lv1 + $lv2 + $lv3 >= 3000 && $score >= 200000) {
						return $uplevel != 5 && $this->uplevel($uid, 5);
					}
					if ($lv1 + $lv2 + $lv3 >= 1000 && $score >= 50000) {
						return $uplevel != 4 && $this->uplevel($uid, 4);
					}
					if ($lv1 + $lv2 + $lv3 >= 600 && $score >= 30000) {
						return $uplevel != 3 && $this->uplevel($uid, 3);
					}
					return $uplevel != 2 && $this->uplevel($uid, 2);
				}
				return $uplevel != 7 && $this->uplevel($uid, 7);
			}
			return $uplevel != 6 && $this->uplevel($uid, 6);
		}
	}
}