<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		$sql = "select max(sNo) as sNo,max(add_date) as add_date from ntb_jdmoney";
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
		
		$fuXiaoJieSuanSql = "";
		$db->begin();
		$error=0;
		//见点奖计算
		$sql = "select a.*,b.usertype from ntb_anzhi a left join ntb_user b on (a.node=b.user_id) ";
		$users = $db->select($sql);
		for($i=0;$i<count($users);$i++){
			$x = $users[$i];
			$xuserid= $x->node;
			$xusertype = $x->usertype;
			$level = ($x->level)+10;
			$lt = $x->lt;
			$rt = $x->rt;
			//找出下面的10代
			$sql="select a.*,b.usertype from ntb_anzhi a left join ntb_user b on (a.node=b.user_id) where a.lt>$lt and a.rt<$rt and a.level<=$level";
			$a = $db->select($sql);
			$jie = 0;
			for($j=0;$j<count($a);$j++){
				$y = $a[$j];
				$yusertype = $y->usertype;
				
				if($xusertype==1){
					$jie = $jie+10;
				}
				
				if($xusertype==2 && $yusertype==1){
					$jie = $jie+10;
				}
				
				if($xusertype==2 && $yusertype==2){
					$jie = $jie+30;
				}
				
				if($xusertype==2 && $yusertype==3){
					$jie = $jie+30;
				}
				
				if($xusertype==3 && $yusertype==1){
					$jie = $jie+10;
				}
				
				if($xusertype==3 && $yusertype==2){
					$jie = $jie+30;
				}
				
				if($xusertype==3 && $yusertype==3){
					$jie = $jie+100;
				}
				
			}
			
			$sql="insert into ntb_jdmoney (sNo,userid,jd_money) values ($sNo,'$xuserid',$jie)";
			$r = $db->update($sql);
			if(!$r){$error=1;break;}
		}
		
		if($error > 0){ $db->rollback();}
		else{$db->commit();}
		$this->getContext()->getController()->redirect('index.php?module=fuxiaojiang');
		return;
	}

	


	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>