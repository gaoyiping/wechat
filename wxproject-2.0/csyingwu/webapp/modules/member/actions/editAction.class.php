<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = $request->getParameter("id");
		$sql = "select * from ntb_admin where admin_id ='$id'";
		$r = $db->select($sql);
		$request->setAttribute('id',$id);
		$request->setAttribute('permission',unserialize($r[0]->permission));
		return View :: INPUT;
	}

	public function execute(){
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = addslashes(trim($request->getParameter('id')));
		$admin_id = addslashes(trim($request->getParameter('admin_id')));
		$first_pwd = addslashes($request->getParameter('first_pwd'));
		$second_pwd = addslashes($request->getParameter('second_pwd'));
		
		$permissions = serialize(($request->getParameter('permission')));
		
		$setsql=" set admin_id='$admin_id',permission='$permissions' ";
		if($first_pwd!=''){
			$setsql .=" ,first_pwd='".md5($first_pwd)."' ";
		}
		
		if($second_pwd!=''){
			$setsql .=" ,second_pwd='".md5($second_pwd)."' ";
		}
		
		//更新
		$sql = "update ntb_admin " .
			"$setsql" .
			"where admin_id ='$id'";
		
		$r = $db->update($sql);
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，修改信息失败！');" .
				"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('修改信息成功！');" .
				"location.href='index.php?module=member';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>