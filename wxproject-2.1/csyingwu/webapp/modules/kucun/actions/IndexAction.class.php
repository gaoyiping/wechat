<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		$keyword = $request->getParameter("keyword");
		$startdate = $request->getParameter("startdate");
		$enddate = $request->getParameter("enddate");
        $condition="";

		if($keyword != ''){
			$condition .= " and  (rsNo like '%".$keyword."%' or rname like '%".$keyword."%') ";
		}


		if($startdate != ''){
			$condition .= " and pubdate >= '$startdate 00:00:00' ";
		}
		if($enddate != ''){
			$condition .= " and pubdate <= '$enddate 23:59:59' ";
		}

		$sql = "select count(rid) c from admin_cg_kucun where rtype=1 $condition ";
		$r = $db->select($sql);	
		//分页
		$total = intval($r[0]->c);
		$page = intval($request->getParameter('page'));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$pagehtml = $pager->num_link("module=kucun&keyword=$keyword&startdate=$startdate&enddate=$enddate");
		//详情
		$sql = "select * " .
			"from admin_cg_kucun where rtype=1 $condition order by rID desc limit $offset,$pagesize";
		$r = $db->select($sql);
		//处理价格格式
		
		$request->setAttribute("rpros",$r);
		$request->setAttribute("pagehtml",$pagehtml);
			$request->setAttribute("keyword",$keyword);
		$request->setAttribute("startdate",$startdate);
		$request->setAttribute("enddate",$enddate);
		return View :: INPUT;
		
	}

	public function execute() {

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>