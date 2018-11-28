<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/alipay/alipay_submit.class.php');
require_once(MO_LIB_DIR . '/alipay/alipay.config.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {
	
	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$request->setAttribute('c',$request->getParameter('c'));
		$userid = $this->getContext()->getStorage()->read('_user_id');
		//用户信息
		$sql = "select * from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		
		if($r){
			$request->setAttribute("emoney",$r[0]->z_money);
		}
		
		return View :: INPUT;
	}

	public function execute(){
		
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$money =floatval($request->getParameter('amount'));
		$cfnumber = confirmNum($userid);
		
        //财务记录
        $db = DBAction::getInstance();
        $type = E_MONEY_CHONGZHI;
        $sql = "insert into ntb_record (operation,amount,cfnumber,type,status,add_date,mtype) values ('$userid',$money,'$cfnumber','$type',0,CURRENT_TIMESTAMP,1)";
        $r = $db->insert($sql);
        
        $sql_2 = "insert into ntc_rorder_temp(" .
        		"user_id, post_name, post_tel, post_address, " .
        		"way, counts, moneys, emoneys, status, add_date,stype,sNo,dianpu,type,sheng,shi,xian,qianbao,wxqianbao,otype) values(" .
        		"'".$userid."','','','',1,0,".$money.",".$money.",'0', CURRENT_TIMESTAMP,'0','$cfnumber','',0,'0','0','0',0,$money,1)";
        $r_2 = $db->insert($sql_2, "last_insert_id");
        
        header("Location:/wechat/js_api_call.php?dingdan=$cfnumber&wxqianbao=$money");




		return ;
	}
	
	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>