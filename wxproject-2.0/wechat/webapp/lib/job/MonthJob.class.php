<?php
require_once(MO_LIB_DIR . '/SysConst.class.php');

//每月发荣誉奖金
function monthOrgList($db){	
	//记录发荣誉奖状态
	$month = date('m');
	$monthname = 'MONTH';
	$sql = "select * from ntb_system where name = '$monthname' and value = '$month'";
	$r = $db->select($sql);
	if($r){
		//已经发过组织奖
		return;
	} else {
		//记录已发组织奖
		$sql = "replace ntb_system set value = '$month' ,name = '$monthname'";
		$db->query($sql);
	}
	//选择用户
	$sql = "select user_id from ntb_month_user";
	$r = $db->select($sql);
	if(!$r) { 
		//没有月用户
		return; 
	}
	//计算总发放奖金
	$count = count($r);
	$total_money = (int)(PER_E_MONEY * LEVEL_MONTH_RATE * $count);
	//选择荣誉用户
	$sql = "select user_id from ntb_org where level = 5";
	$r = $db->select($sql);
	if(!$r){
		//如果没有荣誉用户，直接返回，月用户将直接留下来
		return;
	}
	//计算每个荣誉用户发放奖金数
	$count = count($r);
	$per_money = (int)($total_money/$count);
	//发奖
	$liststrs = array();
	$updateusers = array();
	foreach($r as $v){
		$sql = "('".$v->user_id."','','$per_money','5',CURRENT_TIMESTAMP)";
		$liststrs[] = $sql;	
		$updateusers[] = "'".$v->user_id."'";
	}
	$sql_i = "insert into ntb_org_list(to_user_id,from_user_id,amount,level_type,occur_date) ".
		"values ".implode(',',$liststrs);
	$sql_u = "update ntb_user set e_money = e_money+$per_money where user_id in (" .
		implode(',',$updateusers) . ")";
	$sql_t = "truncate table ntb_month_user";
	$db->insert($sql_i);
	$db->update($sql_u);
	$db->query($sql_t);	
}


?>