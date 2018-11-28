<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
	
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		//用户信息
		$sql = "select * from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		
		if($r){
			
			$request->setAttribute("user",$r[0]);
		}
		
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$adminid = $this->getContext()->getStorage()->read('_user_id');
		//获取参数
		$userid = "wrj".strtolower(addslashes(trim($request->getParameter('userid'))));
		$nummoney = intval($request->getParameter('amount'));
		$password = md5(addslashes(trim($request->getParameter('password'))));
		$sex = intval($request->getParameter('sex'));
		$cfnumber = "NK".date("ymdhis").rand(0,9).rand(0,9).rand(0,9);
		$type = $request->getParameter('type');
		
		
		$sql = "select * from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		if(!$r){
			header("Content-Type: text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
						"alert('用户不存在！');" .
						"location.href='index.php?module=nochizhi'; </script>";
			return ;
		}
		
		
		//用户信息
		$sql = "select user_name, j_money  from ntb_user where user_id = '$adminid'";
		$r = $db->select($sql);
		$z_money = $r[0]->j_money;
		
		if($z_money<$nummoney){
			header("Content-Type: text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
						"alert('转币金额不足！');" .
						"location.href='index.php?module=nochizhi'; </script>";
			return ;
						
		}
		
		//验证参数		
		if($nummoney <= 0){
			header("Content-Type: text/html;charset=utf-8");
				echo "<script type='text/javascript'>" .
						"alert('转币金额不能小于等于零！');" .
						"location.href='index.php?module=nochizhi'; </script>";
				return ;
		}
		
		
		if($type=='user'){
			//用户充值
			$rollback = false;
			$db->begin();
			do{
				if($nummoney>=0){
					$sql = "update ntb_user set z_money = z_money + $nummoney " .
					"where user_id = '$userid' ";
					
					$r = $db->update($sql);
					
					if($r <= 0){
						$rollback = true;
						break;
					}

					$sql = "update ntb_user set j_money = j_money - $nummoney " .
					"where user_id = '$adminid' ";
						
					$r = $db->update($sql);
						
					if($r <= 0){
						$rollback = true;
						break;
					}
					
				}
				
				
				$sql="insert into ntb_log (userid,money,event,utype) values ('$userid',$nummoney,'会员 $adminid 为 $userid 充值金额:$nummoney',1) ";
				$r= $db -> update($sql);
				
				
				//财务记录
				$type = E_MONEY_EXCHANGE;
				$sql = "insert into ntb_record (operation,amount,type,status,add_date,mtype,accepter) values ('$adminid','-$nummoney','$type',1,CURRENT_TIMESTAMP,1,'$userid')";
				$r = $db->insert($sql);
				if($r == -1){ $rollback = true;$serrnum=19; break; }
				
				$sql = "insert into ntb_record (operation,amount,type,status,add_date,mtype,accepter) values ('$userid','$nummoney','$type',1,CURRENT_TIMESTAMP,1,'$adminid')";
				$r = $db->insert($sql);
				if($r == -1){ $rollback = true;$serrnum=19; break; }
				
			
			}while(false);
			if($rollback){
				$db->rollback();
				header("Content-Type: text/html;charset=utf-8");
				echo "<script type='text/javascript'>" .
						"alert('未知原因，转币失败！');" .
						"location.href='index.php?module=nochizhi'; </script>";
			} else {
				$db->commit();
				header("Content-Type: text/html;charset=utf-8");
				echo "<script type='text/javascript'>" .
						"alert('转币成功！');" .
						"location.href='index.php?module=nochizhi&action=List'; </script>";
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