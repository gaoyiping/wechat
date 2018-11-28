<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

//每天升级
function daliyLevelUp($db){
	$now = date('Y-m-d H:i:s');
	//选择可升级用户
	$sql = "select id,up_user_id,up_to_level from ntb_org_up t2 " .
		"where status = '0' and up_date <= '$now' " ;
	$r = $db->select($sql);
	if(!$r) {
		return;
	}
	//升级
	foreach($r as $v){
		$upid = $v->id;
		$upuserid = $v->up_user_id;
		$uplevel = $v->up_to_level;
		$sql_u1 = "update ntb_org set level = '$uplevel',level_date = CURRENT_TIMESTAMP " .
			"where user_id = '$upuserid' and level < '$uplevel'";
		$sql_u2 = "update ntb_org_up set status = 1 where id = '$upid'";
		$db->update($sql_u1);
		$db->update($sql_u2);
	}
}


?>