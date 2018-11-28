<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sql = "select count(id) c from user_cg_list where user_id='".$userid."' ";

		    

		$r = $db->select($sql);	

		if($r){
		//分页
		$total = intval($r[0]->c);
		$page = intval($request->getParameter('page'));
		$pagesize = 15;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$pagehtml = $pager->num_link("module=dingdan");
				$request->setAttribute("pagehtml",$pagehtml);

		
		//详情
		$sql = "select * from user_cg_list  where user_id='".$userid."'  limit $offset,$pagesize";
		$r = $db->select($sql);
		}
		//处理价格格式
		
		$request->setAttribute("rpros",$r);

		return View :: INPUT;
		
	}

	public function execute() {

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>