<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class deitAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//取得参数
		$sNo = $request->getParameter("sNo");
		
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		//总计
		$sql = "select * from ntc_rorder  where   sNo='$sNo' and status=3";
		$r = $db->select($sql);
	
		if($r)
		{
			
		  $request->setAttribute('pinfo',$r[0]);

		   $sql_user=" select GroupID from ntb_user where user_id='".$r[0]->user_id."' ";
		   $r_user = $db->select($sql_user);
		
           $sql = "select * from admin_cg_kucun  where  rliushui='$sNo'";
		   $r = $db->select($sql);
		   if($r)
		   {
			   $request->setAttribute('num',count($r));
		       $request->setAttribute('list',$r);
		   }
         
		}
		
		
	
		return View :: INPUT;
	}

	

	public function execute(){		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$sNo = $request->getParameter("sNo");
		$userid = $request->getParameter("userid");
		$sex3 = $request->getParameter("sex3");
		$yuanyin = $request->getParameter("yuanyin");
         $emoney = $request->getParameter("emoney");
		  $shengID = $request->getParameter("shengID");
		    $shiID = $request->getParameter("shiID");

		//判断是否同意
		if($sex3=="0")
		{
               $url = $_SESSION['handleretail_url'];
				//检查会员是否有足够的购货款
				$sql = "select user_id,shouci,dsNo,dtype from ntb_user where user_id = '$userid' ";
				$r = $db->select($sql);

			
            
                $rollcode="1";
			    //事务开始
				$db->begin();
				$rollback = false;
				
				do{
						 


						   //赠送的产品从公司库存减除
						   for($k=0;$k<=30;$k++)
						   {
							  if(isset($_POST["txtNum".$k]))
							  {
							
									   if($_POST["txtNum".$k]!="0")
									   {  
										 $strsql=" insert into admin_cg_kucun(" .
										"rsNo, rname, pID, typeID, rdate, rnum,rshangjia,rdanwei,rjiage,pubdate,tiaoma,rtype,rleixing,rliushui,user_id,shoujia) " .
										"values('".$_POST["rsNo".$k]."','".$_POST["rname".$k]."',0,0,CURRENT_TIMESTAMP,".$_POST["txtNum".$k].",''," .
										"'".$_POST["rdanwei".$k]."',0,".
										 "CURRENT_TIMESTAMP,'".$_POST["tiaoma".$k]."',4,0,'$sNo','$userid',0) ;";
											$r_4 = $db->insert($strsql);
											if ($r_4 < 1) { $rollback = true; $rollcode = 2; break; }
									   }

							  }
								   
						   }
                            
							//修改订单状态
							$sql = "update ntc_rorder set status = '0',replay_date = CURRENT_TIMESTAMP " .
								"where sNo = '$sNo'";
							$r = $db -> update($sql);
							if ($r < 1) { $rollback = true; $rollcode = 3; break; }
                              
							
							//增加到财务记录
                            			$sql = "insert into " .
								"ntb_record(accepter,amount,cfnumber,type,status,add_date,replay_date) " .
								"values('$userid','$emoney','$sNo',5"
								.",1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
							$r = $db->insert($sql);
							if ($r < 1) { $rollback = true; $rollcode = 5; break; }



				}while(false);
				//业务结束，提交
				if($rollback == true){
					$db->rollback(); 
				
				 header('Content-Type: text/html;charset=utf-8');
					echo "<script type='text/javascript'>" .
						"alert('提交".$rollcode."失败！');" . 
						"location.href='$url';</script>";
				} else {
					$db->commit();
				
					header('Content-Type: text/html;charset=utf-8');
					echo "<script type='text/javascript'>" .
						"alert('提交成功！');" . 
						"location.href='$url';</script>";
				}
		}
		else
		{
				$url = $_SESSION['handleretail_url'];
				$serrnum="1";
			    //事务开始
				$db->begin();
				$rollback = false;
				do{
					$sql = "insert into user_weitongguo(user_id,post_name,post_tel,post_address,way,"
					." counts,moneys,emoneys,status,add_date,replay_date,stype,sNo) select "
					." user_id,post_name,post_tel,post_address,way,counts,moneys,emoneys,status,add_date,replay_date,stype,sNo "
					."  from  ntc_rorder where sNo='$sNo'" ;
					$r = $db -> insert($sql);
							if($r == -1){ 
							$rollback = true;
							$serrnum=1;
							break;
						}

					$sql="delete from ntc_rorder where sNo='$sNo'";
					 $r = $db -> delete($sql);
                    if($r == -1){ 
							$rollback = true;
							$serrnum=2;
							break;
						}

					$sql="update user_weitongguo set yuanyin='$yuanyin' where sNo='$sNo'";
					$r = $db -> update($sql);
					 if($r == -1){ 
							$rollback = true;
							$serrnum=3;
							break;
						}

					 $sql = "insert into user_weitongguo_list(rsNo,rname,pID,typeID,rdate,"
					." rshangjia,rdanwei,rjiage,pubdate,tiaoma,rtype,rleixing,rbeizhu,rliushui,user_id,shoujia) select "
					." rsNo,rname,pID,typeID,rdate, rshangjia,rdanwei,rjiage,pubdate,tiaoma,rtype,rleixing,rbeizhu,rliushui,user_id,shoujia"
					."  from  admin_cg_kucun where rliushui='$sNo'" ;
			 
					$r = $db -> insert($sql);
					 if($r == -1){ 
							$rollback = true;
							$serrnum=4;
							break;
						}


					 $sql="delete from admin_cg_kucun where rliushui='$sNo'";
					 $r = $db -> delete($sql);
					  if($r == -1){ 
							$rollback = true;
							$serrnum=5;
							break;
						}

					   $sql = "update ntb_user set z_money =z_money+".$emoney." where user_id='$userid' " ;
			
		         	   $r = $db -> update($sql);

				 }while(false);
				//业务结束，提交
				if($rollback == true){
				 header('Content-Type: text/html;charset=utf-8');
					echo "<script type='text/javascript'>" .
						"alert('提交".$serrnum."失败！');" . 
						"location.href='$url';</script>";
				} else {
					$db->commit();
					header('Content-Type: text/html;charset=utf-8');
					echo "<script type='text/javascript'>" .
						"alert('提交成功！');" . 
						"location.href='$url';</script>";
				}
		
		}
		
		return ;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>