<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
class IndexAction extends Action {

	public function getDefaultView() {
		
		if($_SESSION['_admin_atype']!=1 && !in_array("d4",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();
        
		$sql = "select sum(moneys) m  from ntc_rorder ";
		$r1 = $db->select($sql);
		$yeji = $r1[0]->m;
		
		
		$sql = "select sum(s_money) m  from ntb_money_point ";
		$r1 = $db->select($sql);
		$zongjin = $r1[0]->m;
		
		//计算今日总业绩
		$today = date("Y-m-d");
		$sql = "select sum(moneys) m  from ntc_rorder  where  add_date >= '$today 00:00:00' and add_date <= '$today 23:59:59'";
		$r1 = $db->select($sql);
		$todayyeji = $r1[0]->m;

		$request->setAttribute('todayyeji',$todayyeji);
		$request->setAttribute('huiyuan',$zongjin);
		$request->setAttribute('zongjin',($zongjin/$yeji)*100);
		$request->setAttribute('yeji',$yeji);
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>