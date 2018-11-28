<?php
class M_Relation extends spModel {
	var $pk = "id";
	var $table = "user_relation";

	public function get_level($uid, $level) {
		$relation = $this->find("`uid`={$uid} AND `level`={$level}");
		if ($relation) {
			return $relation['rid'];
		}
		return 0;
	}

	public function get_level_list($uid, $level) {
		$sqlcmd = "SELECT `user`.`id`, `user`.`uplevel`, `user`.`wx_name`, `user`.`wx_headimage` FROM `" . Model('User')->tbl_name ."` AS `user`, `{$this->tbl_name}` AS `relation` WHERE `relation`.`level`={$level} AND `relation`.`rid`={$uid} AND `relation`.`uid`=`user`.`id`";
		return $this->_db->getArray($sqlcmd);
	}
}