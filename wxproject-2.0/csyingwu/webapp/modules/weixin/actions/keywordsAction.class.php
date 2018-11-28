<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class keywordsAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		
		$name = addslashes(trim($request->getParameter('name')));
		
		//查询条件
		$condition = ' 1=1 ';
		
		if($name != ''){
			$condition .= " and  name= '$name' ";
		}
		
		$sql = "select count(id) c from ecs_weixin_keywords where $condition";
		$r = $db->select($sql);	
		//分页
		$total = intval($r[0]->c);
		$page = intval($request->getParameter('page'));
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$offset = $pager->offset;
		
		$url = "module=weixin&action=keywords&name=".urlencode($name);
		
		$pagehtml = $pager->num_link($url);
		//详情
		$sql = "select * from ecs_weixin_keywords where $condition order by id desc limit $offset,$pagesize";
		$r = $db->select($sql);
		$request->setAttribute('name',$name);
		$request->setAttribute("list",$r);
		$request->setAttribute("pagehtml",$pagehtml);
		
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