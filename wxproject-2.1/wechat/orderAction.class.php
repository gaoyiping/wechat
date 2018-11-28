<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
class orderAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sql = "select a.* from ntb_user a where a.user_id = '$userid'";
		$r = $db->select($sql);
		$userinfo = $r[0];
		
		$sessionId = session_id();
		
		$sql="select b.typeID from ecs_cart a,ntc_rproducts b where b.id=a.goods_id and a.user_id='$userid' and a.session_id='$sessionId' group by b.typeID";
		$gp = $db->select($sql);
		
		if(!$gp){
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
					"location.href='index.php?module=cart';" .
					"</script>";
			return ;
		}
		
		if(count($gp)>1){
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
					"alert('你的购物车里面同时出现不同类型产品，请清空购物车重新选择同一类型产品订购!');location.href='index.php?module=cart';" .
					"</script>";
			return ;
		}
		
		
		$sql="select sum(goods_price*goods_number) as totalmoney from ecs_cart where user_id='$userid' and session_id='$sessionId'";
		$data = $db->select($sql);
		$totalmoney = $data[0]->totalmoney;
		
		$request->setAttribute('totalmoney',$totalmoney);
		
		$type = $gp[0]->typeID;
		$request->setAttribute('type',$type);
		
		/*
		if($type==1 && $userinfo->z_money<$totalmoney){
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
					"alert('你的积分不足，请及时充值!');location.href='index.php?module=cart';" .
					"</script>";
			return ;
		}
		
		if($type==2 && $userinfo->f_money<$totalmoney){
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
					"alert('你的复消余额不足!');location.href='index.php?module=cart';" .
					"</script>";
			return ;
		}
		*/
		
		$sql = "select  *  from admin_cg_group a  where a.G_ParentID=0";
		$r = $db->select($sql);
		$request->setAttribute('shengs',$r);
			
		$sql = "select  *  from admin_cg_group a  where a.G_ParentID=".$userinfo->sheng;
		$r = $db->select($sql);
		$request->setAttribute('shis',$r);
			
		
		$sql = "select  *  from admin_cg_group a  where a.G_ParentID=".$userinfo->shi;
		$r = $db->select($sql);
		$request->setAttribute('xians',$r);
		$ps = NULL;
		//根据用户所在区域选择不同的配送中心
		/*
		if($userinfo->xian){
			$sql = "select  *  from ntb_ps a  where a.uplevel=1 and bdxy=0 and a.xian=".$userinfo->xian;
			$ps = $db->select($sql);
		}else if($userinfo->shi){
			$sql = "select  *  from ntb_ps a  where a.uplevel=2 and bdxy=0 and a.shi=".$userinfo->shi;
			$ps = $db->select($sql);
		}else if($userinfo->sheng){
			$sql = "select  *  from ntb_ps a  where a.uplevel=3 and bdxy=0 and a.sheng=".$userinfo->sheng;
			$ps = $db->select($sql);
		}
		if($ps){
			$pid = $ps[0]->user_id;
			$sql = "select  *  from ntb_ps a  where a.pid='$pid' and bdxy=1 ";echo $sql;
			$ps = $db->select($sql);print_r($sql);
			$request->setAttribute('ps',$ps);
		}
		*/
		
		if($userinfo->xian){
			$sql = "select  *  from ntb_ps a  where  bdxy=1 and a.xian=".$userinfo->xian;
			$ps = $db->select($sql);
			$request->setAttribute('ps',$ps);
		}
		
		$request->setAttribute('userinfo',$userinfo);
		return View :: INPUT;
	}

	public function execute(){		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$uid = $userid;
		
		$sql = "select a.* from ntb_user a where a.user_id = '$userid'";
		$rr = $db->select($sql);
		$z_money = $rr[0]->z_money;
		$pid = $rr[0]->pid;
		
		if($pid==$userid){
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
					"alert('推荐人不能是自己,无法购买!');location.href='index.php?module=cart';" .
					"</script>";
			return;
		}
		
		$sql = "select * from ntb_user where user_id='$pid'";
		$r = $db->select($sql);
		if(!$r){
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
					"alert('推荐人不存在,无法购买!');location.href='index.php?module=cart';" .
					"</script>";
			return;
		}
		
		$payment = (addslashes(trim($request->getParameter("payment"))));
		$wpy = (addslashes(trim($request->getParameter("wpy"))));
		
		$qianbao = 0;
		if($payment){
			$qianbao = floatval($request->getParameter("qianbao"));
		}
		
		$wxqianbao = 0;
		if($wpy){
			$wxqianbao = floatval($request->getParameter("onlinepay"));
		}
		
		
		$post_name = (addslashes(trim($request->getParameter("email"))));
		$post_tel = (addslashes(trim($request->getParameter("mobile"))));
		$post_address = (addslashes(trim($request->getParameter("address"))));
		
		$sheng = (addslashes(trim($request->getParameter("sheng"))));
		$shi = (addslashes(trim($request->getParameter("shi"))));
		$xian = (addslashes(trim($request->getParameter("xian"))));
		
		$xtype = (addslashes(trim($request->getParameter("xtype"))));
		
		$psd = (addslashes(trim($request->getParameter("psd"))));
		
		
		$ps = null;
		
		//更新
		$sql = "update ntb_user set " .
				"address = '$post_address'," .
				"e_mail = '$post_name'," .
				"sheng = '$sheng'," .
				"shi = '$shi'," .
				"xian = '$xian'," .
				"mobile = '$post_tel' " .
				"where user_id = '$userid'";
		$r = $db->update($sql);
		
		if($xtype==1){
			if($psd!='0'){
				$ps = $psd;
			}
		}
		
		if($xtype==2){
			$xian = 2139;
			$shi = 217;
			$sheng = 19;
			$ps = 'CN000000';
			
		}
		
		if(!isset($ps) || $ps==null){
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
					"alert('该区域没有配送中心，请另选购其他产品!');location.href='index.php?module=cart';" .
					"</script>";
			return;
		}
		
		
		$sessionId = session_id();
		
		$sql="select b.typeID from ecs_cart a,ntc_rproducts b where b.id=a.goods_id and a.user_id='$userid' and a.session_id='$sessionId' group by b.typeID";
		$gp = $db->select($sql);
		$ordertype = $gp[0]->typeID;
		
		$sql="select * from ecs_cart where user_id='$userid' and session_id='$sessionId'";
		$goods_data = $db->selectarray($sql);
		$count = count($goods_data);
		
		$sql="select sum(goods_price*goods_number) as totalmoney from ecs_cart where user_id='$userid' and session_id='$sessionId'";
		$data = $db->select($sql);
		$jiage = $data[0]->totalmoney;
		$pv = $jiage;
		
		if(($qianbao+$wxqianbao)<$jiage){
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
					"alert('余额不足，无法购买!');location.href='index.php?module=cart';" .
					"</script>";
			return;
		}
		
		if($wxqianbao==0){
			if($z_money<$jiage){
				header('Content-Type: text/html;charset=utf-8');
				echo "<script type='text/javascript'>" .
						"alert('余额不足，无法购买!');location.href='index.php?module=cart';" .
						"</script>";
				return;
			}
		}
		
		$dianpu = $ps;
		
		if($qianbao>0 && $wxqianbao==0){
			//开始使用事务 注册会员
			$db->begin();
			$rollback = false;
			
			$error=0;
			//减少报单人电子货币 不开启电子货币注册****************************************************
			$sql = "update ntb_user set pv=pv+$pv,z_money = z_money - $jiage where user_id = '$userid' and z_money >= '".$jiage."'";
			$r = $db->update($sql);
			if($r == -1){ $rollback = true;$error=1; }
			
			
			$dingdan= "DD".date("ymdhis").rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
			
			
			$type=1;
			//生成订单信息*******************************************************************************
			$sql_2 = "insert into ntc_rorder(" .
					"user_id, post_name, post_tel, post_address, " .
					"way, counts, moneys, emoneys, status, add_date,stype,sNo,dianpu,type,sheng,shi,xian) values(" .
					"'".$userid."','$post_name','$post_tel','$post_address',1,".$count.",".$jiage.",".$pv.",'0', CURRENT_TIMESTAMP,'0','$dingdan','$dianpu',$type,'$sheng','$shi','$xian')";
				
			$r_2 = $db->insert($sql_2, "last_insert_id");
			
			$order_id=$r_2;
			if($r_2 == -1){ $rollback = true; $error=3;}
			
			//生成订单明细表******************************************************************************
			for($k=0;$k<$count;$k++)
			{
				$data = $goods_data[$k];
				$sql="select * from ntc_rproducts where id=".$data['goods_id'];
				$gr = $db->select($sql);
				$rsNo = $gr[0]->sNo;
				$rdanwei = $gr[0]->danwei;
				
				$strsql=" insert into admin_cg_kucun(" .
							"rsNo, rname, pID, typeID, rdate, rnum,rdanwei,rjiage,pubdate,rtype,rleixing,rliushui,user_id,yeji) " .
								"values('$rsNo','".$data['goods_name']."',".$data['goods_id'].",0,CURRENT_TIMESTAMP,".$data['goods_number']."," .
								"'$rdanwei',".$data['goods_price'].",".
									"CURRENT_TIMESTAMP,1,0,'$dingdan','$userid',0) ;";
				$r_3 = $db->insert($strsql);
				if($r_3 == -1){ $rollback = true;break; $error=4;}
			
			}
			
			//财务记录
			$type = E_MONEY_BAODAN;
			
			//取出代数,点数
			$cxbl = array(31.2,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5);
			$tcbl = array(30,30,30,45);
			$psf=20;
			
			$sql="select sum(goods_number) cn from ecs_cart where user_id='$userid' and session_id='$sessionId'";
			$rs = $db->select($sql);
			$count = $rs[0]->cn;
			
			$sql = "select count(*) sam from ntb_record where type=1  and operation='$userid'";
			$rr = $db->select($sql);
			if($rr[0]->sam > 0){
				//重消奖
				//找出所有直推线的上级
				$ppid = $userid;
				$i = 0;
				while($ppid){
				
					$sql="select * from ntb_user where user_id='$ppid'";
					$r = $db->select($sql);
					if(!$r){break;}
					$user = $r[0];
					$uuid = $user->user_id;
					$ppid = $r[0]->pid;
					
					$sql = "select count(*) sam from ntb_record where type=1  and operation='$uuid'";
					$rr = $db->select($sql);
					if($rr[0]->sam == 0){
						continue;
					}
					
					$money = $count*$cxbl[$i];
					
					$sql = "insert into ntb_money_point (userid,money,s_money,isf,type,fromuser) values ('$uuid','$money','$money',1,1,'$userid');";
					$r1 = $db->insert ( $sql );
						
					if($r1 == -1){ $rollback = true;$error=8;}
				
					$i++;
				
					
					$sql2="update ntb_user set  z_money=z_money+$money,e_money=e_money+$money where user_id='$uuid'";
					$r2 = $db->update ( $sql2 );
					if($r2 == -1){ $rollback = true;$error=10;}
					
					
					if($i==22){break;}
				
				}
			
			}else{
				
				//培育奖
				//找出所有直推线的上级
				$sql="select * from ntb_user where user_id='$userid'";
				$r = $db->select($sql);
				$ppid = $r[0]->pid;
				$i = 0;
				while($ppid){
					
					$sql="select * from ntb_user where user_id='$ppid'";
					$r = $db->select($sql);
					if(!$r){break;}
					$user = $r[0];
					$uuid = $user->user_id;
					$ppid = $r[0]->pid;
					
					$sql = "select count(*) sam from ntb_record where type=1  and operation='$uuid'";
					$rr = $db->select($sql);
					if($rr[0]->sam == 0){
						continue;
					}
					
					$money = $count*$tcbl[$i];
					
					$sql = "insert into ntb_money_point (userid,money,s_money,isf,type,fromuser) values ('$uuid','$money','$money',1,0,'$userid');";
					$r1 = $db->insert ( $sql );
						
					if($r1 == -1){ $rollback = true;$error=9;}
					
					$i++;
					
					
					$sql2="update ntb_user set  z_money=z_money+$money,e_money=e_money+$money where user_id='$uuid'";
					$r2 = $db->update ( $sql2 );
					if($r2 == -1){ $rollback = true;$error=10;}
					
					
					if($i==4){break;}
					
				}
			
			}
			
			
			if($xtype!=2){
				$psf=20;
				//报单奖
				if($dianpu){
					//根据配送点找出配送中心
					$sql = "select * from  ntb_ps where user_id='$dianpu'";
					$rrs = $db->select($sql);
					if($rrs){
						$dianpu = $rrs[0]->pid;
						if($dianpu){
							$money = $count*$psf;
							$sql = "insert into ntb_money_point_ps (userid,money,s_money,isf,type,fromuser) values ('$dianpu','$money','$money',0,2,'$userid');";
							$r1 = $db->insert ( $sql );
							if($r1 == -1){ $rollback = true;$error=11;}
						}
					}
				}
				
				//算出管理奖,推荐奖，先判断该配送中心在哪个地方
				/*
				$sql="select * from ntb_ps where user_id='$ps' and bdxy=0";
				$rr = $db->select($sql);
				$sheng = $rr[0]->sheng;
				$shi = $rr[0]->shi;
				$xian = $rr[0]->xian;
				$pid = $rr[0]->pid;
				
				if($pid){
					$money = $jiage*0.01;
						
					$sql = "insert into ntb_money_point_ps (userid,money,s_money,isf,type,fromuser) values ('$pid','$money','$money',0,3,'$userid');";
					$r = $db->insert ( $sql );
					if($r == -1){ $rollback = true;$error=11;}
						
				}
				*/
				
				$money = $jiage*0.01;
				$sql = "select  *  from ntb_ps a  where a.uplevel=3 and a.sheng=$sheng and bdxy=0";
				$shengs = $db->select($sql);
				
				for($i=0;$i<count($shengs);$i++){
					$dianpu = $shengs[$i]->user_id;
					$sql = "insert into ntb_money_point_ps (userid,money,s_money,isf,type,fromuser) values ('$dianpu','$money','$money',0,4,'$userid');";
					$r = $db->insert ( $sql );
					if($r == -1){ $rollback = true;$error=13;}
						
				}
				
				
				$money = $jiage*0.015;
				$sql = "select  *  from ntb_ps a  where a.uplevel=2 and a.shi=$shi and bdxy=0";
				$shis = $db->select($sql);
				
				for($i=0;$i<count($shis);$i++){
					$dianpu = $shis[$i]->user_id;
					$sql = "insert into ntb_money_point_ps (userid,money,s_money,isf,type,fromuser) values ('$dianpu','$money','$money',0,4,'$userid');";
					$r = $db->insert ( $sql );
					if($r == -1){ $rollback = true;$error=15;}
						
				}
				
				
				$money = $jiage*0.02;
				$sql = "select  *  from ntb_ps a  where a.uplevel=1 and a.xian=$xian and bdxy=0";
				$xians = $db->select($sql);
				
				for($i=0;$i<count($xians);$i++){
					$dianpu = $xians[$i]->user_id;
					$sql = "insert into ntb_money_point_ps (userid,money,s_money,isf,type,fromuser) values ('$dianpu','$money','$money',0,4,'$userid');";
					$r = $db->insert ( $sql );
					if($r == -1){ $rollback = true;$error=17;}
						
				}
				
			}
			
			$sql = "insert into ntb_record (operation,amount,type,status,add_date,mtype) values ('$userid','-$jiage','$type',1,CURRENT_TIMESTAMP,1)";
			$r = $db->insert($sql);
			if($r == -1){ $rollback = true;$error=5;}
				
				
			//业务结束，提交
			if($rollback == true){
				$db->rollback();
				
				header('Content-Type: text/html;charset=utf-8');
				echo "<script type='text/javascript'>" .
						"alert('未知原因,消费失败,若多次出现此情况，请及时联系管理员！$error ');location.href='index.php?module=cart';" .
						"</script>";
				
			} else {
				//消除购物车
				$sql = "delete from  ecs_cart where user_id='$userid' and session_id='$sessionId' ";
				$db->update($sql);
				
				$db->commit();
				header('Content-Type: text/html;charset=utf-8');
				echo "<script type='text/javascript'>" .
						"alert('消费成功！');" .
						"location.href='index.php?module=index';</script>";
				return;
			}
		}else{
			
			$dingdan= "DD".date("ymdhis").rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
				
			$type=1;
			
			//生成订单信息*******************************************************************************
			$sql_2 = "insert into ntc_rorder_temp(" .
					"user_id, post_name, post_tel, post_address, " .
					"way, counts, moneys, emoneys, status, add_date,stype,sNo,dianpu,type,sheng,shi,xian,qianbao,wxqianbao,session_id) values(" .
					"'".$userid."','$post_name','$post_tel','$post_address',1,".$count.",".$jiage.",".$pv.",'0', CURRENT_TIMESTAMP,'0','$dingdan','$dianpu',$type,'$sheng','$shi','$xian',$qianbao,$wxqianbao,'$sessionId')";
			
			$r_2 = $db->insert($sql_2, "last_insert_id");
			
			if($r_2 < 0 ){ 
				header('Content-Type: text/html;charset=utf-8');
				echo "<script type='text/javascript'>" .
						"alert('购买信息不正确，请重新下单！');" .
						"location.href='index.php?module=cart';</script>";
						
				return;
				
			}
			
			header("Location:/wechat/js_api_call.php?dingdan=$dingdan&wxqianbao=$wxqianbao");
			
		}
		
		return;
		
		
	}
	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>