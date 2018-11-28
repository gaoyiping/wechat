<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class menuAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$sql = "select * from ecs_weixin_menu where parent_id=0";
		$r0 = $db->select($sql);
		$array = array();
		
		for($i=0;$i<count($r0);$i++){
			$node=$r0[$i];
			$array[]=$node;
			$sql = "select * from ecs_weixin_menu where parent_id=".$node->cat_id." order by sort_order	asc";
			$r1 = $db->select($sql);
			for($j=0;$j<count($r1);$j++){
				$array[]=$r1[$j];
			}
		}
		
		
		if($array){
			$request->setAttribute("system",$array);
		}

		return View :: INPUT;
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