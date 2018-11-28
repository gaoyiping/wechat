<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class replayAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();	
		$request = $this->getContext()->getRequest();		
		//查询对应的留言
		$id = intval($request->getParameter("id"));
		$sql = "select * from ntb_message where id = '$id'";
		$r = $db->select($sql);
		if($r){
			$msg = $r[0];
		}
		$request->setAttribute("msg",$msg);
		$request->setAttribute("id",$id);
		return View :: INPUT;
	}

	public function execute(){		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$adminid = $this->getContext()->getStorage()->read('_admin_id');
		$id = intval($request->getParameter('id'));
		$content = converToHTML(trim($request->getParameter('content')));
		//回复留言
		$sql = "update ntb_message set " .
			"r_content = '$content',r_date = CURRENT_TIMESTAMP " .
			"where id = '$id'";
		$db->update($sql);
		header('Content-Type: text/html;charset=utf-8');
		echo "<script type='text/javascript'>" .
			"alert('成功回复留言！');" .
			"location.href='index.php?module=Message';</script>";
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>