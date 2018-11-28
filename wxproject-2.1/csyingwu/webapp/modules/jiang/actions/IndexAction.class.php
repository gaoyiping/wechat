<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		if($_SESSION['_admin_atype']!=1 && !in_array("b1",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		$sql = "select max(sNo) as sNo,max(add_date) as add_date from ntb_money";
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
		
		//初始
		$sql = "select user_id from ntb_user";
		$yun = $db->select($sql);
		for($i=0;$i<count($yun);$i++){
			$u = $yun[$i];
			$uuserid= $u->user_id;
			$sql="select count(*) cn from ntb_money where sNo=$sNo and userid='$uuserid'";
			$aa = $db->select($sql);
			if($aa[0]->cn == 0){
				$sql="insert into ntb_money (sNo,userid) values ($sNo,'$uuserid')";
			}
			$r = $db->update($sql);
			if(!$r){$error=1111;break;}
		}
		
		//开拓奖计算
		$sql = "select userid, sum(pv) pv from  ntb_kaituojiang  where isf=0 group by userid";
		$kaituo = $db->select($sql);
		for($i=0;$i<count($kaituo);$i++){
			$k = $kaituo[$i];
			$kuserid= $k->userid;
			$kpv = $k->pv;
			$sql="select count(*) cn from ntb_money where sNo=$sNo and userid='$kuserid'";
			$c = $db->select($sql);
			if($c[0]->cn == 0){
				$sql="insert into ntb_money (sNo,userid,kaituo_money) values ($sNo,'$kuserid',$kpv)";
			}else{
				$tax = 0.03 * $kpv;
				$sql="update ntb_money set kaituo_money = kaituo_money +$kpv,tax_money=tax_money+$tax  where sNo=$sNo and userid='$kuserid'";
			}
			$r = $db->update($sql);
			
			if(!$r){$error=5;break;}
		}
		
		$sql="update ntb_kaituojiang set isf=1 where isf=0";
		$r = $db->update($sql);
		
		if($error > 0){ $db->rollback();}
		else{$db->commit();}
		//echo $error;exit;
		$this->getContext()->getController()->redirect('index.php?module=jiang');
		return;
	}

	


	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>