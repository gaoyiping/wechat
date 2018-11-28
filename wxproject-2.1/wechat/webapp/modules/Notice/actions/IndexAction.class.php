<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();	
		$sql = "select count(id) c from ntb_notice";
		$r = $db->select($sql);
		$total = $r[0]->c;
		//分页
		$page = intval($request->getParameter('page'));
		if($page <= 0){
			$page=isset($_SESSION['_notice_page'])?$_SESSION['_notice_page']:1;
		}
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$_SESSION['_notice_page'] = $pager->cur_page;
		$offset = $pager->offset;
		$pagehtml = $pager->num_link('module=Notice');
		//分页记录
		$sql = "select id,title,add_date from ntb_notice order by add_date desc " .
			   "limit $offset,$pagesize";
		$list = $db->select($sql);
		//
		$request->setAttribute('list',$list);
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