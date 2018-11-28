<?php
class M_TaskTotal extends spModel {
	var $table = "task_total";

	function add_task($price) {
		$yearindex = date("Y");
		$weekindex = date("W");
		$monthindex = date("n");
		$sqlcmd = "UPDATE `{$this->tbl_name}` SET `task_value`=`task_value`+{$price} WHERE `task_year`={$yearindex} AND `task_month`={$monthindex} AND `task_week`={$weekindex}";
		return $this->runSql($sqlcmd);
	}
}
