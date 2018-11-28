<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');


class CheckAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter('id'));
		$userid = $request->getParameter('userid');
		$money = intval($request->getParameter('money'));
		$adminid = $this->getContext()->getStorage()->read('_admin_id');
		
		$db->begin();
		$rollback = false;
		$sql = "update ntb_offlinepay set checkuserid='$adminid'  where id = $id";
		$r = $db->update($sql);
		if($r==-1){$rollback=true;}
		
		$sql = "update ntb_user set z_money=z_money+$money  where user_id = '$userid'";
		$r = $db->update($sql);
		if($r==-1){$rollback=true;}
		
		if($rollback == true){
			$db->rollback();
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
					"alert('未知原因，审核失败！');" .
					"</script>";
			return $this->getDefaultView();
		}else{
			$db->commit();
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
					"alert('审核成功！');" .
					"location.href='index.php?module=paycheckout';</script>";
		}
		return;
		
		
	}

	public function execute() {

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>