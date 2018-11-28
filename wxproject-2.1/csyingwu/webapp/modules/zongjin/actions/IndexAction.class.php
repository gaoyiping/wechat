<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	

				//查询参数
		$startdate = addslashes(trim($request->getParameter('startdate')));
		$user_id = addslashes(trim($request->getParameter('user_id')));
		$enddate = addslashes(trim($request->getParameter('enddate')));

        $condition = '';
	  
		$limit = true;
		
		if($user_id!="")
		{
		  $condition .= " and a.userid='$user_id' ";
		} 
		if($startdate != ''){
			$condition .= " and a.add_date >= '$startdate 00:00:00' ";
		}
		if($enddate != ''){
			$condition .= " and a.add_date <= '$enddate 23:59:59' ";
		}
	
		$sql = "select count(a.id) c  from ntb_money a left join ntb_user b on a.userid=b.user_id where 1=1 $condition  group by a.userid  ";
	
    
		$r1 = $db->select($sql);	
		if($r1)
		{  
			//分页
			$total = count($r1);
			
			$page = intval($request->getParameter('page'));
			$pagesize = 10;
			$pager = new ShowPager($total,$pagesize,$page);
			$offset = $pager->offset;
				$url = "module=zongjin&user_id=$user_id&enddate=$enddate&startdate=$startdate";
			$pagehtml = $pager->num_link($url);
			$_SESSION['daili_url'] = "index.php?$url&page=".$pager->cur_page;
			//详情
			$sql = "select a.userid,sum(y_money) as y_money,b.usertype,b.user_name "
			." "
			."from ntb_money a left join ntb_user b on a.userid=b.user_id"
			." where 1=1 $condition  group by a.userid   order by  sum(y_money) desc limit  $offset,$pagesize";
			
	
			$r = $db->select($sql);
			//处理价格格式
	
			
			
		
			$request->setAttribute("rpros",$r);
			$request->setAttribute("pagehtml",$pagehtml); 
		}
		
        $request->setAttribute("user_id",$user_id);
			$request->setAttribute("enddate",$enddate);
			$request->setAttribute("startdate",$startdate);
		
		return View :: INPUT;
		
	}
	



	public function execute() {

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>