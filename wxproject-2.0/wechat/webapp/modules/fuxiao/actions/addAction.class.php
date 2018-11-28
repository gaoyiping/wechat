<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//查询当前用户的余额 zmoney
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		$sql = " select z_money from ntb_user where user_id = '$userid' ";
		
		$r = $db->select($sql);
		
		if($r){
			$request->setAttribute("z_money", $r[0]->z_money);
		}
		

		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();		
        
        $hmonth = trim($request->getParameter('hmonth'));
 		$userid = $this->getContext()->getStorage()->read('_user_id');	
 		
 		$db->begin();
 		$rollback = false;
 		
 		$dr = $db->select(" select dianpu from ntb_user where user_id = '$userid' ");
 		$dianpu = $dr[0]->dianpu;
 		
 		$year=date('Y');
        $month = date('m') - 1 ;    
        
        //查询出不足360PV的第一复消数据出来,然后记录这些不足360PV的值
        $sql = " select * from ntb_fuxiao where pv<360 and userid ='$userid' ";
        $r = $db->select($sql);
        $end_pv = array();
        $omonth = 0;
        foreach ($r as $value)
        {
        	$temp_id = $value->id;
        	$temp_pv = $value->pv;
        	$end_pv[] = $value->pv;
        	$arr = explode("-",$value->fuxiaodate);
        	$year = intval($arr[0]);
        	$month = intval($arr[1]);
        	$s = "update ntb_fuxiao set pv=360 where id=$temp_id" ;
        	$ucr = $db->update($s);
			if($ucr == -1){ $rollback = true; }
			$omonth++;
			$hmonth--;
			if($hmonth<=0){
				break;
			}
        }
        
        if($omonth<$hmonth){
        	$hmonth = $hmonth - $omonth;
	        $n = 0;
	        for ($i=0;$i<$hmonth;$i++){
	        	$month ++ ;
	        	 
	        	if($month > 12){
	        		$month = $month - 12;
	        		$year ++;
	        	}
	        	 
	        	if($month < 10){
	        		$fuxiaodate = $year .'-0'.$month;
	        	}else {
	        		$fuxiaodate = $year .'-'.$month;
	        	}
	        	 
	        	//插入数据
	        	$insertsql = " insert into ntb_fuxiao values (null,'$userid','$dianpu',360,'$fuxiaodate',CURRENT_TIMESTAMP)";
	        	$r = $db->insert($insertsql);
	        	if($r == -1){ $rollback = true; }
	        	 
	        }
	        
	        if(count($end_pv) > 0){
	        	for($i=0;$i<count($end_pv);$i++){
		        	$month ++ ;
		        	if($month > 12){
		        		$month = $month - 12;
		        		$year ++;
		        	}
		        	if($month < 10){
		        		$fuxiaodate = $year .'-0'.$month;
		        	}else {
		        		$fuxiaodate = $year .'-'.$month;
		        	}
		        	//插入数据
		        	$insertsql = " insert into ntb_fuxiao values (null,'$userid','$dianpu',$end_pv,'$fuxiaodate',CURRENT_TIMESTAMP)";
		        	$r = $db->insert($insertsql);
		        	if($r == -1){ $rollback = true; }
	        	}
	        }
        }
        
        
        /*
        //先查询下他有没有先录入
 		$sql = " select max(fuxiaodate) m from ntb_fuxiao where userid ='$userid' ";
 		$r = $db->select($sql);   
 		//print_r($r);
 		if($r[0]->m){
 			$maxdate = $r[0]->m;
 			$arr = explode("-",$maxdate);
 			$year = intval($arr[0]);
 			$month = intval($arr[1]);
 		}
        
 		if($month < 10){
 			$fuxiaodate = $year .'-0'.$month;
 		}else {
 			$fuxiaodate = $year .'-'.$month;
 		}
 			
 		$sql = " select *  from ntb_fuxiao where userid ='$userid' and fuxiaodate ='$fuxiaodate'";
 		$r = $db->select($sql);
 		$end_pv = 0;
 		foreach ($r as $value)
 		{
 			$temp_id = $value->id;
 			$temp_pv = $value->pv;
 		}
 		
 		if($r){
 			//将当前数据更新为360,原来的pv放在最末尾
 			if($temp_pv < 360){
 				$end_pv = $temp_pv;
 				$s = "update ntb_fuxiao set pv=360 where id=$temp_id" ;
 				$ucr = $db->update($s);
 				$fpv = 0;
 				if($ucr == -1){ $rollback = true; }
 				$hmonth--;
 			}
 		}
      
       	
       	$n = 0;
        for ($i=0;$i<$hmonth;$i++){       	
        	$month ++ ;
        	
        	if($month > 12){
        		$month = $month - 12;
        		$year ++;
        	}        	
        	
        	if($month < 10){
        		$fuxiaodate = $year .'-0'.$month;
        	}else {
        		$fuxiaodate = $year .'-'.$month;
        	}
        	
        	//插入数据
        	$insertsql = " insert into ntb_fuxiao values (null,'$userid','$dianpu',360,'$fuxiaodate',CURRENT_TIMESTAMP)";
        	$r = $db->insert($insertsql);
       	 	if($r == -1){ $rollback = true; }
        	
        }
        
        if($end_pv > 0){
        	$month ++ ;
        	if($month > 12){
        		$month = $month - 12;
        		$year ++;
        	}
        	if($month < 10){
        		$fuxiaodate = $year .'-0'.$month;
        	}else {
        		$fuxiaodate = $year .'-'.$month;
        	}
        	//插入数据
        	$insertsql = " insert into ntb_fuxiao values (null,'$userid','$dianpu',$end_pv,'$fuxiaodate',CURRENT_TIMESTAMP)";
        	$r = $db->insert($insertsql);
        	if($r == -1){ $rollback = true; }
        }
		*/
        //当次消耗z_money
        $z_money = 360*$hmonth;
        $updatesql = " update ntb_user set z_money = z_money - '$z_money' where user_id ='$userid' ";
        $ur = $db->update($updatesql);
		if($ur == -1){ $rollback = true; }
        
        if($rollback == false ){
        	$db->commit();
        	header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('复消录入成功！');" .
				"location.href='index.php?module=fuxiao&action=add';</script>";
        }else{
        	$db->rollback();
        	header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，复消录入失败！');" .
				"</script>";
			return $this->getDefaultView();
        }
		return;
	}
	

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>