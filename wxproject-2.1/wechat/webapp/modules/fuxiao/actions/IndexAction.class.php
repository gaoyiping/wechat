<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		
		//取得参数		
		$tyear = $request->getParameter("tyear");

		$userid = $this->getContext()->getStorage()->read('_user_id');
		//条件
		$condition = '';

		
		if($tyear != ''){
			$condition .= " and substring(fuxiaodate, 1, 4) = '$tyear' ";
		}


		//总计
		$sql = "select count(id) c from ntb_fuxiao t1 where userid='$userid' $condition order by fuxiaodate asc";
		$r = $db->select($sql);
		$total = $r[0]->c;
		//$totalemoneys = $r[0]->m;
		//分页
		$page = intval($request->getParameter("page"));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=fuxiao&tyear=$tyear";
		$pagehtml = $pager->num_link($url);
		$_SESSION['handleretail_url'] = "index.php?$url&page=".$pager->cur_page;
		//分页详情
		/*if($pageto == 'all'){
			$sql = "select * from ntb_fuxiao where user_id='$userid' $condition ";
		} else {
			$sql = "select * from ntb_fuxiao where user_id='$userid' $condition order by fuxiaodate desc limit $offset,$pagesize";
		}*/
		$sql = "select * from ntb_fuxiao where userid='$userid' $condition order by fuxiaodate asc limit $offset,$pagesize";
		$fuxiaolist = $db->select($sql);
	
		$request->setAttribute('total',$total);
		$request->setAttribute('tyear',$tyear);
		$request->setAttribute('fuxiaolist',$fuxiaolist);		
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