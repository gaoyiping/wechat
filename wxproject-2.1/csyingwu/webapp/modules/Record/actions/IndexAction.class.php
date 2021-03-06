<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = addslashes(trim($request->getParameter("userid")));
		$start = $request->getParameter("start");
		$end = $request->getParameter("end");
		$choose = intval($request->getParameter("choose"));
		//条件
		$condition = '';
		switch($choose){
		case '0':
			if($userid != ''){
				$condition = "and (operation = '$userid' or accepter = '$userid') ";
			}
			break;
		case E_MONEY_BAODAN:
			if($userid != ''){
				$condition = "and operation = '$userid' and type = " . E_MONEY_BAODAN;
			} else {
				$condition = "and type = " . E_MONEY_BAODAN;
			}			
			break;
		case E_MONEY_CHONGZHI:
			if($userid != ''){
				$condition = "and accepter = '$userid' and type = " . E_MONEY_CHONGZHI;
			} else {
				$condition = "and type = " . E_MONEY_CHONGZHI;
			}			
			break;
		case E_MONEY_EXCHANGE:
			if($userid != ''){
				$condition = "and (accepter = '$userid' or operation = '$userid') " .
					"and type = " . E_MONEY_EXCHANGE;
			} else {
				$condition = "and type = " . E_MONEY_EXCHANGE;
			}			
			break;
		case E_MONEY_CASH:
			if($userid != ''){
				$condition = "and operation = '$userid' and type = " . E_MONEY_CASH;
			} else {
				$condition = "and type = " . E_MONEY_CASH;
			}
			break;
				case E_MONEY_zhuanhuan:
               
		    	if($userid != ''){
					$condtion = "and operation = '$userid' and type = " . E_MONEY_zhuanhuan;
				}
				else {
				$condition = "and type = " . E_MONEY_zhuanhuan;
			}
			break;
		case E_MONEY_ORDER:
			if($userid != ''){
				$condition = "and operation = '$userid' and type = " . E_MONEY_ORDER;
			} else {
				$condition = "and type = " . E_MONEY_ORDER;
			}
		}
		if ($start != '') {
			$condition .= " and add_date >= '$start 00:00:00' ";
		}
		if ($end != '') {
			$condition .= " and add_date <= '$end 23:59:59' ";
		}
		//总计
		$sql = "select count(id) c, sum(amount) emoneys from ntb_record where 1 $condition";
		$r = $db->select($sql);
		$total = $r[0]->c;
		$recordemoneys = $r[0]->emoneys or $recordemoneys = 0;
		//分页
		$page = $request->getParameter('page');
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=Record&userid=".urlencode($userid)."&choose=$choose";
		$pagehtml = $pager->num_link($url);
		//分页详情
		$sql = "select operation,accepter,add_date,cfnumber,amount,status,type " . 
			   "from ntb_record where 1 $condition " . 
			   "order by add_date desc limit $offset,$pagesize";
		$list = $db->selectarray($sql);
		//处理list
		$pageemoneys = $this->countList($list);
		//
		$request->setAttribute("start",$start);
		$request->setAttribute("end",$end);
		$request->setAttribute("userid",$userid);
		$request->setAttribute("choose",$choose);
		$request->setAttribute("list",$list);
		$request->setAttribute("total",$total);
		$request->setAttribute("recordemoneys",$recordemoneys);
		$request->setAttribute("pageemoneys",$pageemoneys);
		$request->setAttribute("pagehtml",$pagehtml);
		return View :: INPUT;
	}

	public function countList(&$list){
		$emoneys = 0;
		if($list == false){			
			return $emoneys;
		}
		for($i = 0;$i<count($list);$i++){
			$emoneys += $list[$i]['amount'];
			switch($list[$i]['type']){
		case E_MONEY_BAODAN:
				$list[$i]['remark'] = $list[$i]['operation']." 注册报单:".$list[$i]['accepter']." 成功";
				break;
			case E_MONEY_CHONGZHI:
				$list[$i]['remark'] = "注册币充值成功";
				break;
			case E_MONEY_EXCHANGE:
				$list[$i]['remark'] ="转账成功 ". $list[$i]['operation']." 向 ".$list[$i]['accepter']." 进行了转账操作";
				break;
			case E_MONEY_zhuanhuan:
				$list[$i]['remark'] ="电子货币转换成注册币成功";
				break;
			case E_MONEY_CASH:
				$list[$i]['remark'] = "电子货币提现操作成功";
				break;
			// ADD BY FLY AT 2010-05-17 16:16:46
			case E_MONEY_ORDER:
				$list[$i]['remark'] = "产品订购成功";
				break;
			// ADD END
			}
		}
		return $emoneys;
	}

	public function execute() {
		
	}

	public function getRequestMethods() {
		return Request :: NONE;
	}

}

?>