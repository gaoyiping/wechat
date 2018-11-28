<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//取得参数
		$ok = intval($request->getParameter("ok"));
		$startdate = $request->getParameter("startdate");
		$enddate = $request->getParameter("enddate");
		$pageto = $request->getParameter("pageto");
		//条件
		$condition = "and record.type ='4' and record.mtype is NULL ";
		if($ok == 0){
			$condition .= "and record.status = 0 ";
		} else {
			$condition .= "and record.status = 1 ";
		}
		if($startdate != ''){
			$condition .= "and record.add_date >= '$startdate 00:00:00' ";
		}
		if($enddate != ''){
			$condition .= "and record.add_date <= '$enddate 23:59:59' ";
		}
		//总计,提现总额总计
		$sql = "select count(id) c,sum(amount) amounts from ntb_record record " .
			"where 1 $condition";
		$r = $db->select($sql);
		$total = $r[0]->c;
		$amounts = $r[0]->amounts;
		//分页
		$page = intval($request->getParameter("page"));
		$pagesize = 15;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=TiXiandanbao&ok=$ok&startdate=$startdate&enddate=$enddate";
		$pagehtml = $pager->num_link($url);
		$_SESSION['tixiandanbao_url'] = "index.php?$url&page=".$pager->cur_page;
		//分页详情
		// EDIT BY FLY AT 2010-10-8
		if($pageto == 'all'){
			$sql = "select record.*,t2.byhname,t2.byinhang,t2.byhsNo,t2.btel,t2.byinhangdiqu " .
				"from ntb_record record ,admin_cg_danbao t2 " .
				"where 1 $condition and record.operation = t2.bloginID ";
		} else {
			$sql = "select t1.*,t2.byhname,t2.byinhang,t2.byhsNo,t2.btel,t2.byinhangdiqu " .
				"from ( " .
				"	select * from ntb_record record where 1 $condition " .
				"	order by add_date desc limit $offset,$pagesize) t1,admin_cg_danbao t2 " .
				"where t1.operation = t2.bloginID";
		}
		// EDIT END
		$list = $db->select($sql);
		$this->countPageAmounts($list,$pageamounts);
		//
		$request->setAttribute('ok',$ok);
		$request->setAttribute('pageto',$pageto);
		$request->setAttribute('startdate',$startdate);
		$request->setAttribute('enddate',$enddate); 
		$request->setAttribute('list',$list);
		$request->setAttribute('total',$total);
		$request->setAttribute('amounts',$amounts);
		$request->setAttribute('pageamounts',$pageamounts);
		$request->setAttribute('pagehtml',$pagehtml);
		return View :: INPUT;
	}

	public function countPageAmounts(&$list,&$pageamounts){
		$pageamounts = 0;
		foreach($list as $v){
			$pageamounts = $pageamounts + $v->amount;
		}
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>