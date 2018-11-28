<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//取得参数
		
		$pageto = $request->getParameter("pageto");
		$userid = $this->getContext()->getStorage()->read('_user_id');
		//条件
		$condition = '';

		//总计
		$sql = "select count(id) c from ntc_rorder t1 where t1.dianpu='$userid' order by add_date desc";
		$r = $db->select($sql);
		$total = $r[0]->c;
		//分页
		$page = intval($request->getParameter("page"));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=PSOrder";
		$pagehtml = $pager->num_link($url);
		$_SESSION['handleretail_url'] = "index.php?$url&page=".$pager->cur_page;
		//分页详情
		$sql = "select * from ntc_rorder where dianpu='$userid' $condition order by add_date desc limit $offset,$pagesize";
		$tmp_list = $db->select($sql);
	
		$request->setAttribute('pageto',$pageto);
		$request->setAttribute('list',$tmp_list);
		
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