<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class modifyAction extends Action {

	public function getDefaultView() {
		
		if($_SESSION['_admin_atype']!=1 && !in_array("b4",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = $request->getParameter("id");
		$xingyun_money = $request->getParameter("xingyun_money");
		$lingdao_money = $request->getParameter("lingdao_money");
		$kaituo_money = $request->getParameter("kaituo_money");
		
		$url = $_SESSION['daili_url'];
		
		$serrnum="1";
		//事务开始
		$db->begin();
		$rollback = false;
		do{
			$sql="update ntb_money set xingyun_money=$xingyun_money,kaituo_money=$kaituo_money,lingdao_money=$lingdao_money  where id = $id ";
		
			$r= $db -> update($sql);
			if ($r < 1) { $rollback = true; $rollcode = 2; break; }
		
		}while(false);
		
		if($rollback == true){
			$db->rollback();
				
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
					"alert('修改奖金失败！');" .
					"location.href='index.php?module=jiang&action=list';</script>";
		} else {
			$db->commit();
				
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
					"alert('修改发金成功！');" .
					"location.href='index.php?module=jiang&action=list';</script>";
		}
		
		
		return;
	}

	public function execute(){		
		
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>