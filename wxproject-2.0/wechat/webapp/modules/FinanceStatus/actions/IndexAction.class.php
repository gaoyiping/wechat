<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//得到用户ID
		//EDIT BY MOX for anti sql inject leaks 2011.8.16
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$choose = strval($request->getParameter("choose"));
		$startdate = strval($request->getParameter("startdate"));
		$enddate = strval($request->getParameter("enddate"));
		

			$sql = "select count(userid) c from ntb_money " .
			"where userid = '$userid' order by id desc";
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
		$pagehtml = $pager->num_link('module=FinanceStatus');
		//分页记录
		$sql = "select * from ntb_money " .
			"where userid = '$userid' order by id desc " .
			   "limit $offset,$pagesize";
		$list = $db->select($sql);
		//
		$request->setAttribute('list',$list);

        $request->setAttribute('pagehtml',$pagehtml);

		//查询总计
		$sql = "select sum(t_money) amounts,sum(f_money) kaituo_amounts,sum(p_money) fenhong_amounts,sum(c_money) jintie_amounts,sum(k_moeny) koushui_amounts" .
			" from ntb_money where userid = '$userid'";

		$r = $db->select($sql);
		$amounts = $r[0]->amounts;
		$kaituo_amounts = $r[0]->kaituo_amounts;
		$fenhong_amounts = $r[0]->fenhong_amounts;
		$jintie_amounts = $r[0]->jintie_amounts;
		$koushui_amounts = $r[0]->koushui_amounts;

		
		$amounts1 = $amounts + $kaituo_amounts+$fenhong_amounts-$jintie_amounts-$koushui_amounts;
		//
		$request->setAttribute("userid",$userid);
		$request->setAttribute("list",$list);
		$request->setAttribute("amounts",$amounts);
		$request->setAttribute("amounts1",$amounts1);
		$request->setAttribute("kaituo_amounts",$kaituo_amounts);
		$request->setAttribute("fenhong_amounts",$fenhong_amounts);
		$request->setAttribute("jintie_amounts",$jintie_amounts);
		$request->setAttribute("koushui_amounts",$koushui_amounts);
	

		$request->setAttribute("choose",$choose);
		$request->setAttribute("startdate",$startdate);
		$request->setAttribute("enddate",$enddate);
		
		return View :: INPUT;
	
		
	}


// DELETE END

	public function execute(){

	}


	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>