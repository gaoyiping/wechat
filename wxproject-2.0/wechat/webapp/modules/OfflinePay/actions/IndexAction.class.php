<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/alipay/alipay_service.class.php');
class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$request->setAttribute('c',$request->getParameter('c'));
		return View :: INPUT;
	}

	public function execute(){
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$request = $this->getContext()->getRequest();
		$money = intval($request->getParameter('money'));
		$username = $request->getParameter('username');
		$bankname = $request->getParameter('bankname');
		$pay_date = $request->getParameter('pay_date');
		
		$db = DBAction::getInstance();
		$db->begin();
		$rollback = false;
		//插入数据
		$insertsql = " insert into ntb_offlinepay values (null,'$userid','$username',$money,'$bankname','$pay_date',CURRENT_TIMESTAMP,NULL)";
		$r = $db->insert($insertsql);
		if($r == -1){ $rollback = true; }
		
		$sql = "insert into ntb_log (sNo,userid,money,event) values (0,'$userid',$money,'线下充值 $money')";
		$r = $db->insert($sql);
		if($r == -1){ $rollback = true; }
		
		if($rollback == false ){
        	$db->commit();
        	header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('信息提交成功！');" .
				"location.href='index.php?module=OfflinePay';</script>";
        }else{
        	$db->rollback();
        	header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，信息提交失败！');" .
				"</script>";
			return $this->getDefaultView();
        }
	}
	
	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>