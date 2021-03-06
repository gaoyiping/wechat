<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');

		//用户信息
		$sql = "select is_suoding from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		if($r){
            if($r[0]->is_suoding=="0")
			{
			    header("Content-type:text/html;charset=utf-8");
			    echo "<script type='text/javascript'>" .
				"alert('*您的账号已被锁定，请联系管理员');" .
				"location.href='index.php?module=Login';</script>";
			 }
			
		}

		$sql="select count(id)  c from ntb_record where operation='$userid' and type=3";
        $r = $db->select($sql);
		if($r)
		{
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
		$pagehtml = $pager->num_link('module=Exchange');
		//分页记录
		$sql = "select * from ntb_record " .
			"where operation = '$userid' and type=3  order by id desc " .
			   "limit $offset,$pagesize";
		$list = $db->select($sql);
		//
		$request->setAttribute('list',$list);

        $request->setAttribute('pagehtml',$pagehtml);
		}


		return View :: INPUT;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>