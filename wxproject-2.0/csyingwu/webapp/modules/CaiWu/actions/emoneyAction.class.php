<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class emoneyAction extends Action {

	public function getDefaultView() {
		$db =  DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = addslashes(trim($request->getParameter("userid")));
		$startdate = $request->getParameter("startdate");
		$enddate = $request->getParameter("enddate");
		//条件
		$condition = "";
		if($userid != ''){
			$condition .= "and b.user_id = '$userid' ";
		}
		if($startdate != ''){
			$condition .= "and b.add_date >= '$startdate 00:00:00' ";
		}
		if($enddate != ''){
			$condition .= "and b.add_date <= '$enddate 23:59:59' ";
		}		
		//总记录，总电子货币
		$sql = "select count(id) c,sum(z_money) emoneys from ntb_user b where 1 $condition";
		$r = $db->select($sql);
		$total = intval($r[0]->c);
		$emoneys = intval($r[0]->emoneys);
		//分页
		$page = intval($request->getParameter('page'));
		$total = $r[0]->c;		
		$pagesize = 10; 
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=CaiWu&type=0&userid=".urlencode($userid).
			"&startdate=$startdate&enddate=$enddate";
		$_SESSION['daili_url'] = "index.php?".$url;
		$pagehtml = $pager->num_link($url);
		//分页详情
		$sql = "select b.* from ntb_user b where 1=1 $condition order by b.id desc limit $offset,$pagesize";
		$list = $db->selectarray($sql);
		
		
		$request->setAttribute("userid",$userid);
		$request->setAttribute("startdate",$startdate);
		$request->setAttribute("enddate", $enddate);
		$request->setAttribute("total",$total);
		$request->setAttribute("emoneys",$emoneys);
		$request->setAttribute("list",$list);
		$request->setAttribute("pagehtml",$pagehtml);
		return View :: INPUT;
	}

	function countPage(&$list,&$pageemoneys){
		$pageemoneys = 0;
		foreach($list as $v){
			$pageemoneys += intval($v['z_money']);
		}
	}
	
	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>