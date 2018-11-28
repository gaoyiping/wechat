<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class modifyAction extends Action {

	public function getDefaultView() {
		
		
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $request->getParameter("id");
		//选择会员信息
		$sql = "select * from ntb_user where user_id = '$userid'";
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

		$pid = (trim($request->getParameter("pid")));
		$sqlcmd = "UPDATE `ntb_user` SET `pid`='{$pid}' WHERE `user_id`='{$userid}'";
		$db->update($sqlcmd);

		$uplevel = intval(trim($request->getParameter("uplevel")));
		$sqlcmd = "UPDATE `ntb_user` SET `uplevel`={$uplevel} WHERE `user_id`='{$userid}'";
		$db->update($sqlcmd);

		$url = "index.php?module=CertifiedUserList&action=modify&id={$userid}";

		header("Content-type: text/html;charset=utf-8");
		exit("<script language='javascript'>alert('会员信息修改成功！');location.href='$url';</script>");
	}

	public function getRequestMethods() {
		return Request :: POST;
	}
}

?>