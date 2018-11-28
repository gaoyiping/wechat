<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		//取得凭证号
		$cfnumber = confirmNum($userid);
		$request->setAttribute("cfnumber",$cfnumber);
		
		//用户信息
		$sql = "select *  from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		if($r){
			$request->setAttribute("username",$r[0]->e_mail);
			
			$sql = "select * from ntb_user_ref where node = '$userid'";
			$r = $db->select($sql);
			$tuanpid = $r[0]->tuanpid;
			$lt = $r[0]->lt;
			$rt = $r[0]->rt;
			$level = $r[0]->level;
			$level31 = $level+2;
			if($tuanpid!=null){
				$request->setAttribute("type",1);
				$sql = "select * from ntb_user_ref where tuanpid = '$tuanpid' and node = '$tuanpid'";
				$r = $db->select($sql);
				$request->setAttribute("tuanname",$r[0]->tuanname);
				$request->setAttribute("tuan",$r[0]->tuan);
			}else{
				$sql = "select count(*) cn from ntb_user_ref where p_node = '$userid'";
				$r = $db->select($sql);
				$cn = $r[0]->cn;
				if($cn==5){
					$request->setAttribute("type",2); //有资格申请团长
					//求当前他的伞下人数，是6人团，还是31人团
					$sql = "select count(*) cn from ntb_user_ref where lt>=$lt and rt<=$rt and level<=$level31";
					
					$r = $db->select($sql);
					if($r[0]->cn == 31){
						$request->setAttribute("level",3);
					}else{
						$request->setAttribute("level",2);
					}
				}else{
					$request->setAttribute("type",3); //没有资格申请团长
					$request->setAttribute("cn",5-$cn);
				}
			}
			
		}
		
		/*
		//用户信息
		$sql = "select bname, z_money, byhname, byinhang, byhsNo from admin_cg_danbao where bloginID = '$userid'";
		$r = $db->select($sql);
		
		if($r){
			if (trim($r[0]->byhname) && trim($r[0]->byinhang) && trim($r[0]->byhsNo)) {
				$request->setAttribute("can_cash", 'true');
			} else {
				$request->setAttribute("can_cash", 'false');
			}
			$request->setAttribute("card_name", $r[0]->byhname);
			$request->setAttribute("card_type", $r[0]->byinhang);
			$request->setAttribute("card_number", $r[0]->byhsNo);
			$request->setAttribute("username",$r[0]->bname);
			$request->setAttribute("emoney",$r[0]->z_money);
		}
		*/
		return View :: INPUT;
	}

	public function execute(){
		$request = $this->getContext()->getRequest();
		$name = trim($request->getParameter('name'));
		$amount = intval($request->getParameter('amount'));
		if($amount==6 || $amount==31){
			
		}else{
			$request->setError('error','当前系统只允许申请6或31人数团队！');
			return $this->getDefaultView();
		}

		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$cfnumber = addslashes(trim($request->getParameter("cfnumber")));
		
		if($amount==31){
			$sql = "select * from ntb_user_ref where node = '$userid'";
			$r = $db->select($sql);
			$tuanpid = $r[0]->tuanpid;
			$lt = $r[0]->lt;
			$rt = $r[0]->rt;
			$level = $r[0]->level;
			$level31 = $level+2;
			//求当前他的伞下人数，是6人团，还是31人团
			$sql = "select count(*) cn from ntb_user_ref where lt>=$lt and rt<=$rt and level<=$level31";
			$r = $db->select($sql);
			if($r[0]->cn < 31){
				$request->setError('error','您的团队还未满31人，不可申请31人团队！');
				return $this->getDefaultView();
			}
		}
		//开始提现事务
		$roll_back = false;
		$db->begin();
		do {
			
			$sql = "insert into ntb_tuan(operation,amount,cfnumber,type,status,add_date,mtype,name) " .
				   "values('$userid','$amount','$cfnumber',0,0,CURRENT_TIMESTAMP,1,'$name')";
			$r = $db->insert($sql);
			if($r != 1){
				$roll_back = true;
				break;
			}
		}while(0);
		if($roll_back){
			$db->rollback();
			header("Content-type:text/html;charset=utf-8");
			echo"<script language='javascript'> " . 
				"alert('申请失败！');" . 
				"location.href='index.php?module=tuan';</script>";
		} else {
			$db->commit();
			header("Content-type:text/html;charset=utf-8");
			echo"<script language='javascript'> " . 
				"alert('成功！请等待管理员审核！');" . 
				"location.href='index.php?module=tuan';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>