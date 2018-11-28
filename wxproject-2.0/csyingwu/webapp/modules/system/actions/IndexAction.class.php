<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$sql="select * from ntb_const where id=1";
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
		$name = (trim($request->getParameter("name")));
		$ds = addslashes(trim($request->getParameter("ds")));
		$tcbl = addslashes(trim($request->getParameter("tcbl")));
		$tax = addslashes(trim($request->getParameter("tax")));
		$psf = addslashes(trim($request->getParameter("psf")));
		$cxbl = addslashes(trim($request->getParameter("cxbl")));
		$pic = '';
		if($_FILES['pic']['tmp_name']!=''){
			$photo_dir=($_FILES['pic']['tmp_name']);
			$phpto_dir_name=($_FILES['pic']['name']);
			move_uploaded_file($photo_dir,"../wechat/shop.jpg");
			$pic = $_FILES['pic']['tmp_name'];
		}
		//更新
		$sql = "update ntb_const set name = '$name',cxbl ='$cxbl',ds =$ds,tcbl = '$tcbl',tax='$tax',psf='$psf' where id=1";
		$r = $db->update($sql);


		if($r >= 0){
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" .
				"alert('修改成功！');" .
				"location.href='index.php?module=system';</script>";
			return;
		} else {

			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" .
				"alert('未知原因,修改失败！');" .
				"location.href='index.php?module=system';</script>";
			return;

		}
		return;

	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>