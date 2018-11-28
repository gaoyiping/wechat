<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');


class indexAction extends Action {

		public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		$sql = "select count(id) c from ntc_rproducts";
		$r = $db->select($sql);	
		//��ҳ
		$total = intval($r[0]->c);
		$page = intval($request->getParameter('page'));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$pagehtml = $pager->num_link("module=yuseleclchanpin");
		//����
		$sql = "select * " .
			"from ntc_rproducts order by id desc limit $offset,$pagesize";
		$r = $db->select($sql);
		//����۸��ʽ
		foreach ($r as $value) {
			$value->cost = moneyFormat($value->cost);
		}
		//
		$request->setAttribute("rpros",$r);
		$request->setAttribute("pagehtml",$pagehtml);
		return View :: INPUT;
	}




	public function execute(){		
		
	}

	
	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>