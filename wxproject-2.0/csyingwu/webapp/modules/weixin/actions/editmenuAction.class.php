<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class editmenuAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$id = addslashes(trim($request->getParameter("id")));
		$sql="select * from ecs_weixin_menu where cat_id=$id";
		$r = $db->select($sql);
		if($r){
			$request->setAttribute("cat",$r[0]);
		}
		
		$sql = "select * from ecs_weixin_menu where parent_id=0";
		$r0 = $db->select($sql);
		$request->setAttribute("parent_menu",$r0);
		
		return View :: INPUT;
	}

	public function execute(){
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		
		$update_sql = "UPDATE  ecs_weixin_menu SET  cat_name = '$_POST[cat_name]', weixin_key ='$_POST[weixin_key]', links ='$_POST[links]', parent_id = '$_POST[parent_id]', cat_type=1, sort_order='$_POST[sort_order]', weixin_type = '$_POST[weixin_type]' WHERE  `cat_id` ='$_POST[cat_id]';";
		$db->update($update_sql);
		
		
		header("Content-type: text/html;charset=utf-8");
		echo"<script language='javascript'>" .
				"alert('修改成功！');" .
				"location.href='index.php?module=weixin&action=menu';</script>";
		return;
		
		
		
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>