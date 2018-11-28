<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class detailAction extends Action {

	public function getDefaultView() {
		
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		
		$admin_id = addslashes(trim($request->getParameter('admin_id')));
		$first_pwd = md5(addslashes($request->getParameter('first_pwd')));
		$second_pwd = md5(addslashes($request->getParameter('second_pwd')));
		
		
		//更新
		$sql = "insert ntb_admin (admin_id,first_pwd,second_pwd) values ('$admin_id','$first_pwd','$second_pwd')";
		
		$r = $db->insert($sql);
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
					"alert('未知原因，新增失败！');" .
					"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
					"alert('新增成功！');" .
					"location.href='index.php?module=member';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>