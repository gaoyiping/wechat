<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
	
		
		
		$request = $this->getContext()->getRequest();	
		$admin_atype = $this->getContext()->getStorage()->read('_admin_atype');
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$adminid = $this->getContext()->getStorage()->read('_admin_id');
		//获取参数
		$userid = strtolower(addslashes(trim($request->getParameter('userid'))));
		$nummoney = intval($request->getParameter('amount'));
		$password = md5(addslashes(trim($request->getParameter('password'))));
		$sex = intval($request->getParameter('sex'));
		$cfnumber = "NK".date("ymdhis").rand(0,9).rand(0,9).rand(0,9);
		$type = $request->getParameter('type');
		//验证参数		
		if($nummoney == 0){
			$request->setError('error',"充值金额不能为零！");
			return $this->getDefaultView();
		}
		
		$sql = "select admin_id,first_pwd,admin_atype,permission from ntb_admin where " .
				"admin_id = '$adminid' and second_pwd = '$password'";
		$result = $db->select($sql);
		
		if($result==false){
			$request->setError('error',"二级密码有误！");
			return $this->getDefaultView();
		}
		
		if($type=='user'){
			//用户充值
			$rollback = false;
			$db->begin();
			do{
				if($nummoney>=0){
					$sql = "update ntb_user set c_money = c_money + $nummoney " .
					"where user_id = '$userid' ";
				}else{
					$sql = "update ntb_user set c_money = c_money  $nummoney " .
					"where user_id = '$userid' ";
				}
				$r = $db->update($sql);
				if($r <= 0){
					$rollback = true;
					break;
				}
				$sql="insert into ntb_log (userid,money,event,utype) values ('$userid',$nummoney,'管理员 $adminid 为 $userid 充值充值币金额:$nummoney',3) ";
				$r= $db -> update($sql);
				
			}while(false);
			if($rollback){
				$db->rollback();
				header("Content-Type: text/html;charset=utf-8");
				echo "<script type='text/javascript'>" .
						"alert('未知原因，充值失败！');" .
						"location.href='index.php?module=chizhi'; </script>";
			} else {
				$db->commit();
				header("Content-Type: text/html;charset=utf-8");
				echo "<script type='text/javascript'>" .
						"alert('充值成功！');" .
						"location.href='index.php?module=chizhi'; </script>";
			}
			//over	
		}else{
			//店铺注册币充值
			$rollback = false;
			$db->begin();
			do{
					$sql = "update admin_cg_danbao set z_money = z_money + $nummoney " .
						"where bloginID = '$userid' ";
					$r = $db->update($sql);
					if($r <= 0){
						$rollback = true;
						break;
					}
	
					$sql = "insert into " .
					"ntb_record_copy(operation,accepter,amount,cfnumber,type,status,add_date,replay_date) " .
					"values('$userid','$userid','$nummoney','$cfnumber',".E_MONEY_CHONGZHI.
					",1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
				
				$r = $db->insert($sql);
				if($r == -1){
					$rollback = true;
					break;
				}
	
	
			}while(false);
			if($rollback){
				$db->rollback();
				header("Content-Type: text/html;charset=utf-8");
				echo "<script type='text/javascript'>" .
					"alert('未知原因，充值失败！');" .
					"location.href='index.php?module=nochizhi'; </script>";
			} else {
				$db->commit();
				header("Content-Type: text/html;charset=utf-8");
				echo "<script type='text/javascript'>" .
					"alert('充值成功！');" .
					"location.href='index.php?module=nochizhi'; </script>";
			}
			//over
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>