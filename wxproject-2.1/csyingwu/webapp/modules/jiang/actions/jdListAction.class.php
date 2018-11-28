<?php
require_once (MO_LIB_DIR . '/DBAction.class.php');
require_once (MO_LIB_DIR . '/SysConst.class.php');
require_once (MO_LIB_DIR . '/ShowPager.class.php');
require_once (MO_LIB_DIR . '/Tools.class.php');
class jdListAction extends Action {
	public function getDefaultView() {
		
		$db = DBAction::getInstance ();
		$request = $this->getContext ()->getRequest ();
		
		$sqishu = addslashes ( trim ( $request->getParameter ( 'sqishu' ) ) );
		$eqishu = addslashes ( trim ( $request->getParameter ( 'eqishu' ) ) );
		$user_id = addslashes ( trim ( $request->getParameter ( 'user_id' ) ) );
		$pingzheng = addslashes ( trim ( $request->getParameter ( 'pingzheng' ) ) );
		$diqu = addslashes ( trim ( $request->getParameter ( 'diqu' ) ) );
		$pageto = $request->getParameter ( 'pageto' );
		
		$sql = "select sNo  from  ntb_jdmoney  group by sNo order by  sNo desc";
		
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
		
		$sql = "select count(a.id) c ,sum(jd_money) as j from ntb_jdmoney a  where 1=1  $condition order by  a.id ";
		
		$r1 = $db->select ( $sql );
		if ($r1) {
			
			$total = intval ( $r1 [0]->c );
			$zongjin =$r1 [0]->j;
			$page = intval ( $request->getParameter ( 'page' ) );
			$pagesize = 100;
			$pager = new ShowPager ( $total, $pagesize, $page );
			$offset = $pager->offset;
			$url = "module=jiang&action=jdlist&sqishu=$sqishu&eqishu=$eqishu&user_id=$user_id";
			$pagehtml = $pager->num_link ( $url );
			$_SESSION ['daili_url'] = "index.php?$url&page=" . $pager->cur_page;
			
			$sql = "select a.*,b.mobile,b.user_name,b.usertype,b.usertype,b.card_name,b.provcity,b.card_type,b.card_number,b.mobile,b.e_mail from ntb_jdmoney a left join ntb_user b on a.userid=b.user_id" . " where 1=1 $condition  order by  b.id  desc";
			//echo $sql;
			if ($pageto == 'all') {
				
				$sql .= " ";
			} else {
				
				$sql .= " limit  $offset,$pagesize";
			}
			
			$r = $db->select ( $sql );
			
			$request->setAttribute ( "user_id", $user_id );
			$request->setAttribute ( "zongjin", $zongjin );
			
			$request->setAttribute ( "rpros", $r );
			$request->setAttribute ( "pagehtml", $pagehtml );
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