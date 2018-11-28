<?php
require_once (MO_LIB_DIR . '/DBAction.class.php');
require_once (MO_LIB_DIR . '/SysConst.class.php');
require_once (MO_LIB_DIR . '/ShowPager.class.php');
require_once (MO_LIB_DIR . '/Tools.class.php');
class ListAction extends Action {
	public function getDefaultView() {
		
		if($_SESSION['_admin_atype']!=1 && !in_array("b3",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		$db = DBAction::getInstance ();
		$request = $this->getContext ()->getRequest ();
		
		$sqishu = addslashes ( trim ( $request->getParameter ( 'sqishu' ) ) );
		$eqishu = addslashes ( trim ( $request->getParameter ( 'eqishu' ) ) );
		$user_id = addslashes ( trim ( $request->getParameter ( 'user_id' ) ) );
		$pingzheng = addslashes ( trim ( $request->getParameter ( 'pingzheng' ) ) );
		$diqu = addslashes ( trim ( $request->getParameter ( 'diqu' ) ) );
		$pageto = $request->getParameter ( 'pageto' );
		
		$sql = "select sNo  from  ntb_money  group by sNo order by  sNo desc";
		
		$r1 = $db->select ( $sql );
		$qishu = "";
		$eeqishu = "";
		if ($r1) {
			$num = 0;
			foreach ( $r1 as $value ) {
				$num = $num + 1;
				if ($sqishu != "") {
					if ($sqishu == $value->sNo) {
						$qishu = $qishu . "<option value='" . $value->sNo . "'  selected>" . $value->sNo . "</option>";
						
					} else {
						$qishu = $qishu . "<option value='" . $value->sNo . "'  >" . $value->sNo . "</option>";
						
					}
				} else {
					if ($num == 1) {
						$qishu = $qishu . "<option value='" . $value->sNo . "'  selected>" . $value->sNo . "</option>";
						
						$sqishu = $value->sNo;
						
					} else {
						$qishu = $qishu . "<option value='" . $value->sNo . "'  >" . $value->sNo . "</option>";
						
					}
				}
				
				if ($eqishu != "") {
					if ($eqishu == $value->sNo) {
						$eeqishu = $eeqishu . "<option value='" . $value->sNo . "'  selected>" . $value->sNo . "</option>";
					} else {
						$eeqishu = $eeqishu . "<option value='" . $value->sNo . "'  >" . $value->sNo . "</option>";
					}
				} else {
					if ($num == 1) {
						$eeqishu = $eeqishu . "<option value='" . $value->sNo . "'  selected>" . $value->sNo . "</option>";
						$eqishu = $value->sNo;
					} else {
						$eeqishu = $eeqishu . "<option value='" . $value->sNo . "'  >" . $value->sNo . "</option>";
					}
				}
				
			}
		}
		
		$condition = '';
		
		$limit = true;
		$condition .= " and a.sNo between '$sqishu' and '$eqishu' ";
		if ($user_id != "") {
			$condition .= " and a.userid='$user_id' ";
		}
		
		$sql = "select count(a.id) c,sum(kaituo_money) as k,sum(tax_money) as t  from ntb_money a  where 1=1  $condition order by  a.id ";
		
		$r1 = $db->select ( $sql );
		if ($r1) {
			
			$total = intval ( $r1 [0]->c );
			$zongjin = floatval ( $r1 [0]->k )-floatval ( $r1 [0]->t );
			$page = intval ( $request->getParameter ( 'page' ) );
			$pagesize = 100;
			$pager = new ShowPager ( $total, $pagesize, $page );
			$offset = $pager->offset;
			$url = "module=jiang&action=list&sqishu=$sqishu&eqishu=$eqishu&user_id=$user_id";
			$pagehtml = $pager->num_link ( $url );
			$_SESSION ['daili_url'] = "index.php?$url&page=" . $pager->cur_page;
			
			$sql = "select a.*,b.mobile,b.user_name,b.usertype,b.usertype,b.card_name,b.provcity,b.card_type,b.card_number,b.mobile,b.e_mail from ntb_money a left join ntb_user b on a.userid=b.user_id" . " where 1=1 $condition  order by  b.id  desc";
			//echo $sql;
			if($pageto == 'hzall'){
				
				$condition = " and sNo between '$sqishu' and '$eqishu' ";
				if ($user_id != "") {
					$condition .= " and userid='$user_id' ";
				}
				$no  = $sqishu."至".$eqishu;
				$sql="select b.*,a.*, '$no' sNo  from ntb_user  b right join (SELECT userid, sum(kaituo_money) kaituo_money,sum(tax_money) tax_money  FROM  ntb_money  where 1=1 $condition  group by userid) a on a.userid=b.user_id order by  b.id  desc";
				//echo $sql;exit;
			}else if ($pageto == 'all') {
				
				$sql .= " ";
			} else {
				
				$sql .= " limit  $offset,$pagesize";
			}
			
			$r = $db->select ( $sql );
			for($i=0;$i<count($r);$i++){
				$r[$i]->s_money = floatval ( $r[$i]->kaituo_money )-floatval ( $r[$i]->tax_money ); 
				
			}
			
			
			$request->setAttribute ( "user_id", $user_id );
			$request->setAttribute ( "zongjin", $zongjin );
			
			$request->setAttribute ( "rpros", $r );
			$request->setAttribute ( "pagehtml", $pagehtml );
		}
		
		if($_SESSION['_admin_atype']!=1 && !in_array("b4",$_SESSION['_admin_permission'])){
			$request->setAttribute ( 'b4', 0 );
		}else{
			$request->setAttribute ( 'b4', 1 );
		}
		
		if($_SESSION['_admin_atype']!=1 && !in_array("b5",$_SESSION['_admin_permission'])){
			$request->setAttribute ( 'b5', 0 );
		}else{
			$request->setAttribute ( 'b5', 1 );
		}
		
		$request->setAttribute ( 'pageto', $pageto );
		$request->setAttribute ( "qishu", $qishu );
		$request->setAttribute ( "eqishu", $eeqishu );
		return View::INPUT;
	}
	public function execute() {
	}
	public function getRequestMethods() {
		return Request::NONE;
	}
}
?>