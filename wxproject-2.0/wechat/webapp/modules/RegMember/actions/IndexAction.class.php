<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/AppLog.class.php');
require_once(MO_LIB_DIR . '/core/AppException.class.php');
require_once(MO_LIB_DIR . '/core/InBlackBoard.class.php');

/**
 * 调用核心业务处理流程
 * 待改进:
 * 1.并发的互斥，使用php中文件锁
 * 2.使用异常类，改进数据库操作出错的处理机制和代码结构
 */
class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();		
		$request->setAttribute("pid",$request->getParameter("pid"));
		$request->setAttribute("cID",$request->getParameter("cID"));
		$aid = strtolower(addslashes(trim($request->getParameter("aid"))));
		$request->setAttribute("uid",$request->getParameter("uid"));
		$request->setAttribute("username",$request->getParameter("username"));
		$request->setAttribute("idno",$request->getParameter("idno"));
		$request->setAttribute("area",$request->getParameter("area"));
		$request->setAttribute("address",$request->getParameter("address"));
		$request->setAttribute("cardname",$request->getParameter("cardname"));
		$request->setAttribute("provcity",$request->getParameter("provcity"));
		$request->setAttribute("cardnumber",$request->getParameter("cardnumber"));
		$request->setAttribute("cardtype",$request->getParameter("cardtype"));
		$request->setAttribute("tel",$request->getParameter("tel"));
		$request->setAttribute("mobile",$request->getParameter("mobile"));
		$request->setAttribute("email",$request->getParameter("email"));
		$request->setAttribute("squyu",$request->getParameter("squyu"));
			$request->setAttribute("usertype",$request->getParameter("usertype"));
	
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		//获取页面参数
		$pid = strtolower(addslashes(trim($request->getParameter("pid"))));
		$aid = strtolower(addslashes(trim($request->getParameter("aid"))));
		$uid = strtolower(addslashes(trim($request->getParameter("uid"))));
		$username = trim($request->getParameter("username"));
		$idno = trim($request->getParameter("idno"));
		//$area = trim($request->getParameter("area"));
		$address = trim($request->getParameter("address"));
		$cardname = trim($request->getParameter("cardname"));
		$provcity = trim($request->getParameter("provcity"));
		$cardnumber = str_replace(' ','',trim($request->getParameter("cardnumber")));
		$cardtype = trim($request->getParameter("cardtype"));
		$tel = trim($request->getParameter("tel"));
		$mobile = trim($request->getParameter("mobile"));
		$email = trim($request->getParameter("email"));
		$pid_pass = md5(strtolower($request->getParameter('pid_pass')));
		$pwd1 = md5(strtolower($request->getParameter('pwd1')));
		$pwd2 = md5(strtolower($request->getParameter('pwd2')));
		$squyu = trim($request->getParameter("squyu1"));
		$usertype = trim($request->getParameter("usertype"));
	
        $money=0;
		if($usertype==1)
		{
		    $money=PUKA_MONEY;
		}
		else
		{
		    $money=JINKA_MONEY;
		}
		//判定会员ID是否存在
		$sql = "select user_id from ntb_user where user_id = '$uid'";
		$r = $db->select($sql);
		if($r){
			$request->setError('error',"*会员账号 $uid 已经存在！");
			return $this->getDefaultView();
		}

		$sql = "select user_id from ntb_user_copy where user_id = '$uid'";
		$r = $db->select($sql);
		if($r){
			$request->setError('error',"*会员账号 $uid 已经存在！");
			return $this->getDefaultView();
		}

		//判定会员ID是否存在
		$sql = "select user_id from ntb_user where user_id = '$pid'";
		$r = $db->select($sql);
		if(!$r){
			$request->setError('error',"*推荐账号 $pid 不存在！");
			return $this->getDefaultView();
		}

        //判定会员ID是否存在
		$sql = "select user_id from ntb_user where user_id = '$aid'";
		$r = $db->select($sql);
		if(!$r){
			$request->setError('error',"*安置账号 $aid 不存在！");
			return $this->getDefaultView();
		}


		//查询用户的电子货币  不开启电子货币注册
	//	$sql = "select e_money from ntb_user " .
	//		"where user_id = '$userid' and z_money >= '".$money."'";
	//	$r = $db->select($sql);
	//	if(!$r){
	//		$request->setError('error',"*注册货币不足，无法下单！");
	//		return $this->getDefaultView();
	//	}
        
      
		   $sql = "select node_left,node_right from  ntb_board_face where node='$aid' ";
		   $r = $db->select($sql);
		   if($r)
		   {
		   
			   //判断左区
				if($squyu=="1")
				{
					if($r[0]->node_left!="")
					{
					    $request->setError('error',"*安置账号 $aid 左区已注册会员！");
						 return $this->getDefaultView();
					}
				}


				//判断右区
				else if($squyu=="2")
				{
					 if($r[0]->node_right!="")
					{
					     $request->setError('error',"*安置账号 $aid 左右区已注册会员！");
						 return $this->getDefaultView();
					}
				}
		   }
		   else
		   {
		     $request->setError('error',"*安置账号 $aid 不存在！");
			 return $this->getDefaultView();
		   }

		    $sql1 = "select count(id) as num from ntb_user_copy where anzhi = '$aid'";
		    $r1 = $db->select($sql1);
			$sum=0;
			if($r1)
			{
			    $sum=$r1[0]->num;
			    if($sum==1)
				{
				        if($squyu=="1")
				        {
							$request->setError('error',"*安置账号 $aid 左区已注册会员！");
							 return $this->getDefaultView();
						}
				
				}

				
			    if($sum==2)
				{
				         if($squyu=="2")
				        {
							$request->setError('error',"*安置账号 $aid 左左区已注册会员！");
							 return $this->getDefaultView();
						}
				
				}
			}



		//某个表不回滚请做此操作 alter table 表名 type = InnoDB
		//开始注册会员
		$db->begin();

		$rollback = false;
		do{
		
			//ADD END
			//减少报单人电子货币 不开启电子货币注册
			//$sql = "update ntb_user set z_money = z_money - '" . $money . "' " . 
			//	"where user_id = '$userid' and z_money >= '".$money."'";
		//	$r = $db->update($sql);
		//	if($r == -1){ 
		//		$rollback = true;
		//		$serrnum=2;
		//		break;
		//	}
			//插入新会员基本信息
			$sql = "insert into ntb_user_copy(user_id,e_money,add_date," . 
				"user_name,first_pwd,second_pwd,idno,address,mobile,tel,e_mail," . 
				"card_name,provcity,card_type,card_number,z_money,usertype,tuijian,anzhi,quyu,yeji,dianpu,zhucetype) " . 
				"values('$uid','0',CURRENT_TIMESTAMP,'$username','$pwd1','$pwd2'," . 
				"'$idno','$address','$mobile','$tel','$email'," . 
				"'$cardname','$provcity','$cardtype','$cardnumber',0,'$usertype','$pid','$aid','$squyu','$money','$userid',1)";
			$r = $db->insert($sql);
			if($r == -1){ 
				$rollback = true;
				$serrnum=3;
				break;
			}

						//报单记录
		//	$sql = "insert into ntb_record(operation,accepter,amount,type,status," . 
		//		"add_date,replay_date) " . 
		//		"values('$userid','$uid','".$money."','".E_MONEY_BAODAN . 
		//		"','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
		//	$r = $db->insert($sql);
		//	if($r == -1){
		//		$rollback = true;
		//		$serrnum=4;
		//		break;
		//	}


            

			
		} while(false);
		
	
		//业务结束，提交
		if($rollback == true){
			$db->rollback();
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
				"alert('未知原因，注册会员失败".$serrnum."若多次出现此情况，请及时联系管理员！');location.href='index.php?module=RegMember&action=list';" . 
				"</script>";
		} else {
			$db->commit();
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
				"alert('注册会员成功！');" . 
				"location.href='index.php?module=RegMember&action=list';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>