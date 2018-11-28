<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
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
		$userid = $request->getParameter("userid");
		$buserid = $request->getParameter("buserid");
		//条件
		$condition = '';
		if($ok == 0){
			$condition .= "and status = 0 ";
		} else if($ok == 1){
			$condition .= "and status = 1 ";
		}
		 else if($ok == 2){
			$condition .= "and status = 2 ";
		}
		else
		{
			$condition .= "and status = 0 ";
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
		$url = "module=HandleOrder&ok=$ok&startdate=$startdate&enddate=$enddate&userid=$userid";
		$pagehtml = $pager->num_link($url);
		$_SESSION['handleretail_url'] = "index.php?$url&page=".$pager->cur_page;
		//分页详情
		if($pageto == 'all'){
			$sql = "select a.*,(select G_CName from admin_cg_group s1 where s1.GroupID=a.sheng ) as s1,(select G_CName from admin_cg_group s2 where s2.GroupID=a.shi ) as s2,(select G_CName from admin_cg_group s3 where s3.GroupID=a.xian ) as s3  from ntc_rorder a where 1 $condition order by id desc ";

		} else {
			$sql = "select a.*,(select G_CName from admin_cg_group s1 where s1.GroupID=a.sheng ) as s1,(select G_CName from admin_cg_group s2 where s2.GroupID=a.shi ) as s2,(select G_CName from admin_cg_group s3 where s3.GroupID=a.xian ) as s3  from ntc_rorder a where 1 $condition order by id desc limit $offset,$pagesize";

		}
		
		$tmp_list = $db->select($sql);
	foreach($tmp_list as $key => $value)
		{
			$sNo = $value->sNo;
			
			$sql = "select * from admin_cg_kucun  where  rliushui='$sNo'";
			$rr = $db->selectarray($sql);
			if($rr)
			{
				$tmp_list[$key]->details = $rr;
			}
		
				
		
		
		}
		$request->setAttribute('ok',$ok);
		$request->setAttribute('pageto',$pageto);
		$request->setAttribute('startdate',$startdate);
		$request->setAttribute('enddate',$enddate); 
		$request->setAttribute('list',$tmp_list);
		$request->setAttribute('userid',$userid);
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