<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$start = $request->getParameter("start");
		$end = $request->getParameter("end");
		$userid = $request->getParameter("userid");
		$touserid = $request->getParameter("touserid");
		$choose = intval($request->getParameter("choose"));
		
		$sql = "select * from ntb_const where id=1";
		$rr = $db->select($sql);
		$tax = $rr[0]->tax;
		
		//条件
		$condition = " ";
		

		if ($choose!=0) {
			$condition .= "and type = $choose " ;
		}

		if ($userid!='') {
			$condition .= "and operation = '$userid'" ;
		}

		if ($touserid!='') {
			$condition .= "and accepter = '$touserid'" ;
		}
				
		

		if ($start != '') {
			$condition .= " and add_date >= '$start 00:00:00' ";
		}
		if ($end != '') {
			$condition .= " and add_date <= '$end 23:59:59' ";
		}
		
		$condition .= " and mtype = 1  ";
		//总计
		$sql = "select count(id) c, sum(amount) emoneys from ntb_record where 1=1  $condition";
		$r = $db->select($sql);
		$total = $r[0]->c;
		$recordemoneys = $r[0]->emoneys or $recordemoneys = 0;
		//分页
		$page = $request->getParameter('page');
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$url = "module=FinanceLog&userid=".urlencode($userid)."&choose=$choose&touserid=$touserid";
		$pagehtml = $pager->num_link($url);
		//分页详情
		$sql = "select operation,accepter,add_date,cfnumber,amount,status,type " . 
			   "from ntb_record where 1=1 $condition " . 
			   "order by add_date desc limit $offset,$pagesize";
		$list = $db->selectarray($sql);
		
		//处理list
		$pageemoneys = $this->countList($list,$tax);
		//
		$request->setAttribute("start",$start);
		$request->setAttribute("end",$end);
		$request->setAttribute("userid",$userid);
		$request->setAttribute("touserid",$touserid);
		$request->setAttribute("choose",$choose);
		$request->setAttribute("list",$list);
		$request->setAttribute("total",$total);
		$request->setAttribute("recordemoneys",$recordemoneys);
		$request->setAttribute("pageemoneys",$pageemoneys);
		$request->setAttribute("pagehtml",$pagehtml);
		return View :: INPUT;
	}

	public function countList(&$list,$tax){
		
		
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
				if($list[$i]['amount']>0){
					$list[$i]['remark'] ="转账成功 ". $list[$i]['accepter']." 向 ".$list[$i]['operation']." 进行了转账操作";
				}else{
					$list[$i]['remark'] ="转账成功 ". $list[$i]['operation']." 向 ".$list[$i]['accepter']." 进行了转账操作";
				}
				
				break;
			case E_MONEY_ZHUANHUAN:
				$list[$i]['remark'] ="电子货币转换成注册币成功";
				break;
			case E_MONEY_CASH:
				$list[$i]['remark'] = "电子货币提现操作成功，提现扣税:￥".-$list[$i]['amount']*(1-$tax)*$tax." ，总计：￥".($list[$i]['amount']*(1-$tax)) ;
				break;
			// ADD BY FLY AT 2010-05-17 16:16:46
			case E_MONEY_ORDER:
				$list[$i]['remark'] = "产品订购成功";
				break;

				case 8:
				if($list[$i]['amount']>0){
					$list[$i]['remark'] ="转账成功 ". $list[$i]['accepter']." 向 ".$list[$i]['operation']." 进行了购物币转账操作";
				}else{
					$list[$i]['remark'] ="转账成功 ". $list[$i]['operation']." 向 ".$list[$i]['accepter']." 进行了购物币转账操作";
				}
				
				break;

				case 9:
				if($list[$i]['amount']>0){
					$list[$i]['remark'] ="转账成功 ". $list[$i]['accepter']." 向 ".$list[$i]['operation']." 进行了充值币转账操作";
				}else{
					$list[$i]['remark'] ="转账成功 ". $list[$i]['operation']." 向 ".$list[$i]['accepter']." 进行了充值币转账操作";
				}
				
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