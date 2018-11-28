<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class prosAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$pname = addslashes(trim($request->getParameter('pname')));
		$condition = '';
		if ($pname != '') {
			$condition = " and pname like '%$pname%' ";
		}

		$sql = "select count(id) c from ntc_rproducts where is_del = '0' $condition";
		$r = $db->select($sql);
		$total = $r[0]->c;
		//分页
		$page = intval($request->getParameter('page')) or $page = '1';
		$pagesize = 15;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = 'module=AutoDeal&action=pros&pname=' . urlencode($pname);
		$pagehtml = $pager->num_link($url);

		//详情
		$sql = "select id, pname, cost from ntc_rproducts " .
			"where is_del = '0' $condition " .
			"order by id desc limit $offset,$pagesize";
		$list = $db->select($sql);
		foreach ($list as $value) {
			$value->cost = moneyFormat($value->cost);
		}

		$request->setAttribute('pname', $pname);
		$request->setAttribute('pagehtml', $pagehtml);
		$request->setAttribute('list', $list);
		return View :: INPUT;		
	}

	public function execute(){

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>