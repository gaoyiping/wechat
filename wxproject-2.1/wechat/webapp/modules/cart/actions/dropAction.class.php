<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/cls_json.php');
class dropAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sessionId = session_id();
		$rec_id = $_GET['rec_id'];
		
		$sql = "delete from ecs_cart  where rec_id=$rec_id";
		$db->update($sql);
			
		header('Content-Type: text/html;charset=utf-8');
		echo "<script type='text/javascript'>" .
				"alert('删除成功！');location.href='index.php?module=cart';" .
				"</script>";
		return ;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}
	
	
	

}

?>