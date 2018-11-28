<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class regmsgAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$sql="select * from ecs_weixin_lang where lang_name='regmsg'";
		$r = $db->select($sql); 
		if($r){
			$request->setAttribute("system",$r[0]);
		}

		return View :: INPUT;
	}

	public function execute(){
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		//取得参数
		$lang_value = addslashes(trim($request->getParameter("regmsg")));
		
		//更新
		$sql = "update ecs_weixin_lang set lang_value = '$lang_value'  where lang_name='regmsg'";
		$r = $db->update($sql);
		if($r >= 0){
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('修改成功！');" . 
				"location.href='index.php?module=weixin&action=regmsg';</script>";
			return;
		} else {
		
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('未知原因,修改失败！');" . 
				"location.href='index.php?module=weixin&action=regmsg';</script>";
			return;
			
		}
		return;
		
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>