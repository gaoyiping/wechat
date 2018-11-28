<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$admin_id = $request->getParameter('admin_id');
		$first_pwd = $request->getParameter('first_pwd');
        $role = 2;

		$request->setAttribute('admin_id', $admin_id);
		$request->setAttribute('first_pwd', $first_pwd);
        $request->setAttribute('role', $role);
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
        $admin_id = addslashes(trim($request->getParameter('admin_id')));
        $first_pwd = md5(addslashes(trim($request->getParameter('first_pwd'))));
        $role = 2;

		//检查管理员名称是否重复
		$sql = "select 1 from ntb_admin where admin_id = '$admin_id'";
		$r = $db->select($sql);
		if ($r) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('该账号 {$admin_id} 已存在！');" .
				"</script>";
			return $this->getDefaultView();
		}

		//添加管理员
		$sql = "insert into ntb_admin(admin_id,first_pwd,role,add_date) "
            ."values('$admin_id','$first_pwd','$role',CURRENT_TIMESTAMP)";

		$r = $db->insert($sql);
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，管理原添加失败！');" .
				"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('管理员添加成功！');" .
				"location.href='index.php?module=addadmin';</script>";
			return $this->getDefaultView();
		}
		
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>