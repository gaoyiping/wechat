<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sql = "select a.* from ntb_user a where a.user_id = '$userid'";
		$r = $db->select($sql);
		
		$userinfo = $r[0];
		
		
		$sql = "select  *  from admin_cg_group a  where a.G_ParentID=0";
		$r = $db->select($sql);
		$request->setAttribute('shengs',$r);
			
		$sql = "select  *  from admin_cg_group a  where a.G_ParentID=".$userinfo->sheng;
		$r = $db->select($sql);
		$request->setAttribute('shis',$r);
			
		
		$sql = "select  *  from admin_cg_group a  where a.G_ParentID=".$userinfo->shi;
		$r = $db->select($sql);
		$request->setAttribute('xians',$r);
		

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
		$user_name= addslashes(trim($request->getParameter("user_name")));
		$mobile = addslashes(trim($request->getParameter("mobile")));
		
		//更新
		$sql = "update ntb_user set " .
			   "address = '$address'," . 
			   "user_name = '$user_name'," .
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