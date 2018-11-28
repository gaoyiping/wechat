<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		if($_SESSION['_admin_atype']!=1 && !in_array("d7",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		
		$userid = addslashes(trim($request->getParameter('userid')));
		
		//查询条件
		$condition = ' 1=1 ';
		
		if($userid != ''){
			$condition .= " and  userid= '$userid' ";
		}
		
		$sql = "select count(id) c from ntb_log where utype in(1,3) and $condition";
		$r = $db->select($sql);
		//分页
		$total = intval($r[0]->c);
		$page = intval($request->getParameter('page'));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		
		$url = "module=zblog&userid=".urlencode($userid);
		
		$pagehtml = $pager->num_link($url);
		//详情
		$sql = "select * from ntb_log where utype in(1,3) and $condition order by add_date desc limit $offset,$pagesize";
		$r = $db->select($sql);
		$request->setAttribute('userid',$userid);
		$request->setAttribute("logs",$r);
		$request->setAttribute("pagehtml",$pagehtml);
		return View :: INPUT;
		
	}

	public function execute() {

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>