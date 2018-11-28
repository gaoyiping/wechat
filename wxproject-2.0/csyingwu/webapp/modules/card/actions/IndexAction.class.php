<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		//查询参数
		$keyword = addslashes(trim($request->getParameter('keyword')));
		$type = addslashes(trim($request->getParameter('type')));
		
		$pageto = $request->getParameter('pageto');
		//查询条件
		$condition = ' and 1=1 ';
		
		
		
		if($type != ''){
			$condition .= "and a.type = $type ";
		}
		if($keyword != ''){
			$condition .= "and (b.user_id like '%$keyword%' or b.user_name like '%$keyword%') "; 
		}
		
		//记录总数
		$sql_total = "select count(a.id) c from ntb_anzhi_bnet a,ntb_user b where a.node=b.user_id   $condition";
		$r_total = $db->select($sql_total);
		$total = $r_total[0]->c;
		//分页
		$page = intval($request->getParameter('page'));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=card&type=$type&keyword=".urlencode($keyword);
		$_SESSION ['daili_url'] = "index.php?$url&page=" . $pager->cur_page;
		$pagehtml = $pager->num_link($url);
		//分页详情
		
		$sql = "select a.*,b.user_id,b.user_name from ntb_anzhi_bnet a,ntb_user b where a.node=b.user_id  $condition ";
		
		if($pageto == 'all'){
			$sql .= " ORDER BY a.id desc ";
			$userlist = $db->select($sql);
			
		} else {
			$sql .= " ORDER BY a.id desc limit $offset,$pagesize ";
			$userlist = $db->select($sql);
			
		}
		
		$page = $page==0?1:$page;
		$totaltemp = $total-$pagesize*($page-1);
		foreach($userlist as $key => $value)
		{
			
			
			$userlist[$key]->noid = $totaltemp--;
			
			
		}
		
		
		
		
		$request->setAttribute('keyword',$keyword);
		
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