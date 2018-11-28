<?php
class M_TaskUser extends spModel {
	var $pk = "id";
	var $table = "task_user";

	function add_task($uid, $price) {
		$yearindex = date("Y");
		$monthindex = date("n");
		$weekindex = date("W");
		$result = $this->find("`uid`={$uid} AND `task_year`={$yearindex} AND `task_month`={$monthindex} AND `task_week`={$weekindex}");
		if ($result) {
			$this->updateField("`uid`={$uid} AND `task_year`={$yearindex} AND `task_month`={$monthindex} AND `task_week`={$weekindex}", 'task_value', $price);
		} else {
			$sqldata = array('uid'=> $uid, 'task_year'=> $yearindex, 'task_week'=> $weekindex, 'task_month'=> $monthindex, 'task_value'=> $price);
			$this->create($sqldata);
		}
	}
}
