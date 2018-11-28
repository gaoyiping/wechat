<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter("id"));
		$admin_id = $request->getParameter("admin_id");
        $first_pwd = $request->getParameter("first_pwd");

			$sql = "select id,admin_id,first_pwd from ntb_admin where id = '$id'";
			$r = $db->select($sql);
			if($r != ''){
				$request->setAttribute('info', $r[0]);
			}


		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter('id'));
		$admin_id = trim($request->getParameter('admin_id'));
		$first_pwd = md5(trim($request->getParameter('first_pwd')));

		//更新管理员列表
		$sql = "update ntb_admin " .
			"set admin_id = '$admin_id', first_pwd = '$first_pwd'"
			."where id = '$id'";

		
		$r = $db->update($sql);

		if($r == -1) {
		echo "<script type='text/javascript'>" .
				"alert('修改管理员失败！');" .
				"location.href='index.php?module=addadmin';</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('修改管理员成功！');" .
				"location.href='index.php?module=addadmin';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>