<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class deleteAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();		
		$id = intval($request->getParameter('id'));
		$sql = "delete from ecs_weixin_keywords  where id = $id";
		$db->update($sql);
		header("Content-type:text/html;charset=utf-8");
		echo "<script type='text/javascript'>" .
			"alert('删除成功！');" .
			"location.href='index.php?module=weixin&action=keywords';</script>";
		return;
	}

	public function execute(){
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		//取得参数
		$token = addslashes(trim($request->getParameter("token")));
		$appid = addslashes(trim($request->getParameter("appid")));
		$appsecret = addslashes(trim($request->getParameter("appsecret")));
		
		//更新
		$sql = "update ecs_weixin_config set token = '$token',appid ='$appid',appsecret = '$appsecret' where id=1";
		$r = $db->update($sql);
		if($r >= 0){
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('修改成功！');" . 
				"location.href='index.php?module=weixin';</script>";
			return;
		} else {
		
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('未知原因,修改失败！');" . 
				"location.href='index.php?module=weixin';</script>";
			return;
			
		}
		return;
		
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>