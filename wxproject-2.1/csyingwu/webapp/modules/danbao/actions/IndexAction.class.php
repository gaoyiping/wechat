<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	

				//查询参数
		$dsNo = addslashes(trim($request->getParameter('bname')));
		$bzhuantai = addslashes(trim($request->getParameter('bzhuantai')));
		

		$condition = '';
		if($dsNo != ''){
			$limit = true;
			$condition .= " and (a.bname like '%$dsNo%' or a.bloginID like '%$dsNo%') "; 
		}
		if($bzhuantai != ''){
			$limit = true;
			$condition .= " and a.bzhuantai ='$bzhuantai' ";
		}
		


		$sql = "select count(a.bid) c from admin_cg_danbao a where 1 $condition";
		$r = $db->select($sql);	
		//分页
		$total = intval($r[0]->c);
		$page = intval($request->getParameter('page'));
		$pagesize = 15;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$pagehtml = $pager->num_link("module=danbao");
		//详情
		$sql = "select a.*,(select count(id) from ntb_user where dianpu=a.bloginID and zhucetype=2) as danbaoshu " .
			",(select G_CName from admin_cg_group b where b.GroupID=a.bshengID) as shengname ".
			",(select G_CName from admin_cg_group b where b.GroupID=a.bshiID) as shiname ".
			",(select G_CName from admin_cg_group b where b.GroupID=a.bxianID) as xianname ".
			"from admin_cg_danbao a where 1 $condition order by a.bid desc limit $offset,$pagesize";
		
		$r = $db->select($sql);
		//处理价格格式
		$request->setAttribute("dsNo",$dsNo);
		$request->setAttribute("bzhuantai",$bzhuantai);
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