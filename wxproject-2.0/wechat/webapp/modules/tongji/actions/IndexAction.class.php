<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sql = "select a.*,a.usertype as level,(select p_node from ntb_user_ref c where c.node=a.user_id) as tuijian,(select node from ntb_board_face d where d.node_left=a.user_id or d.node_right=a.user_id limit 1) as anzhi from ntb_user a where a.user_id = '$userid'";
		$r = $db->select($sql);
		
	

		$request->setAttribute('userinfo',$r[0]);
		return View :: INPUT;
	}

	public function execute() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		//取得参数
		//EDIT BY MOX for anti sql inject leaks 2011.8.16
	
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
		//更新
		$sql = "update ntb_user set " .
		
			
			   "address = '$address'," .
			   "card_name = '$cardname'," .
				"provcity = '$provcity'," .   
			   "user_name = '$user_name'," .
			   "card_number = '$cardnumber'," .
			   "card_type = '$cardtype'," .
			   "e_mail = '$email'," .
			   "idno = '$idno'," .
			   "mobile = '$mobile' " .
			   "where user_id = '$userid'";
		$r = $db->update($sql);
		if($r >= 0){
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('修改成功！');" . 
				"location.href='index.php?module=ModifyInfo';</script>";
			return;
		} else {
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('未知原因,修改失败！');" . 
				"location.href='index.php?module=ModifyInfo';</script>";
			return;
		}
		return;
	}

	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>