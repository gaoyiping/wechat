<?php
class relation extends spMagic {
	function index(){
		$uid = $this->get_uid();
		$relationlist = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
		for ($deeplevel = 0; $deeplevel < 12; $deeplevel++) {
			$count = Model('Relation')->findCount(array('rid'=> $uid, 'level'=> $deeplevel + 1));
			if ($count > 0) {
				$relationlist[$deeplevel] = $count;
			} else {
				break;
			}
		}
		$this->relationlist = $relationlist;
		$this->display('relation-index.html');
	}

	function showlevel() {
		$uid = $this->get_uid();
		$level = $this->spArgs('level');
		if ($level) {
			$relationlist = Model('Relation')->get_level_list($uid, $level);
			$this->relationlist = $relationlist;
			$this->display('relation-list.html');
		}
	}
}