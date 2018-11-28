<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class sendedAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sql = "select count(id) c from ntb_message where user_id ='$userid'";
		$r = $db->select($sql);
		$total = $r[0]->c;
		//分页
		$page = intval($request->getParameter('page'));
		if($page <= 0){
			$page=isset($_SESSION['_msg_send_page'])?$_SESSION['_msg_send_page']:1;
		}
		$pagesize = 5;
		$pager = new ShowPager($total,$pagesize,$page);
		$_SESSION['_msg_send_page'] = $pager->cur_page;
		$offset = $pager->offset;
		$pagehtml = $pager->num_link('module=Message&action=sended');
		//页面详情
		$sql = "select * from ntb_message where user_id = '$userid' " .
			   "order by id desc limit $offset,$pagesize";
		$list = $db->select($sql);
		//
		$request->setAttribute('list',$list);
		$request->setAttribute('pagehtml',$pagehtml);
		$request->setAttribute('type','send');
		return View :: INPUT;
	}

	public function execute(){

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>