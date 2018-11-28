<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$start = $request->getParameter('start');
		$end = $request->getParameter('end');
		$userid = $this->getContext()->getStorage()->read('_user_id');
		//直推人列表,节点
		$sql = "select t1.lt,t1.rt,t2.node from ntb_user_ref t1,ntb_user_ref t2 " . 
			   "where t1.node = '$userid' and t2.p_node = '$userid'";
		$r = $db->select($sql);
		if(!$r){
			return View :: INPUT;
		} else {
			$directlist = array();
			foreach($r as $v){
				$directlist[] = "<strong>".$v->node."</strong>";
			}
		}
		$directlist = implode('、 ',$directlist);
		$lt = $r[0]->lt;
		$rt = $r[0]->rt;
		$sql = "select node from ntb_user_ref where lt > $lt and rt < $rt ";
		//保单总数
		$totals = ($rt - $lt - 1)/2;
		/*
		//周保单数
		$d = getdate();
		$s = (($d['wday']+6)%7)*24*3600;
		$start = date('Y-m-d 00:00:00',mktime(0,0,0,$d['mon'],$d['mday'],$d['year'])-$s);
		$sql_2 = "select count(node) c from ( $sql and ref_date >= '$start' ) t";
		$r_2 = $db->select($sql_2);
		$weeks = $r_2[0]->c;
		//月保单数
		$start = date('Y-m-01 00:00:00');
		$sql_3 = "select count(node) c from ( $sql and ref_date >= '$start' ) t";
		$r_3 = $db->select($sql_3);
		$months = $r_3[0]->c;
		*/

		//报单数查询
		$now = date('Y-m-d H:i:59');
		$d = getdate();
		$s = (($d['wday']+6)%7)*24*3600;
		$w_start = date('Y-m-d 00:00:00',mktime(0,0,0,$d['mon'],$d['mday'],$d['year'])-$s);
		$w_end = $now;
		$m_start = date('Y-m-01 00:00:00');
		$m_end = $now;
		if ($start != '') {
			$b_start = "$start 00:00:00";
		} else {
			$b_start = "1970-01-01 00:00:00";
		}
		if ($end != '') {
			$b_end = "$end 23:59:59";
		} else {
			$b_end = $now;
		}
		$ifcondition_tpl = "if(ref_date >= '%s' and ref_date <= '%s', node, NULL)" ;
		$sql = "select 
			count( " . sprintf($ifcondition_tpl, $w_start, $w_end) . " ) w_counts,
			count( " . sprintf($ifcondition_tpl, $m_start, $m_end) . " ) m_counts,
			count( " . sprintf($ifcondition_tpl, $b_start, $b_end) . " ) b_counts
			from ntb_user_ref where lt > $lt and rt < $rt " ;
		$r = $db->select($sql);
		$weeks = $r[0]->w_counts;
		$months = $r[0]->m_counts;
		$datebar = $r[0]->b_counts;

		//团队零售查询
		$where = '';
		if ($start != '') { $where .= "and t2.add_date >= '$start 00:00:00' "; }
		if ($end != '') { $where .= "and t2.add_date <= '$end 23:59:59' "; }
		$sql = "select sum(t2.emoneys) retails " .
			"from ntb_user_ref t1, ntc_rorder t2 " .
			"where t2.user_id = t1.node and lt >= $lt and rt <= $rt $where " ;
		//print $sql;
		$r = $db->select($sql);
		$retails = $r[0]->retails;
		
		//
		$request->setAttribute('start',$start);
		$request->setAttribute('end',$end);
		$request->setAttribute('totals',$totals);
		$request->setAttribute('weeks',$weeks);
		$request->setAttribute('months',$months);
		$request->setAttribute('datebar',$datebar);
		$request->setAttribute('retails',$retails);
		$request->setAttribute('directlist',$directlist);
		return View :: INPUT;
	}

	public function execute() {

	}

	public function getRequestMethods() {
		return Request :: NONE;
	}

}
?>