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
		$condition = "and record.type ='0' and record.mtype =1 ";
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
		$sql = "select count(id) c,sum(amount) amounts from ntb_tuan record " .
			"where 1 $condition";
		$r = $db->select($sql);
		$total = $r[0]->c;
		$amounts = $r[0]->amounts;
		//分页
		$page = intval($request->getParameter("page"));
		$pagesize = 15;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=tuan&ok=$ok&startdate=$startdate&enddate=$enddate";
		$pagehtml = $pager->num_link($url);
		$_SESSION['tuan_url'] = "index.php?$url&page=".$pager->cur_page;
		//分页详情
		$sql = "select record.*,t2.e_mail,t2.mobile from ntb_tuan record,ntb_user t2  where 1 $condition and record.operation = t2.user_id" .
				"	order by record.add_date desc limit $offset,$pagesize";
		
		// EDIT END
		$list = $db->select($sql);
		$request->setAttribute('ok',$ok);
		$request->setAttribute('pageto',$pageto);
		$request->setAttribute('startdate',$startdate);
		$request->setAttribute('enddate',$enddate); 
		$request->setAttribute('list',$list);
		$request->setAttribute('total',$total);
		$request->setAttribute('amounts',$amounts);
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