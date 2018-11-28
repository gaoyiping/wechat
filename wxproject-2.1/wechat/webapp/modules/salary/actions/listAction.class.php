<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class listAction extends Action {
	
	public function getDefaultView() {
			$db = DBAction::getInstance ();
			$request = $this->getContext ()->getRequest ();
			$user_id = $this->getContext()->getStorage()->read('_user_id');
			
			$type = $request->getParameter('type');
			$pageto = $request->getParameter ( 'pageto' );
			$page = intval ( $request->getParameter ( 'page' ) );
			
			$condition = ' and 1=1 ';
			
			if($type != ''){
				$condition .= "and a.type = $type  ";
			}
			
			
			$sql = "SELECT count(a.id) c,sum(s_money) m FROM ntb_money_point a WHERE isf=1 and userid =  '$user_id' $condition ";
			$r1 = $db->select($sql);	
		if($r1)
		{  
			$request->setAttribute ( "m", $r1[0]->m );
			
			$total = intval($r1[0]->c);
		
			$pagesize = 10;
			$pager = new ShowPager ( $total, $pagesize, $page );
			$offset = $pager->offset;
			$url = "module=salary&action=list&user_id=$user_id&type=".$type;
			$pagehtml = $pager->num_link2 ( $url );
			$_SESSION ['daili_url'] = "index.php?$url&page=" . $pager->cur_page;
			
			$sql = "SELECT a.*,b.wxname
FROM ntb_money_point a left join ntb_user b
on ( a.fromuser=b.user_id )  WHERE a.isf=1 and a.userid =  '$user_id' $condition  order by a.id desc";
			
			if ($pageto == 'all') {
				
				$sql .= " ";
			} else {
				
				$sql .= " limit  $offset,$pagesize";
			}
			
			$r = $db->select ( $sql );
			$page = $page==0?1:$page;
			$totaltemp = $total-$pagesize*($page-1);
			foreach($r as $key => $value)
			{
				$r[$key]->noid = $totaltemp++;
				
			}
			
			$request->setAttribute ( "type", $type );
			$request->setAttribute ( "user_id", $user_id );
			$request->setAttribute ( "total", $total );
			$request->setAttribute ( "rpros", $r );
			$request->setAttribute ( "pagehtml", $pagehtml );
			$request->setAttribute ( 'pageto', $pageto );

		}
		return View::INPUT;
	}
	



	public function execute() {

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>