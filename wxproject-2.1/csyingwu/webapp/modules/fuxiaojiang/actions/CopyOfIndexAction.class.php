<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		//计算月用户总数
		$sql = "select max(sNo) as sNo,max(add_date) as add_date  from ntb_fuxiaojiesuan";
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
		$fuXiaoJieSuanSql = "";
		
		//查询出所有当月已经购买复消的会员
		$sql = "SELECT * FROM ntb_fuxiao WHERE fuxiaodate = '$ym'";
		$users = $db->select($sql);
		foreach ( $users as $user ) {
			$uid = $user->userid;
			$fuxiao = 0.00;
			//查询会员  当期是否已经结算
			$sql = "SELECT * FROM ntb_fuxiaojiesuan WHERE userid ='$uid' AND fuxiaodate = '$ym'";
			$isOver = $db->select($sql);
			
			if($isOver){
				continue;
			}
			
			//查询会员 的lt rt数据
			$sql ="SELECT * FROM ntb_user_ref WHERE node='$uid'";
			$lr = $db->select($sql);
			$lt = $lr[0]->lt;
			$rt = $lr[0]->rt;
			
			//查询会员的卡别   1: 普卡会员  2: 银卡会员  3: 金卡会员  4: 钻卡会员   5: VIP会员
			$sql = "select usertype from ntb_user where user_id='$uid'";
			$objArray = $db->select($sql);
			$userLevel = $objArray[0]->usertype;
			
			//根据会员卡别得出最大层数及最大下级会员数
			$level = 1 ;
			if($userLevel == 1){ $level = 11;}
			if($userLevel == 2){ $level = 13;}
			if($userLevel == 3){ $level = 15;}
			if($userLevel == 4 || $userLevel == 5){ $level = 17;}
			$maxChildrenQuantity = 0;
			for($i=1;$i<=$level;$i++){
				$maxChildrenQuantity=$maxChildrenQuantity+pow(3,$i);
			}
			
			//实际下级会员购买复消的数量
			$sql = "SELECT count(id) N FROM ntb_fuxiao T WHERE T.userid in (SELECT a.node
			FROM ntb_user_ref a
			LEFT JOIN ntb_user b ON a.node = b.user_id
			WHERE a.lt >$lt
			AND a.rt <$rt) AND T.fuxiaodate = '$ym' AND T.pv >= ".FX;
			$children = $db->select($sql);
			$childrenQuantity= $children[0]->N;
			
			//如果该会员的下级已经购买了复消的人数大于等于 $maxChildrenQuantity
			if($childrenQuantity >= $maxChildrenQuantity){
				$fuxiao = ($maxChildrenQuantity*FX*FXJJBL);
			}else{
				$fuxiao = ($childrenQuantity*FX*FXJJBL);
			}
			
			//>>判断该会员有没有复消奖开关
			$temp_sql = "select * from ntb_user where user_id='$uid'";
			$r = $db->select ( $temp_sql );
			if($r[0]->jjkg){
				$jjkg = unserialize($r[0]->jjkg);
				$f3 = false;
				for($i=0;$i<count($jjkg);$i++){
					if($jjkg[$i]==3) $f3=true;
				}
				if(!$f3) continue;
			}
			//<<
			
			if($fuxiao<=0) continue;
			//会员所得复消奖计算完毕，插入ntb_fuxiaojiesuan表中
			$fuXiaoJieSuanSql .="($sNo,'$uid',$fuxiao,$fuxiao,'$ym'),";
			
		}
		
		$db->begin();
		$fuXiaoJieSuanSql = substr($fuXiaoJieSuanSql, 0,strlen($fuXiaoJieSuanSql)-1);
		$r = $db->insert(" INSERT INTO ntb_fuxiaojiesuan (sNo,userid,f_money,s_money,fuxiaodate) VALUES $fuXiaoJieSuanSql ");
		if($r == -1){ $db->rollback();}
		else{$db->commit();}
		
		
		
		
		
		//插入测试数据>>>>>>start
		/*
		 	
		foreach($children as $row)
		{
			$node = $row->node;
			$insertSql = "insert into ntb_fuxiao (userid,dianpu,pv,fuxiaodate,adddate) values ('$node','100001',360,now(),now())";
			$db->insert($insertSql);
		}
		*/
		//插入测试数据<<<<<<<end
		
		$this->getContext()->getController()->redirect('index.php?module=fuxiaojiang');
		return;
	}

	


	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>