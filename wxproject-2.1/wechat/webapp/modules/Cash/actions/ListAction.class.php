<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class ListAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		$sql = "select * from ntb_record where type=4 and operation='$userid' order by id desc";
		$rr = $db->select($sql);
		
		$request->setAttribute("logs",$rr);
		
		return View :: INPUT;
	}

	public function execute(){
		$request = $this->getContext()->getRequest();
		$can_cash = trim($request->getParameter('can_cash'));
		$amount = intval($request->getParameter('amount'));
		if($amount <= 0 || is_float($amount)){
			header("Content-type:text/html;charset=utf-8");
			echo"<script language='javascript'> " . 
				"alert('请输入格式正确支取金额！');" . 
				"location.href='index.php?module=Cash';</script>";
			
		}
		if($amount <= 0 || $amount > 1000000 ){
			header("Content-type:text/html;charset=utf-8");
			echo"<script language='javascript'> " . 
				"alert('对不起，不能提取此面值的支取金额！');" . 
				"location.href='index.php?module=Cash';</script>";
			return;
		}
		
		//提现操作
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		$sql = "select count(*) sam from ntb_record where type=1  and operation='$userid'";
		$rr = $db->select($sql);
		if($rr[0]->sam == 0){
			header("Content-type:text/html;charset=utf-8");
			echo"<script language='javascript'> " .
					"alert('对不起，你至少需要有一次的购买行为方可提现！');" .
					"location.href='index.php?module=Cash';</script>";
			return;
		}
		
		
		
		$sql = "select * from ntb_const where id=1";
		$rr = $db->select($sql);
		$tax = $rr[0]->tax;
		
		$jine=$amount;
		$amount = $amount-$amount*$tax;
				
		//提现操作
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		//EDIT BY MOX for anti sql inject leaks 2011.8.16
		$cfnumber = addslashes(trim($request->getParameter("cfnumber")));
		//金额足够
		$sql = "select z_money from ntb_user where user_id='$userid'";
		$r = $db->select($sql);
		if(!$r || $r[0]->z_money < $amount){
			$request->setError('error','您的支取金额与税金不能大于当前余额！');
			return $this->getDefaultView();
		}
		//开始提现事务
		$roll_back = false;
		$db->begin();
		do {
			$sql = "update ntb_user set z_money = z_money-$jine " . 
				   "where user_id = '$userid' and z_money >= $jine";
			
			$r = $db->update($sql);
			if($r != 1){
				$roll_back = true;
				break;
			}
			$sql = "insert into ntb_record(operation,amount,cfnumber,type,status,add_date,mtype) " .
				   "values('$userid','$amount','$cfnumber',4,0,CURRENT_TIMESTAMP,1)";
			$r = $db->insert($sql);
			if($r != 1){
				$roll_back = true;
				break;
			}
			
			$cardname = addslashes(trim($request->getParameter("cardname")));
			$provcity = addslashes(trim($request->getParameter("provcity")));
			$cardnumber = addslashes(trim($request->getParameter("cardnumber")));
			$cardnumber = str_replace(' ','',$cardnumber);
			$cardtype = addslashes(trim($request->getParameter("cardtype")));
				
				
			//更新
			$sql = "update ntb_user set " .
					"card_name = '$cardname'," .
					"provcity = '$provcity'," .
					"card_number = '$cardnumber'," .
					"card_type = '$cardtype' " .
					"where user_id = '$userid'";
			$r = $db->update($sql);
			
		}while(0);
		if($roll_back){
			$db->rollback();
			header("Content-type:text/html;charset=utf-8");
			echo"<script language='javascript'> " . 
				"alert('提现申请失败！可能是您的可用货款不足,请及时充值！');" . 
				"location.href='index.php?module=Cash';</script>";
		} else {
			$db->commit();
			header("Content-type:text/html;charset=utf-8");
			echo"<script language='javascript'> " . 
				"alert('支取货款成功！请等待管理员审核汇款！');" . 
				"location.href='index.php?module=Cash';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>