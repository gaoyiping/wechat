<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class bankAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sql = "select a.* from ntb_user a where a.user_id = '$userid'";
		$r = $db->select($sql);
		
		$userinfo = $r[0];
		

		$request->setAttribute('userinfo',$userinfo);
		return View :: INPUT;
	}

	public function execute() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		//取得参数
	
		$address = addslashes(trim($request->getParameter("address")));
		$cardname = addslashes(trim($request->getParameter("cardname")));
	
		$provcity = addslashes(trim($request->getParameter("provcity")));
		$cardnumber = addslashes(trim($request->getParameter("cardnumber")));
		$cardnumber = str_replace(' ','',$cardnumber);
		$cardtype = addslashes(trim($request->getParameter("cardtype")));
		$email = addslashes(trim($request->getParameter("email")));
		$idno = addslashes(trim($request->getParameter("idno")));
		$user_name= addslashes(trim($request->getParameter("user_name")));
		$mobile = addslashes(trim($request->getParameter("mobile")));
		
		$sheng = addslashes(trim($request->getParameter("sheng")));
		$shi = addslashes(trim($request->getParameter("shi")));
		$xian = addslashes(trim($request->getParameter("xian")));
		
		
		//更新
		$sql = "update ntb_user set " .
			   "provcity = '$provcity'," . 
			   "card_name = '$cardname'," .
			   "card_number = '$cardnumber'," .
			   "card_type = '$cardtype' " .
			   "where user_id = '$userid'";
		$r = $db->update($sql);
		if($r >= 0){
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('修改成功！');" . 
				"location.href='index.php?module=ModifyInfo&action=bank';</script>";
			return;
		} else {
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('未知原因,修改失败！');" . 
				"location.href='index.php?module=ModifyInfo&action=bank';</script>";
			return;
		}
		return;
	}

	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>