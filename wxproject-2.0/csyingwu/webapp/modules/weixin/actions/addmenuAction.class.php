<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class addmenuAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$sql = "select * from ecs_weixin_menu where parent_id=0";
		$r0 = $db->select($sql);
		$request->setAttribute("parent_menu",$r0);
		return View :: INPUT;
	}

	public function execute(){
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		
		$cat_type = 1;
		$sql = "INSERT INTO ecs_weixin_menu (cat_name, cat_type, weixin_key,links, parent_id, sort_order, weixin_type)
		VALUES ('$_POST[cat_name]', '$cat_type',  '$_POST[weixin_key]','$_POST[links]', '$_POST[parent_id]', '$_POST[sort_order]', '$_POST[weixin_type]')";
		
		$db->insert($sql);
		
		header("Content-type: text/html;charset=utf-8");
		echo"<script language='javascript'>" .
				"alert('添加成功！');" .
				"location.href='index.php?module=weixin&action=menu';</script>";
		return;
		
		
		
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>