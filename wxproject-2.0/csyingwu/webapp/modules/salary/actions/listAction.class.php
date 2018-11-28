<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class listAction extends Action {
	
	public function getDefaultView() {
			$db = DBAction::getInstance ();
			$request = $this->getContext ()->getRequest ();

			
			
			$sql = "SELECT sum(s_money) m FROM ntb_money_point a WHERE type=0";
			$r = $db->select($sql);
			$cj = $r[0]->m;
			
			$sql = "SELECT sum(s_money) m FROM ntb_money_point a WHERE type=1";
			$r = $db->select($sql);
			$jdj = $r[0]->m;
			
			
			$sql = "SELECT sum(s_money) m FROM ntb_money_point a WHERE type=2";
			$r = $db->select($sql);
			$fxj = $r[0]->m;
			
			
			$sql = "SELECT sum(s_money) m FROM ntb_money_point a WHERE type=3";
			$r = $db->select($sql);
			$bdj = $r[0]->m;
			
			$sql = "SELECT sum(s_money) m FROM ntb_money_point a WHERE type=4";
			$r = $db->select($sql);
			$bdfh = $r[0]->m;
			
			$sql = "SELECT sum(s_money) m FROM ntb_money_point a WHERE type=5";
			$r = $db->select($sql);
			$lyj = $r[0]->m;
			
			$sql = "SELECT sum(s_money) m FROM ntb_money_point a WHERE type=6";
			$r = $db->select($sql);
			$cfj = $r[0]->m;
			
			$sql = "SELECT sum(s_money) m FROM ntb_money_point a WHERE type=7";
			$r = $db->select($sql);
			$fhj = $r[0]->m;
			
			$sql = "SELECT sum(s_money) m FROM ntb_money_point a WHERE type=8";
			$r = $db->select($sql);
			$cbj = $r[0]->m;
			
			$request->setAttribute ( "cj", $cj );
			$request->setAttribute ( "jdj", $jdj );
			$request->setAttribute ( "fxj", $fxj );
			$request->setAttribute ( "bdj", $bdj );
			$request->setAttribute ( "lyj", $lyj );
			$request->setAttribute ( "cfj", $cfj );
			$request->setAttribute ( "fhj", $fhj );
			$request->setAttribute ( "bdfh", $bdfh );
			$request->setAttribute ( "cbj", $cbj );
			
			
			$type = trim($request->getParameter('type'));
			$startdate = $request->getParameter('startdate');
			$enddate = $request->getParameter('enddate');
			$pageto = $request->getParameter ( 'pageto' );
			$page = intval ( $request->getParameter ( 'page' ) );
			$user_id = addslashes(trim($request->getParameter('user_id')));
			
			$condition = ' 1=1 ';
			
			if($user_id != ''){
				$condition .= "and a.userid = '$user_id' ";
			}
			
			if($type != ''){
				if($type==-1){
					$condition .= "and a.type = 0 ";
				}else{
					$condition .= "and a.type = '$type' ";
				}
			}
			if($startdate != ''){
				$condition .= "and a.add_date >= '$startdate 00:00:00' ";
			}
			if($enddate != ''){
				$condition .= "and a.add_date <= '$enddate 23:59:59' ";
			}
			
			
			$sql = "SELECT count(a.id) c,sum(s_money) m FROM ntb_money_point a WHERE  $condition ";
		
			$r1 = $db->select($sql);	
		if($r1)
		{  
			$request->setAttribute ( "m", $r1[0]->m );
			
			$total = intval($r1[0]->c);
		
			$pagesize = 15;
			$pager = new ShowPager ( $total, $pagesize, $page );
			$offset = $pager->offset;
			$url = "module=salary&action=list&user_id=$user_id"."&type=".urlencode($type).
			"&startdate=".urlencode($startdate)."&enddate=".urlencode($enddate);
			$pagehtml = $pager->num_link ( $url );
			$_SESSION ['daili_url'] = "index.php?$url&page=" . $pager->cur_page;
			
			$sql = "SELECT a.*,b.mobile,b.user_name,b.wxname,b.uplevel,b.card_name,b.provcity,b.card_type,b.card_number FROM ntb_money_point a left join ntb_user b on (a.userid=b.user_id) WHERE $condition order by a.id desc";
			
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
				$r[$key]->noid = $totaltemp--;
			}
			
			
			$request->setAttribute ( "user_id",$user_id );
			$request->setAttribute ( "total", $total );
			$request->setAttribute ( "rpros", $r );
			$request->setAttribute ( "pagehtml", $pagehtml );
			$request->setAttribute ( 'pageto', $pageto );

			$request->setAttribute('type',$type);
			$request->setAttribute('startdate',$startdate);
			$request->setAttribute('enddate',$enddate);
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