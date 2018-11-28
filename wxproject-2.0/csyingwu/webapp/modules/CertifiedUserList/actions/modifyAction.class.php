<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class modifyAction extends Action {

	public function getDefaultView() {
		
		
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $request->getParameter("id");
		//选择会员信息
		$sql = "select a.*,(select G_CName from admin_cg_group s1 where s1.GroupID=a.sheng ) as s1,(select G_CName from admin_cg_group s2 where s2.GroupID=a.shi ) as s2,(select G_CName from admin_cg_group s3 where s3.GroupID=a.xian ) as s3 from ntb_user a where a.user_id = '$userid'";
		$r = $db->select($sql);
		$jjkghtml="";
		if($r){
			$userinfo = $r[0];
			
		}
		//
		$request->setAttribute('userid',$userid);
		$request->setAttribute('userinfo',$userinfo);
		$request->setAttribute('jjkghtml',$jjkghtml);
		return View :: INPUT;
	}

	public function execute() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $request->getParameter("id");
		//取得参数
		$username = (trim($request->getParameter("username")));
		$idno = (trim($request->getParameter("idno")));
		$provcity = (trim($request->getParameter("provcity")));
		
		$pid = (trim($request->getParameter("pid")));
		$wxname = (trim($request->getParameter("wxname")));
		
		$address = (trim($request->getParameter("address")));
		$cardname = (trim($request->getParameter("cardname")));
		$cardnumber = (trim($request->getParameter("cardnumber")));
		$cardnumber = str_replace(' ','',$cardnumber);
		$cardtype = (trim($request->getParameter("cardtype")));
		$email = (trim($request->getParameter("email")));
		$mobile = (trim($request->getParameter("mobile")));
		
		$sheng = ($request->getParameter("sheng"));
		$shi = ($request->getParameter("shi"));
		$xian = ($request->getParameter("xian"));
		
		$Select1 = ($request->getParameter("Select1"));
		$Select2 = ($request->getParameter("Select2"));
		$Select3 = ($request->getParameter("Select3"));
		
		if($Select1!='0' || $Select2!='0' || $Select3!='0'){
			$sheng=$Select1;
			$shi=$Select2;
			$xian=$Select3;
		}
		
		if($pid==''){
			$pid = NULL;
		}
		
		$oldlevel = intval(trim($request->getParameter("oldlevel")));
		$uplevel = intval(trim($request->getParameter("uplevel")));
		
		
		if($uplevel>-1){
			//更新
			$sql = "update ntb_user set " .
					"user_name = '$username'," .
					"idno = '$idno'," .
					"provcity = '$provcity'," .
					"address = '$address'," .
					"card_name = '$cardname'," .
					"card_number = '$cardnumber'," .
					"card_type = '$cardtype'," .
					"e_mail = '$email'," .
					"uplevel =$uplevel,".
					"sheng =$sheng,".
					"shi =$shi,".
					"xian =$xian,".
					"pid = '$pid',".
					"wxname = '$wxname',".
					"mobile = '$mobile' " .
					"where user_id = '$userid'";
		}else{
			//更新
			$sql = "update ntb_user set " .
					"user_name = '$username'," .
					"idno = '$idno'," .
					"provcity = '$provcity'," .
					"address = '$address'," .
					"card_name = '$cardname'," .
					"card_number = '$cardnumber'," .
					"card_type = '$cardtype'," .
					"e_mail = '$email'," .
					"sheng =$sheng,".
					"shi =$shi,".
					"xian =$xian,".
					"pid = '$pid',".
					"wxname = '$wxname',".
					"mobile = '$mobile' " .
					"where user_id = '$userid'";
		}
		
		
		$r = $db->update($sql);
		$url = "index.php?module=CertifiedUserList&action=modify&id=$userid";
		if($r >= 0){
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('会员信息修改成功！');" . 
				"location.href='$url';</script>";
			return;
		} else {
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('未知原因,会员信息修改失败！');" . 
				"location.href='$url';</script>";
			return;
		}
		return;
	}

	public function getRequestMethods() {
		return Request :: POST;
	}

}

?>