<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();	
		$sql = "select count(id) c from ntc_rproducts where is_del = '0'";
		$r = $db->select($sql);
		$total = $r[0]->c;
		//分页
		$page = intval($request->getParameter('page'));
		if($page <= 0){
			$page=isset($_SESSION['_rpro_page'])?$_SESSION['_rpro_page']:1;
		}
		$pagesize = 5;
		$pager = new ShowPager($total,$pagesize,$page);
		$_SESSION['_rpro_page'] = $pager->cur_page;
		$offset = $pager->offset;
		$pagehtml = $pager->num_link('module=RProduct');
		//分页记录
		$length = 600;
		$sql = "select id,pname,left(detail,$length) sub_detail,cost " .
			"from ntc_rproducts where is_del = '0' " .
			"order by id desc limit $offset,$pagesize";
		$list = $db->select($sql);
		//
		$ok_tags = "<span><font><strong><u><em><i>";
		foreach ($list as $value) {
			$value->cost = moneyFormat($value->cost);
			//img
			$img_tag_reg = '|<img([^>]*?)/\\s*>|im';
			if (preg_match($img_tag_reg, $value->sub_detail, $matchs)) {
				$value->img = "<img name='_rpro_pre_view' {$matchs[1]}/>";
			} else {
				$value->img = '';
			}
			$value->sub_detail = strip_tags($value->sub_detail, $ok_tags);
		}
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