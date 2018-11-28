<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class okallAction extends Action {

	public function getDefaultView() {
		return;
	}

	public function execute(){

		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$uid = $request->getParameter("uid");
		$url = $_SESSION['daili_url'];
		
		$z_money = floatval($request->getParameter("z_money"));
		$e_money = floatval($request->getParameter("e_money"));
		$f_money = floatval($request->getParameter("f_money"));
		$j_money = floatval($request->getParameter("j_money"));
		$c_money = floatval($request->getParameter("c_money"));

		$adminid = $this->getContext()->getStorage()->read('_admin_id');
		$password = md5(addslashes(trim($request->getParameter('password'))));


		$sql = "select admin_id,first_pwd,admin_atype,permission from ntb_admin where " .
				"admin_id = '$adminid' and second_pwd = '$password'";
		$result = $db->select($sql);
		
		if($result==false){

			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
							"alert('二级密码有误！');" . 
					"location.href='$url';</script>";
			return ;
		}
		
		//事务开始
		$db->begin();
		$rollback = false;
		do{ 
                       
                       
           //修改奖金记录状态成已发放
			$sql="update ntb_user set z_money=$z_money,e_money=$e_money,f_money=$f_money,j_money=$j_money,c_money=$c_money where user_id = '$uid' ";
			
			$r= $db -> update($sql);
			if ($r < 1) { $rollback = true; $rollcode = 2; break; }		

			$sql="insert into ntb_log (userid,money,event,utype) values ('$uid',0,'管理员 $adminid 为 $uid 修改累计积分 $e_money 修改积分余额 $j_money',4) ";
			$db -> update($sql);
				
		}while(false);

			    if($rollback == true){
					$db->rollback(); 
					 header('Content-Type: text/html;charset=utf-8');
						echo "<script type='text/javascript'>" .
							"alert('失败！');" . 
							"location.href='$url';</script>";
				} else {
					$db->commit();
				
					header('Content-Type: text/html;charset=utf-8');
					echo "<script type='text/javascript'>" .
						"alert('成功！');" . 
						"location.href='$url';</script>";
				}
		
		
		
	
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>