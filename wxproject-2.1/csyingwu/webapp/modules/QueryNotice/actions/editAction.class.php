<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter("id"));
		$sql = "select * from ntb_notice where id ='$id'";
		$r = $db->select($sql);
		if($r){
			$title = $r[0]->title;
				
			$content = $r[0]->content;			
		}
		$request->setAttribute("title",$title);
		$request->setAttribute("content",$content);
		
			$request->setAttribute('id',$id);
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$title = addslashes(trim($request->getParameter('title')));
		$content = addslashes($request->getParameter('content'));
		$id = intval($request->getParameter('id'));

		//更新
		$sql = "update ntb_notice " .
			"set title = '$title', content = '$content', add_date = CURRENT_TIMESTAMP  " .
			"where id ='$id'";
		$db->update($sql);
		header('Content-Type: text/html;charset=utf-8');
		echo "<script type='text/javascript'> " .
			"alert('公告修改成功！');" .
			"location.href='index.php?module=QueryNotice'; </script>";
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>