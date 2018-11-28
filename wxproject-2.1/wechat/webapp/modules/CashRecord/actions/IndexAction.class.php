<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$choose = strval($request->getParameter("choose"));
		$startdate = strval($request->getParameter("startdate"));
		$enddate = strval($request->getParameter("enddate"));
		if ($choose == '') { $choose = '32'; }
		//条件
		switch($choose){
		case '0':
			$condtion = "and (operation = '$userid' or accepter = '$userid') ";
			break;
		case E_MONEY_BAODAN:
			$condtion = "and operation = '$userid' and type = " . E_MONEY_BAODAN;
			break;
		case E_MONEY_CHONGZHI:
			$condtion = "and accepter = '$userid' and type = " . E_MONEY_CHONGZHI;
			break;
		case E_MONEY_EXCHANGE . '1':
			$condtion = "and accepter = '$userid' and type = " . E_MONEY_EXCHANGE;
			break;
		case E_MONEY_EXCHANGE . '2':
			$condtion = "and operation = '$userid' and type = " . E_MONEY_EXCHANGE;
			break;
		case E_MONEY_CASH:
			$condtion = "and operation = '$userid' and type = " . E_MONEY_CASH;
			break;
			case E_MONEY_zhuanhuan:
			$condtion = "and operation = '$userid' and type = " . E_MONEY_zhuanhuan;
			break;
		// ADD BY FLY AT 2010-05-17 16:14:24
		case E_MONEY_ORDER:
			$condtion = "and operation = '$userid' and type = " . E_MONEY_ORDER;
			break;
		// ADD END
		}
		//总计
		$sql = "select count(id) c,sum(amount) amounts from ntb_record where 1 ";
		$sql .= $condtion;
		$r = $db->select($sql);
		$total = $r[0]->c;
		if ($choose/10 == E_MONEY_EXCHANGE . '1' 
				|| $choose == E_MONEY_EXCHANGE . '2' ) { $total = $total > 20 ? 20 : $total; }
		$amounts = $r[0]->amounts;
		//分页
		$page = $request->getParameter('page');
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		$pagehtml = $pager->num_link("module=CashRecord&choose=$choose");
		//分页详情
		$sql = "select operation,accepter,add_date,cfnumber,amount,status,type " . 
			   "from ntb_record where 1 $condtion " . 
			   "order by id desc limit $offset,$pagesize";
		
		$list = $db->selectarray($sql);
		//处理list
		$this->countList($list,$page_amounts);
		//用户余额
		$sql = "select e_money,z_money from ntb_user where user_id = '$userid' ";
		$r = $db->select($sql);
		$r?$emoney=$r[0]->e_money:$emoney=0; 
			$r?$z_money=$r[0]->z_money:$z_money=0; 
		//
		$request->setAttribute("amounts",$amounts);
		$request->setAttribute("list",$list);
		$request->setAttribute("userid",$userid);
		$request->setAttribute("page_amounts",$page_amounts);
		$request->setAttribute("pagehtml",$pagehtml);
		$request->setAttribute("choose",$choose);
		$request->setAttribute("emoney",$emoney);
		$request->setAttribute("z_money",$z_money);
		$request->setAttribute("startdate",$startdate);
		$request->setAttribute("enddate",$enddate);
		return View :: INPUT;
	}

	public function countList(&$list,&$page_amounts){
		$page_amounts = 0;
		if($list == false){			
			return;
		}
		for($i = 0;$i<count($list);$i++){
			$page_amounts += $list[$i]['amount'];
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
	}

	public function execute(){
		 
	}
	
	public function getRequestMethods(){
		return Request :: NONE ;
	}

}
?>