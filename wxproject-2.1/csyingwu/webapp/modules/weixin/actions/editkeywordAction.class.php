<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class editkeywordAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$id = addslashes(trim($request->getParameter("id")));
		$sql="select * from ecs_weixin_keywords where id=$id";
		$r = $db->select($sql);
		if($r){
			$request->setAttribute("system",$r[0]);
		}
		return View :: INPUT;
	}

	public function execute(){
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		
		//检查是否选择了商品图片
		if($_FILES['new_pic']['name']=="")
		{
			$path=$_POST['pic'];
		}
		else
		{
			//将临时文件复制到upload_image目录下
			$photo_dir=$_FILES['new_pic']['tmp_name'];
			$phpto_dir_name=$_FILES['new_pic']['name'];
			move_uploaded_file($photo_dir,"../upfile/$phpto_dir_name");
			$path="/upfile/$phpto_dir_name";
		}
		$id = $_POST['id'];
		$name = $_POST['name'];
		$keyword = $_POST['keyword'];
		$new_keyword = $_POST['new_keyword'];
		$type = $_POST['type'];
		$contents = $_POST['contents'];
		$pic_tit = $_POST['pic_tit'];
		$desc = $_POST['desc'];
		$pic_url = $_POST['pic_url'];
		
		
		if($keyword!=$new_keyword){
			
			/*检查关键词是否重复*/
			$sql="select * from ecs_weixin_keywords where keyword='$new_keyword'";
			$r = $db->select($sql);
			if ($r)
			{
				header("Content-type: text/html;charset=utf-8");
				echo"<script language='javascript'>" .
						"alert('$keyword 关键词已经存在！');" .
						"location.href='index.php?module=weixin&action=keywords';</script>";
				return;
					
			}
			
			
			if ($new_keyword == 'new' or $new_keyword == 'best' or $new_keyword == 'hot' or $new_keyword == 'promote' or $new_keyword == 'cxbd' or $new_keyword == 'quit' or $new_keyword == 'member')
			{
				header("Content-type: text/html;charset=utf-8");
				echo"<script language='javascript'>" .
						"alert('$keyword 系统保留关键词，不能占用！');" .
						"location.href='index.php?module=weixin&action=keywords';</script>";
				return;
			}
			
		}
		
		
		if($type == 1){
			$update_sql = "UPDATE  ecs_weixin_keywords SET  `name` =  '$name',`keyword` =  '$new_keyword',`type` =  '$type',`contents` =  '$contents' WHERE  `id` ='$id';";
			$db->update($update_sql);
		}elseif($type == 2){
			$img_name = basename($path);
			$update_sql = "UPDATE  ecs_weixin_keywords SET  `name` =  '$name',`keyword` =  '$new_keyword',`type` =  '$type',`pic` =  '$img_name',`pic_tit` =  '$pic_tit',`desc` =  '$desc',`pic_url` =  '$pic_url' WHERE  `id` ='$id';";
			$db->update($update_sql);
		}
		
		header("Content-type: text/html;charset=utf-8");
		echo"<script language='javascript'>" .
				"alert('修改成功！');" .
				"location.href='index.php?module=weixin&action=keywords';</script>";
		return;
		
		
		
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>