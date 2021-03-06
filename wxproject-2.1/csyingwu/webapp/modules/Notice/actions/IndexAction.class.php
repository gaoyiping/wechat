<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		return View :: INPUT;
	}

	public function execute() {		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$title = addslashes(trim($request->getParameter('title')));
		$content = addslashes($request->getParameter('content'));
		$sql = "insert into ntb_notice(title,content,add_date) " .
			"values('$title','$content',CURRENT_TIMESTAMP)";
		$r = $db->insert($sql);	
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，添加公告失败！');" .
				"location.href='index.php?module=QueryNotice';</script>";
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('添加公告成功！');" .
				"location.href='index.php?module=QueryNotice';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>