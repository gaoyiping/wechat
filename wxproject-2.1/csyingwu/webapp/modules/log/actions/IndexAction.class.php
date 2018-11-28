<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		if($_SESSION['_admin_atype']!=1 && !in_array("d6",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		$sql = "select count(id) c from ntb_log where utype=0";
		$r = $db->select($sql);	
		//分页
		$total = intval($r[0]->c);
		$page = intval($request->getParameter('page'));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$pagehtml = $pager->num_link("module=log");
		//详情
		$sql = "select * from ntb_log where utype=0 order by add_date desc limit $offset,$pagesize";
		$r = $db->select($sql);
		//
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