<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		//国际会员管理
		$inter_flag = $request->getParameter('inter_flag');
		//取得代理地区
	    $sql = "select GroupID,G_CName from admin_cg_group";
		$countryareas = $db->select($sql);
		$request->setAttribute("countryareas",$countryareas);
		
		//查询参数
		$keyword = addslashes(trim($request->getParameter('keyword')));
		$dianputype = addslashes(trim($request->getParameter('dianputype')));
		//EDIT BY MOX for anti sql inject leaks 2011.8.16
		$startdate = addslashes(trim($request->getParameter('startdate')));
		$enddate = addslashes(trim($request->getParameter('enddate')));
		$pageto = $request->getParameter('pageto');
		//查询条件
		$limit = false;
		$condition = '';
		if($keyword != ''){
			$limit = true;
			$condition .= "and (a.user_id like '%$keyword%' or a.user_name like '%$keyword%') "; 
		}
		if($dianputype != ''){
			$limit = true;
			$condition .= "and (a.dianputype = '$dianputype') ";
		}
		if($startdate != ''){
			$condition .= "and a.add_date >= '$startdate 00:00:00' ";
		}
		if($enddate != ''){
			$condition .= "and a.add_date <= '$enddate 23:59:59' ";
		}
		
	
		
	
		//记录总数
		$sql_total = "select count(a.id) c from ntb_user a where   a.dsNo='$userid' $condition";
		$r_total = $db->select($sql_total);
		$total = $r_total[0]->c;
		//分页
		$pagesize = 10;
		$page = intval($request->getParameter('page'));
		$total = ($limit && $total > 3 * $pagesize ) ? $total = 3 * $pagesize : $total ;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=danbaodianpu&keyword=".urlencode($keyword)."&dianputype=".urlencode($dianputype).
			"&startdate=".urlencode($startdate)."&enddate=".urlencode($enddate);
		$pagehtml = $pager->num_link($url);
		//分页详情
		$sql = "select a.*,b.G_CName,b.G_ParentID from ntb_user a left join admin_cg_group b on a.GroupID=b.GroupID  where  a.dsNo='$userid' $condition";
		
		if($pageto == 'all'){
			// EDITED BY SKS 2010.02.01 START
			//$userlist = $db->select($sql);
			$sql .= " ORDER BY id desc ";
			$sql .= (($limit) ? 'limit 0, ' . (3 * $pagesize) . ' ' : '');
			$userlist = $db->select($sql);
			// EDITED BY SKS 2010.02.01 END
		} else {
			// EDITED BY SKS 2010.02.01 START
			//$userlist = $db->select($sql . " limit $offset,$pagesize");
			$sql .= " ORDER BY id desc limit $offset,$pagesize ";
			$userlist = $db->select($sql);
			// EDITED BY SKS 2010.02.01 END
		}
		//
		$request->setAttribute('keyword',$keyword);
		$request->setAttribute('dianputype',$dianputype);
		$request->setAttribute('startdate',$startdate);
		$request->setAttribute('enddate',$enddate);
		$request->setAttribute('total',$total);
		$request->setAttribute('userlist',$userlist);
		$request->setAttribute('pagehtml',$pagehtml);
		$request->setAttribute('pageto',$pageto);
		$request->setAttribute('inter_flag',$inter_flag);
		
		return View :: INPUT;
	}

	public function execute() {

	}

	public function getRequestMethods() {
		return Request :: NONE;
	}

}

?>