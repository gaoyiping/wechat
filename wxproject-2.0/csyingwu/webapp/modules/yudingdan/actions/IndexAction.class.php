<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		if($_SESSION['_admin_atype']!=1 && !in_array("c7",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//取得参数
		$ok = intval($request->getParameter("ok"));
		$startdate = $request->getParameter("startdate");
		$enddate = $request->getParameter("enddate");
		$pageto = $request->getParameter("pageto");
		$userid = $request->getParameter("userid");
		$buserid = $request->getParameter("buserid");
		//条件
		$condition = '';
		if($ok == 3){
			$condition .= "and status = 3 ";
		} else if($ok == 4){
			$condition .= "and status = 4 ";
		}
		 else if($ok == ""){
			$condition .= "and (status = 2 or status = 1 or status = 0) ";
		}
		else
		{
		 
		}
		if($startdate != ''){
			$condition .= "and add_date >= '$startdate 00:00:00' ";
		}
		if($enddate != ''){
			$condition .= "and add_date <= '$enddate 23:59:59' ";
		}
		if($userid != ''){
			$condition .= "and user_id = '$userid' ";
		}

		if($buserid != ''){
			$condition .= "and rdesc like '%$buserid%' ";
		}
		//总计
		$sql = "select count(id) c, sum(emoneys) m from ntc_rorder t1 where 1 $condition order by add_date desc";
		$r = $db->select($sql);
		$total = $r[0]->c;
		//$totalemoneys = $r[0]->m;
		//分页
		$page = intval($request->getParameter("page"));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=yudingdan&ok=$ok&startdate=$startdate&enddate=$enddate";
		$pagehtml = $pager->num_link($url);
		$_SESSION['handleretail_url'] = "index.php?$url&page=".$pager->cur_page;
		//分页详情
		if($pageto == 'all'){
			$sql = "select * from ntc_rorder where 1 $condition " .
				"	order by add_date desc"; 
		} else {
			$sql = "select * from ntc_rorder where 1 $condition order by user_id desc limit $offset,$pagesize";
			
		}
		
		$tmp_list = $db->select($sql);
	
		$request->setAttribute('ok',$ok);
		$request->setAttribute('pageto',$pageto);
		$request->setAttribute('startdate',$startdate);
		$request->setAttribute('enddate',$enddate); 
		$request->setAttribute('list',$tmp_list);
		//$request->setAttribute('total',$total);
		//$request->setAttribute('totalemoneys',$totalemoneys);
		//$request->setAttribute('pageemoneys',$pageemoneys);
		$request->setAttribute('pagehtml',$pagehtml);
		return View :: INPUT;
	}

	

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>