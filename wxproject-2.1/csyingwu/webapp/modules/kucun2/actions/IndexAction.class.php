<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		if($_SESSION['_admin_atype']!=1 && !in_array("c5",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		$sql = "select count(rID) c from admin_cg_kucun group by rsNo";
		$r = $db->select($sql);	

		if($r)
		{
		//分页
		$total = intval(count($r));
		
		$page = intval($request->getParameter('page'));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$pagehtml = $pager->num_link("module=kucun2");
		//详情
		$sql = "select a.*,(select sum(rnum) from admin_cg_kucun where rsNo=a.rsNo and rtype=1) as ruku,(select sum(rnum) from admin_cg_kucun where rsNo=a.rsNo and rtype=2) as xiaoshou,(select sum(rnum) from admin_cg_kucun where rsNo=a.rsNo and rtype=3) as chuku ,(select sum(rnum) from admin_cg_kucun where rsNo=a.rsNo and rtype=4) as zengpin  from admin_cg_kucun a group by a.rsNo limit $offset,$pagesize";
		$r = $db->select($sql);
		//处理价格格式
		
		$request->setAttribute("rpros",$r);
		$request->setAttribute("pagehtml",$pagehtml);
		}
		return View :: INPUT;
		
	}

	public function execute() {

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>