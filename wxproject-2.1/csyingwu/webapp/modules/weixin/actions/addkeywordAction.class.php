<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class addkeywordAction extends Action {

	public function getDefaultView() {
		
		return View :: INPUT;
	}

	public function execute(){
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		
		//检查是否选择了商品图片
		if($_FILES['pic']['name']=="")
		{
			$path="";
		}
		else
		{
			//将临时文件复制到upload_image目录下
			$photo_dir=$_FILES['pic']['tmp_name'];
			$phpto_dir_name=$_FILES['pic']['name'];
			move_uploaded_file($photo_dir,"../upfile/$phpto_dir_name");
			$path="/upfile/$phpto_dir_name";
		}
		
		$name = $_POST['name'];
		$keyword = $_POST['keyword'];
		$type = $_POST['type'];
		$contents = $_POST['contents'];
		$pic_tit = $_POST['pic_tit'];
		$desc = $_POST['desc'];
		$pic_url = $_POST['pic_url'];
		
		/*检查关键词是否重复*/
		$sql="select * from ecs_weixin_keywords where keyword='$keyword'";
		$r = $db->select($sql);
		if ($r)
		{
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" .
					"alert('$keyword 关键词已经存在！');" .
					"location.href='index.php?module=weixin&action=addkeyword';</script>";
			return;
			
		}
		if ($keyword == 'new' or $keyword == 'best' or $keyword == 'hot' or $keyword == 'promote' or $keyword == 'cxbd' or $keyword == 'quit' or $keyword == 'member')
		{
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" .
					"alert('$keyword 系统保留关键词，不能占用！');" .
					"location.href='index.php?module=weixin&action=addkeyword';</script>";
			return;
		}
		
		
		if($type == 1){
			$db->insert("INSERT INTO ecs_weixin_keywords (`name`, `keyword`, `type`, `contents`, `count`, `status`) VALUES ('$name', '$keyword', $type, '$contents', 0, 1);");
		}elseif($type == 2){
			$img_name = basename($path);
			$db->insert("INSERT INTO ecs_weixin_keywords (`name`, `keyword`, `type`, `pic`, `pic_tit`, `desc`, `pic_url`, `count`, `status`) VALUES ('$name', '$keyword', $type, '$img_name', '$pic_tit', '$desc', '$pic_url', 0, 1);");
		}
		
		header("Content-type: text/html;charset=utf-8");
		echo"<script language='javascript'>" .
				"alert('添加成功！');" .
				"location.href='index.php?module=weixin&action=keywords';</script>";
		return;
		
		
		
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>