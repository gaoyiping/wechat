<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		//查询参数
		$keyword = addslashes(trim($request->getParameter('keyword')));
		$phone = addslashes(trim($request->getParameter('phone')));
		$p_node = addslashes(trim($request->getParameter('p_node')));
		$uplevel = addslashes(trim($request->getParameter('uplevel')));
		$startdate = $request->getParameter('startdate');
		$enddate = $request->getParameter('enddate');
		
		$s1 = addslashes(trim($request->getParameter('Select1')));
		$s2 = addslashes(trim($request->getParameter('Select2')));
		$s3 = addslashes(trim($request->getParameter('Select3')));
		
		$pageto = $request->getParameter('pageto');
		//查询条件
		$condition = '  1=1 ';
		
		if($p_node != ''){
			$condition .= "and a.pid = '$p_node' ";
		}
		
		if($uplevel != ''){
			$condition .= "and a.uplevel = $uplevel ";
		}
		if($keyword != ''){
			$condition .= "and (a.user_id like '%$keyword%' or a.user_name like '%$keyword%' or a.wxname like '%$keyword%') "; 
		}
		if($phone != ''){
			$condition .= "and (a.mobile = '$phone') ";
		}
		if($startdate != ''){
			$condition .= "and a.add_date >= '$startdate 00:00:00' ";
		}
		if($enddate != ''){
			$condition .= "and a.add_date <= '$enddate 23:59:59' ";
		}
		
		if($s1 != ''){
			$condition .= "and a.sheng = $s1 ";
		}
		
		if($s2 != ''){
			$condition .= "and a.shi = $s2 ";
		}
		
		if($s3 != ''){
			$condition .= "and a.xian = $s3 ";
		}
		//记录总数
		$sql_total = "select count(a.id) c from ntb_user a  where   $condition";
		$r_total = $db->select($sql_total);
		$total = $r_total[0]->c;
		//分页
		$page = intval($request->getParameter('page'));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=CertifiedUserList&uplevel=$uplevel&keyword=".urlencode($keyword)."&phone=".urlencode($phone).
			"&startdate=".urlencode($startdate)."&enddate=".urlencode($enddate);
		$_SESSION ['daili_url'] = "index.php?$url&page=" . $pager->cur_page;
		$pagehtml = $pager->num_link($url);
		//分页详情
		$sql = "select a.*,a.pid as tuijian,a.uplevel as level from ntb_user a where $condition ";

		if($pageto == 'all'){
			$sql .= " ORDER BY a.id desc ";
			$userlist = $db->select($sql);
			
		} else {
			$sql .= " ORDER BY a.id desc limit $offset,$pagesize ";
			$userlist = $db->select($sql);
			
		}
		
		$page = $page==0?1:$page;
		$totaltemp = $total-$pagesize*($page-1);
		foreach($userlist as $key => $value) {
			$userlist[$key]->ti=0;
			$userlist[$key]->noid = $totaltemp--;
		}
		
		$request->setAttribute('keyword',$keyword);
		$request->setAttribute('phone',$phone);
		$request->setAttribute('p_node',$p_node);
		$request->setAttribute('startdate',$startdate);
		$request->setAttribute('enddate',$enddate);
		$request->setAttribute('total',$total);
		$request->setAttribute('userlist',$userlist);
		$request->setAttribute('pagehtml',$pagehtml);
		$request->setAttribute('pageto',$pageto);
		return View :: INPUT;
	}

	public function execute() {

	}

	public function getRequestMethods() {
		return Request :: NONE;
	}

}

?>