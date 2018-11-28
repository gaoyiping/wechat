<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		//计算月用户总数
		$sql = "select max(sNo) as sNo,max(add_date) as add_date from ntb_lingshoujiesuan";
		$r = $db->select($sql);
		if($r)
		{
		  $request->setAttribute('info', $r[0]);
		}

		return View :: INPUT;
	}

	public function execute() {
		$db = DBAction::getInstance();
		$request = $this->getContext ()->getRequest ();
		$sNo = intval ( $request->getParameter ( 'sNo' ) );
		
		$ym = date("Y-m");
		
		$lingshouJieSuanSql = "";
		
		$sql = "SELECT user_id,sum(emoneys) moneys FROM ntc_rorder WHERE add_date like '%$ym%' group by user_id";
		$lingshous = $db->select($sql);
		foreach ( $lingshous as $lingshou ) {
			$uid = $lingshou->user_id;
			
			//>>判断该会员有没有零售奖开关
			$temp_sql = "select * from ntb_user where user_id='$uid'";
			$r = $db->select ( $temp_sql );
			if($r[0]->jjkg){
				$jjkg = unserialize($r[0]->jjkg);
				$f5 = false;
				for($i=0;$i<count($jjkg);$i++){
					if($jjkg[$i]==5) $f5=true;
				}
				if(!$f5) continue;
			}
			//<<
			
			$lsjf = (($lingshou->moneys)*0.3)*E_PV; 
			
			//查询会员  当期是否已经结算
			$sql = "SELECT * FROM ntb_lingshoujiesuan WHERE userid ='$uid' AND lingshoudate = '$ym'";
			$isOver = $db->select($sql);
			
			if($isOver){
				continue;
			}
			
			//会员所得复消奖计算完毕，插入ntb_lingshoujiesuan 表中
			$lingshouJieSuanSql .="($sNo,'$uid',$lsjf,$lsjf,'$ym'),";
			
		}
		
		$db->begin();
		$lingshouJieSuanSql = substr($lingshouJieSuanSql, 0,strlen($lingshouJieSuanSql)-1);
		$r = $db->insert(" INSERT INTO ntb_lingshoujiesuan (sNo,userid,f_money,s_money,lingshoudate) VALUES $lingshouJieSuanSql ");
		if($r == -1){ $db->rollback();}
		else{$db->commit();}
		
		
		
		$this->getContext()->getController()->redirect('index.php?module=lingshoujiang');
		return;
	}

	


	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>