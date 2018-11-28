<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class okallAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$ids = $request->getParameter("cfnumber");
		$url = $_SESSION['daili_url'];
		//财务记录
		$sql = "select * from  ntb_record where cfnumber='$ids'";
		$r = $db->select($sql);
		$status = $r[0]->status;
		$userid =  $r[0]->operation;
		 $money = $r[0]->amount;
		 $type = $r[0]->type;
		if($status==0){
			$sql = "update  ntb_record set status=1 where cfnumber='$ids'";
			$r = $db->update($sql);
			if($type==2){
				$sql = "update ntb_user set z_money = z_money + $money where user_id = '$userid'";
				$r = $db->update($sql);
			}else if($type==9){
				$sql = "update ntb_user set h_money = h_money + $money where user_id = '$userid'";
				$r = $db->update($sql);
			}else if($type==12){
				$sql = "update ntb_user set jy_money = jy_money + $money where user_id = '$userid'";
				$r = $db->update($sql);
			}else if($type==15){
				$sql = "update ntb_user set c_z_money = c_z_money + $money where user_id = '$userid'";
				$r = $db->update($sql);
			};
		}
		header('Content-Type: text/html;charset=utf-8');
					echo "<script type='text/javascript'>" .
						"alert('操作成功！');" . 
						"location.href='$url';</script>";
			
		
		
		
	
		return;
	}

	public function execute(){

		
		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>