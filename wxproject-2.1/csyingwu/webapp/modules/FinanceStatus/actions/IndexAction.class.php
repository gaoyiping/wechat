<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance ();
		$request = $this->getContext ()->getRequest ();
			
		$user_id = addslashes(trim($request->getParameter("user_id")));
			
			
		$pageto = $request->getParameter ( 'pageto' );
		
		$page = intval ( $request->getParameter ( 'page' ) );
		
		
		$sql = "SELECT count(a.id) c FROM ntb_money_point a WHERE userid =  '$user_id' ";
		
		
		$r1 = $db->select($sql);
		if($r1)
		{
			//分页
			$total = intval($r1[0]->c);
		
			$pagesize = 15;
			$pager = new ShowPager ( $total, $pagesize, $page );
			$offset = $pager->offset;
			$url = "module=FinanceStatus&user_id=$user_id";
			$pagehtml = $pager->num_link ( $url );
			$_SESSION ['daili_url'] = "index.php?$url&page=" . $pager->cur_page;
				
			$sql = "SELECT money,tax_money,s_money,add_date,isf
			FROM ntb_money_point a
			WHERE userid =  '$user_id' order by a.id desc";
				
			if ($pageto == 'all') {
		
				$sql .= " ";
			} else {
		
				$sql .= " limit  $offset,$pagesize";
			}
				
			$r = $db->select ( $sql );
			
				
			$request->setAttribute ( "user_id", $user_id );
			$request->setAttribute ( "total", $total );
			$request->setAttribute ( "rpros", $r );
				
			$request->setAttribute ( "pagehtml", $pagehtml );
		
			$request->setAttribute ( 'pageto', $pageto );
		}
		
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