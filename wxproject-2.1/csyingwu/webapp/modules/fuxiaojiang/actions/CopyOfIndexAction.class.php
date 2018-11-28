<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		//�������û�����
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
		
		//��ѯ�����е����Ѿ��������Ļ�Ա
		$sql = "SELECT * FROM ntb_fuxiao WHERE fuxiaodate = '$ym'";
		$users = $db->select($sql);
		foreach ( $users as $user ) {
			$uid = $user->userid;
			$fuxiao = 0.00;
			//��ѯ��Ա  �����Ƿ��Ѿ�����
			$sql = "SELECT * FROM ntb_fuxiaojiesuan WHERE userid ='$uid' AND fuxiaodate = '$ym'";
			$isOver = $db->select($sql);
			
			if($isOver){
				continue;
			}
			
			//��ѯ��Ա ��lt rt����
			$sql ="SELECT * FROM ntb_user_ref WHERE node='$uid'";
			$lr = $db->select($sql);
			$lt = $lr[0]->lt;
			$rt = $lr[0]->rt;
			
			//��ѯ��Ա�Ŀ���   1: �տ���Ա  2: ������Ա  3: �𿨻�Ա  4: �꿨��Ա   5: VIP��Ա
			$sql = "select usertype from ntb_user where user_id='$uid'";
			$objArray = $db->select($sql);
			$userLevel = $objArray[0]->usertype;
			
			//���ݻ�Ա����ó�������������¼���Ա��
			$level = 1 ;
			if($userLevel == 1){ $level = 11;}
			if($userLevel == 2){ $level = 13;}
			if($userLevel == 3){ $level = 15;}
			if($userLevel == 4 || $userLevel == 5){ $level = 17;}
			$maxChildrenQuantity = 0;
			for($i=1;$i<=$level;$i++){
				$maxChildrenQuantity=$maxChildrenQuantity+pow(3,$i);
			}
			
			//ʵ���¼���Ա������������
			$sql = "SELECT count(id) N FROM ntb_fuxiao T WHERE T.userid in (SELECT a.node
			FROM ntb_user_ref a
			LEFT JOIN ntb_user b ON a.node = b.user_id
			WHERE a.lt >$lt
			AND a.rt <$rt) AND T.fuxiaodate = '$ym' AND T.pv >= ".FX;
			$children = $db->select($sql);
			$childrenQuantity= $children[0]->N;
			
			//����û�Ա���¼��Ѿ������˸������������ڵ��� $maxChildrenQuantity
			if($childrenQuantity >= $maxChildrenQuantity){
				$fuxiao = ($maxChildrenQuantity*FX*FXJJBL);
			}else{
				$fuxiao = ($childrenQuantity*FX*FXJJBL);
			}
			
			//>>�жϸû�Ա��û�и���������
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
			//��Ա���ø�����������ϣ�����ntb_fuxiaojiesuan����
			$fuXiaoJieSuanSql .="($sNo,'$uid',$fuxiao,$fuxiao,'$ym'),";
			
		}
		
		$db->begin();
		$fuXiaoJieSuanSql = substr($fuXiaoJieSuanSql, 0,strlen($fuXiaoJieSuanSql)-1);
		$r = $db->insert(" INSERT INTO ntb_fuxiaojiesuan (sNo,userid,f_money,s_money,fuxiaodate) VALUES $fuXiaoJieSuanSql ");
		if($r == -1){ $db->rollback();}
		else{$db->commit();}
		
		
		
		
		
		//�����������>>>>>>start
		/*
		 	
		foreach($children as $row)
		{
			$node = $row->node;
			$insertSql = "insert into ntb_fuxiao (userid,dianpu,pv,fuxiaodate,adddate) values ('$node','100001',360,now(),now())";
			$db->insert($insertSql);
		}
		*/
		//�����������<<<<<<<end
		
		$this->getContext()->getController()->redirect('index.php?module=fuxiaojiang');
		return;
	}

	


	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>