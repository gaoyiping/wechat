<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		
		if($_SESSION['_admin_atype']!=1 && !in_array("d2",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		$request = $this->getContext()->getRequest();
		$request->setAttribute('title',$request->getParameter('title'));
		$request->setAttribute('content',$request->getParameter('content'));
		$request->setAttribute('toid',$request->getParameter('toid'));
		$request->setAttribute('choose',$request->getParameter('choose'));

	
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		
		$sex = addslashes(trim($request->getParameter('sex')));
		$content = addslashes(trim(converToHTML($request->getParameter('content'))));
		$toid = addslashes(trim($request->getParameter('toid')));
		

				//给普通会员留言
				$sql = "select user_id from ntb_user where user_id = '$toid'";
				$r = $db->select($sql);
				if(!$r){
				
						header("Content-type: text/html;charset=utf-8");
						echo"<script language='javascript'>" . 
						"alert('该会员不存在！');" . 
						"location.href='index.php?module=Message';</script>";
			             return ;
				}
					//插入留言
				$sql = "insert into ntb_message(user_id,title,content,add_date,r_user_id,isdu) " .
					   "values('admin','','$content',CURRENT_TIMESTAMP,'$toid',0)";
				$r = $db->insert($sql);
			
		
			
			
		if($r == -1){
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('未知原因,发送失败！');" . 
				"location.href='index.php?module=Message';</script>";
		} else {
			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" . 
				"alert('发送成功！');" . 
				"location.href='index.php?module=Message';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>