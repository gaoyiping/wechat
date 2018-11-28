<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//取得参数
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$startdate = $request->getParameter("startdate");
		$enddate = $request->getParameter("enddate");
		$pageto = $request->getParameter("pageto");
	
		$buserid = $request->getParameter("buserid");
		//条件
		$condition = '';
		
		if($startdate != ''){
			$condition .= "and add_date >= '$startdate 00:00:00' ";
		}
		if($enddate != ''){
			$condition .= "and add_date <= '$enddate 23:59:59' ";
		}
		

		if($buserid != ''){
			$condition .= "and rdesc like '%$buserid%' ";
		}

				$sql2 = "select (select count(id ) from ntc_rorder where   user_id='$userid') as num1,"
		."(select count(id ) from ntc_rorder where status=1 and user_id='$userid') as num2, "
		."(select count(id ) from ntc_rorder where status=2 and user_id='$userid') as num3, "
		."(select count(id ) from ntc_rorder where status=3 and user_id='$userid') as num4, "
		."(select count(id ) from user_weitongguo where user_id='$userid') as num5 ";
		$r2 = $db->select($sql2);

		if($r2)
		{
		  $request->setAttribute('num',$r2[0]);
		}


		//总计
		$sql = "select count(id) c, sum(emoneys) m from user_weitongguo t1 where user_id='$userid' $condition order by add_date desc";
		$r = $db->select($sql);
		$total = $r[0]->c;
		//$totalemoneys = $r[0]->m;
		//分页
		$page = intval($request->getParameter("page"));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=weitongguo&startdate=$startdate&enddate=$enddate";
		$pagehtml = $pager->num_link($url);
		$_SESSION['handleretail_url'] = "index.php?$url&page=".$pager->cur_page;
		//分页详情
		if($pageto == 'all'){
			$sql = "select * from user_weitongguo where user_id='$userid'  $condition " .
				"	order by add_date desc"; 
		} else {
			$sql = "select * from user_weitongguo where user_id='$userid'  $condition order by user_id desc limit $offset,$pagesize";
			
		}
		
		$tmp_list = $db->select($sql);
	

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