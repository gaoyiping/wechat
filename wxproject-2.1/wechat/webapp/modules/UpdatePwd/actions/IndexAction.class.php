<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$request->setAttribute('c',$request->getParameter('c'));
		return View :: INPUT;
	}

	public function execute(){
		$request = $this->getContext()->getRequest();
		$oldpwd = md5(strtolower($request->getParameter('oldpwd')));
		$pwd1 = md5(strtolower($request->getParameter('pwd1')));
		$pwd2 = md5(strtolower($request->getParameter('pwd2')));
		if( $pwd1 != $pwd2 ){
			$request->setError('error','密码输入不一致，请重新输入！');
			return $this->getDefaultView();
		}
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$c = intval($request->getParameter('c'));
		//旧密码正确
		$sql = "select first_pwd,second_pwd from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		if(!$r){
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('未知原因,密码修改失败！');" . 
				"location.href='index.php?module=UpdatePwd';</script>";
			return;
		}
		$update_pwd = '';
		if($c == 0){ $update_pwd = $r[0]->first_pwd;}
		if($c == 1){ $update_pwd = $r[0]->second_pwd;}
		if($update_pwd != $oldpwd){
			$request->setError('error','旧密码不正确！');
			return $this->getDefaultView();
		}
		//修改密码
		$new_pwd = $pwd1;
		$sql = "update ntb_user set %s = '$new_pwd' where user_id = '$userid'";
		if($c == 0){ $sql = sprintf($sql,'first_pwd'); }
		if($c == 1){ $sql = sprintf($sql,'second_pwd'); }
		$r = $db->update($sql);
		if($r >= 0){
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('密码修改成功！');" . 
				"location.href='index.php?module=UpdatePwd';</script>";
			return;
		} else {
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('未知原因,密码修改失败！');" . 
				"location.href='index.php?module=UpdatePwd';</script>";
			return;
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>