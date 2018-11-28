<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		
		$sql = "select * from ntc_type order by tID ,torder ";
		$r = $db->select($sql);
		
		$request->setAttribute("types",$r);

		//查询参数
		$keyword = addslashes(trim($request->getParameter('keyword')));
		$isdelete = addslashes(trim($request->getParameter('isdelete')));
		$type = addslashes(trim($request->getParameter('type')));

		$limit = false;
		$condition = '';
		if($keyword != ''){
			$limit = true;
			$condition .= "and (pname like '%$keyword%' or sNo like '%$keyword%') "; 
		}
		if($isdelete != ''){
			$limit = true;
			$condition .= "and (isdelete = '$isdelete') ";
		}

		if($type != ''){
			$limit = true;
			$condition .= "and (typeID = '$type') ";
		}

		$sql = "select count(id) c from ntc_rproducts  where 1 $condition ";
		$r = $db->select($sql);	
		//分页
		$total = intval($r[0]->c);
		$page = intval($request->getParameter('page'));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$pagehtml = $pager->num_link("module=RProduct&keyword=$keyword&isdelete=$isdelete");

		
		//详情
		$sql = "select * " .
			"from ntc_rproducts where 1 $condition order by id desc limit $offset,$pagesize ";
		$r = $db->select($sql);
		//处理价格格式
		foreach ($r as $value) {
			$value->cost = moneyFormat($value->cost);
		}
		$request->setAttribute("keyword",$keyword);
		$request->setAttribute("isdelete",$isdelete);
		$request->setAttribute("type",$type);
		$request->setAttribute("rpros",$r);
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