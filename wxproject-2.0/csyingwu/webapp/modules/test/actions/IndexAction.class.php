<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$request->setAttribute('c',$request->getParameter('c'));
$db = DBAction::getInstance();
                  
		

		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
	    $num = strtolower($request->getParameter('num'));
		 $type = strtolower($request->getParameter('type'));

	   
		 for($i=0;$i<$num;$i++)
		 {
            //查询最老的未安置的会员

		  
		        $tuijian="";
		  
			   if($type==1)
			   {
				     $sql1="select a.id,a.user_id from ntb_user a left join ntb_board_face b on a.user_id=b.node "
					."where b.node_left='' or  b.node_center='' or b.node_right='' order by a.id limit 1";
					 $r1 = $db->select($sql1);
					  if($r1)
		             {
							 $tuijian= $r1[0]->user_id;
					 }
			   }
			   else
			   {
				    $sql1="select a.id,a.user_id from ntb_user a left join ntb_board_face b on a.user_id=b.node "
					."where b.node_left='' or  b.node_center='' or b.node_right='' order by a.id";
					 $r1 = $db->select($sql1);
					  if($r1)
		             {
						 $suiji= rand(0,count($r1)-1);
						 $tuijian= $r1[$suiji]->user_id;
					 }
			   }
			  
		 

		   //获得最新会员编号
		   /*
		   $sql="select a.id,a.user_id from ntb_user a order by a.id desc limit 1";
		   $r = $db->select($sql);
		   $uid="";
		   if($r)
		   {
			  $uid= str_replace('h','',$r[0]->user_id)+1;
			  
		   }
		   $newuid='h'.$uid;
		   */
		   $newuid =$this->Get_username(10);
		   
       
			//输出最新未安置会员 和 最新加入会员
			// echo $tuijian." && ".$newuid;
		
			 //会员类型 
			 $type= rand(1,4);
			 $pv=0;
			 if($type==1)
			 {
			   $pv=100;
			 }
			 else if($type==2)
			 {
			   $pv=400;
			 }
			 else if($type==3)
			 {
			   $pv=1200;
			 }
			 else
			{
			  $pv=2400;
			 }


			 //插入测试数据
	        $this->Get_test($tuijian,$newuid,$type,$pv);
		}
      
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}


	public function Get_test($tuijian,$userid,$type,$pv)
	{
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		$pid = $tuijian;
		$aid = $tuijian;
		$uid = $userid;
		$username ="注单员";
		$idno = "430229198504551810";
		$address = "湖南省株洲市醴陵市楼拍街5号";
		$cardname = "李丽江";
		$provcity =  "湖南株洲";
		$cardnumber = "5229610025003100";
		$cardtype ="农业银行";
		$tel = "15585215211";
		$mobile ="40002523255";
		$email = "392874987@qq.com";

		
		$pwd1 = "670b14728ad9902aecba32e22fa4f6bd";
		$pwd2 ="670b14728ad9902aecba32e22fa4f6bd";
		$squyu = 1;
		$usertype = $type;
		$money = $pv;
		$userid = "100001";
		$zhucetype = 2;
		$dailishang="100001";

           //判断可安置的位置
		   $sql = "select node_left,node_center,node_right from  ntb_board_face where node='$tuijian' ";
		   $r = $db->select($sql);
		
		   if($r)
		   {

					if($r[0]->node_left=="" && $r[0]->node_left==null)
					{
					    $squyu=1;
					}
					else if($r[0]->node_center=="" && $r[0]->node_center==null)
					{
					       $squyu=2;
					}
					else if($r[0]->node_right=="" && $r[0]->node_right==null)
					{
					       $squyu=3;
					}
					else
			        {
					}
				
		   }
		   else
		   {
		     
		   }
	   
		$db->begin();

		$rollback = false;
		do{
		
		//报单入库 加锁，同步**********************************************************************
			//ADD BY SKS AT 2010-11-16
			$sql_lock = "update ntb_system set value = value + 1 where name = 'LOCK'";
			$r = $db->update($sql_lock);
			if($r == -1){ $rollback = true;$serrnum=1; break; }
            
			


			//插入新会员基本信息***********************************************************************
			$sql = "insert into ntb_user(user_id,e_money,add_date," . 
				"user_name,first_pwd,second_pwd,idno,address,mobile,tel,e_mail," . 
				"card_name,provcity,card_type,card_number,z_money,usertype,dianpu,zhucetype,yeji,pv,smoney) " . 
				"values('$uid','0',CURRENT_TIMESTAMP,'$username','$pwd1','$pwd2'," . 
				"'$idno','$address','$mobile','$tel','$email'," . 
				"'$cardname','$provcity','$cardtype','$cardnumber',0,'$usertype','$userid','2','$pv',0,'".($pv*8)."')";
			$r = $db->insert($sql);
			if($r == -1){ $rollback = true;$serrnum=3; break; }

			
		

		   	//添加店补奖金********************************************************************************
			/*
			$sql = "select userid from ntb_tuijianjiang_copy where userid = '$userid'";
			$r = $db->select($sql);
			if($r)
			{
						$sql = "update ntb_tuijianjiang_copy set emoney = emoney + " . ($pv*8) . " where userid = '$userid' ";
						$r = $db->update($sql);
						if($r == -1){ $rollback = true;$serrnum=6; break; }
			}
			else
			{
						$sql = "insert into ntb_tuijianjiang_copy(userid,emoney) values('$userid',".($pv*8).") ";
						$r = $db->insert($sql);
						if($r == -1){ $rollback = true;$serrnum=6; break; }
			}
			*/


			//更安置树形结点关系 *** MyISAM type************************************************************
			$sql = "select rt,lt,level from ntb_anzhi where node = '$aid'";
			$r = $db->select($sql);
			$rt="";
			$lt="";
			if($r)
			{
				$rt = $r[0]->rt;
				$lt = $r[0]->lt;
				$level=$r[0]->level;
				$sql_u_1 = "update ntb_anzhi set lt = lt + 2 where lt>='$rt'";
				$sql_u_2 = "update ntb_anzhi set rt = rt + 2 where rt>='$rt'";
				$sql_u_3 = "insert into ntb_anzhi(node,p_node,lt,rt,level) " . 
					"values('$uid','$aid','".$rt."','".($rt+1)."','".($level+1)."')";
				if( $db->update($sql_u_1) < 0 || $db->update($sql_u_2) < 1 || $db->insert($sql_u_3) < 1 )
				{
						$rollback = true;$serrnum=7; break;
				}
			     $sql_2 = " select a.node,b.node_left,b.node_center,b.node_right from ntb_anzhi a left join ntb_board_face b on "
			     ." a.node=b.node where a.lt <= '$lt' and a.rt >= '$rt' order by a.rt ";
                
				 $r1 = $db->select($sql_2);

				    if($r1)
				    {
					   $left_str="";
					   $center_str="";
					   $right_str="";
					   for($i=0;$i<count($r1);$i++)
					   {
						    if($i==0)
						    {
							   	if($squyu==1)
								{
								   $left_str=$left_str."'".$r1[$i]->node."',";
								}
								else if($squyu==2)
								{
								   $center_str=$center_str."'".$r1[$i]->node."',";
								}
								else if($squyu==3)
								{
								    $right_str=$right_str."'".$r1[$i]->node."',";
								}
								else
						        {
								    $rollback = true;$serrnum=100; break;
								}
							}
							else
						    {
							    if($r1[$i]->node_left==$r1[$i-1]->node)
								{
								    $left_str=$left_str."'".$r1[$i]->node."',";
								}
								else if($r1[$i]->node_center==$r1[$i-1]->node)
								{
								    $center_str=$center_str."'".$r1[$i]->node."',";
								}

								else if($r1[$i]->node_right==$r1[$i-1]->node)
								{
								     $right_str=$right_str."'".$r1[$i]->node."',";
								}
								else
								{
								     $rollback = true;$serrnum=100; break;
								}
							}

					
							
					   }
					 
					   if($left_str!="")
					   {
					      //批量更新左侧区域业绩
						  $sql_u_1="update ntb_duipeng set left_money=left_money+".$pv.",pv=pv+".$pv." where userid in($left_str'') ";
						 
						  $r = $db->update($sql_u_1);
						  if($r == -1){ $rollback = true;$serrnum=8; break; }
					   }

					   if($center_str!="")
					   {
					      //批量更新中区域业绩
						  $sql_u_1="update ntb_duipeng set center_money=center_money+".$pv.",pv=pv+".$pv." where userid in($center_str'') ";
						 
						  $r = $db->update($sql_u_1);
						  if($r == -1){ $rollback = true;$serrnum=9; break; }
					   }

					   if($right_str!="")
					   {
						   
					      //批量更新左侧区域业绩
						  $sql_u_1="update ntb_duipeng set right_money=right_money+".$pv.",pv=pv+".$pv." where userid in($right_str'') ";
						  $r = $db->update($sql_u_1);
						  if($r == -1){ $rollback = true;$serrnum=10; break; }
					   }
					}
					else
				    {
					   $rollback = true;$serrnum=11; break;
					}
			 }
			else 
			{
				$rollback = true;$serrnum=12; break;
		    }

			//更推荐结点关系 *** MyISAM type********************************************************************
			$sql = "select rt,level from ntb_user_ref where node = '$pid'";
			$r = $db->select($sql);
			if($r){
				$rt = $r[0]->rt;
                $level=$r[0]->level+1;
				$sql_p_1 = "update ntb_user_ref set lt = lt + 2 where lt>='$rt'";
				$sql_p_2 = "update ntb_user_ref set rt = rt + 2 where rt>='$rt'";
				$sql_p_3 = "insert into ntb_user_ref(node,p_node,lt,rt,ref_date,level) " . 
					"values('$uid','$pid','".$rt."','".($rt+1)."',CURRENT_TIMESTAMP,'$level')";
				if( $db->update($sql_p_1) < 0 || $db->update($sql_p_2) < 1 || $db->insert($sql_p_3) < 1 )
				{
					 $rollback = true;$serrnum=13; break;
				}
			} else {
				 $rollback = true;$serrnum=14; break;
			}

			//添加网络图***********************************************************************
			$sql = "insert into ntb_board_face(node,in_date) " . 
				"values('$uid',CURRENT_TIMESTAMP)";
			$r = $db->insert($sql);
			if($r == -1){ $rollback = true;$serrnum=15; break; }
            if($squyu=="1")
			{
				//修改网络图
				$sql = "update  ntb_board_face set node_left='$uid' " . 
					" where node='$aid'";
				$r = $db->update($sql);
				 if($r == -1){ $rollback = true;$serrnum=16; break; }
			}
			else if($squyu=="2")
			{
			   //修改网络图
				$sql = "update  ntb_board_face set node_center='$uid' " . 
					" where  node='$aid'";
				$r = $db->update($sql);
				 if($r == -1){ $rollback = true;$serrnum=17; break; }
			}
			else if($squyu=="3")
			{
			   //修改网络图
				$sql = "update  ntb_board_face set node_right='$uid' " . 
					" where  node='$aid'";
				$r = $db->update($sql);
				 if($r == -1){ $rollback = true;$serrnum=17; break; }
			}
			else
			{
			     if($r == -1){ $rollback = true;$serrnum=18; break; }
			}

			//更新业绩**************************************************************************
			$sql = "insert into ntb_duipeng(userid,left_money,center_money,right_money,pv) " . 
				" values('$uid',0,0,0,'$pv')";
			$r = $db->insert($sql);
			if($r == -1){ $rollback = true;$serrnum=19; break; }
          
		   
            $sql_uplevel="select a.node,b.node_left,b.node_center,b.node_right,(select uplevel from ntb_user c where c.user_id=a.node) as uplevel,"
			."(select pv from ntb_duipeng d where d.userid=a.node) as pv from ntb_anzhi a left join "
			." ntb_board_face b on a.node=b.node where a.lt <= '$lt' and a.rt >= '$rt' order by a.rt" ;
			$r_uplevel = $db->select($sql_uplevel);
			if($r_uplevel)
			{
				$user_str="";
			    foreach($r_uplevel as $list)
				{
				   $node= $list->node;
				   $pv= $list->pv;
				   $uplevel= $list->uplevel;
			       $node_left= $list->node_left;
				   $node_center= $list->node_center;
				   $node_right= $list->node_right;

				   $left_num1=0;
				   $left_num2=0;
				   $left_num3=0;
				   $left_num4=0;
				   $left_num5=0;
				   $left_num6=0;
				   $left_num7=0;
				   $left_num8=0;
				   $left_num9=0;
				   $left_num10=0;

				   $center_num1=0;
				   $center_num2=0;
				   $center_num3=0;
				   $center_num4=0;
				   $center_num5=0;
				   $center_num6=0;
				   $center_num7=0;
				   $center_num8=0;
				   $center_num9=0;
				   $center_num10=0;

				   $right_num1=0;
				   $right_num2=0;
				   $right_num3=0;
				   $right_num4=0;
				   $right_num5=0;
				   $right_num6=0;
				   $right_num7=0;
				   $right_num8=0;
				   $right_num9=0;
				   $right_num10=0;
				   
					  
                  
				  	if($node_left!="")
				   {
				      $sql="select lt,rt from ntb_anzhi where node='$node_left'";
					  $r= $db->select($sql);
					  
					  $sql2=$this->Get_level($r[0]->lt,$r[0]->rt);
					 
					 
					  $r= $db->select($sql2);
                      if($r)
					   {
							  foreach($r as $list)
							  {
								  if($list->uplevel==1)
								  {
									 $left_num1=$list->num;
								  }
								  else if($list->uplevel==2)
								  {
									 $left_num2=$list->num;
								  }
								  else if($list->uplevel==3)
								  {
									 $left_num3=$list->num;
								  }
								  else if($list->uplevel==4)
								  {
									 $left_num4=$list->num;
								  }
								  else if($list->uplevel==5)
								  {
									 $left_num5=$list->num;
								  }
								  else if($list->uplevel==6)
								  {
									 $left_num6=$list->num;
								  }
								  else if($list->uplevel==7)
								  {
									 $left_num7=$list->num;
								  }
								  else if($list->uplevel==8)
								  {
									 $left_num8=$list->num;
								  }
								  else if($list->uplevel==9)
								  {
									 $left_num9=$list->num;
								  }
								   else if($list->uplevel==10)
								  {
									 $left_num10=$list->num;
								  }
								  else
								  {
								  
								  }
							  }
					   }

                      
				   }

				   if($node_center!="")
				   {
				      $sql="select lt,rt from ntb_anzhi where node='$node_center'";
					  $r= $db->select($sql);
					  
					  $sql2=$this->Get_level($r[0]->lt,$r[0]->rt);
					  $r= $db->select($sql2);
                      if($r)
					   {
							  foreach($r as $list)
							  {
								  if($list->uplevel==1)
								  {
									 $center_num1=$list->num;
								  }
								  else if($list->uplevel==2)
								  {
									 $center_num2=$list->num;
								  }
								  else if($list->uplevel==3)
								  {
									 $center_num3=$list->num;
								  }
								  else if($list->uplevel==4)
								  {
									 $center_num4=$list->num;
								  }
								  else if($list->uplevel==5)
								  {
									 $center_num5=$list->num;
								  }
								  else if($list->uplevel==6)
								  {
									 $center_num6=$list->num;
								  }
								  else if($list->uplevel==7)
								  {
									 $center_num7=$list->num;
								  }
								  else if($list->uplevel==8)
								  {
									 $center_num8=$list->num;
								  }
								  else if($list->uplevel==9)
								  {
									 $center_num9=$list->num;
								  }
								   else if($list->uplevel==10)
								  {
									 $center_num10=$list->num;
								  }
								  else
								  {
								  
								  }
							  }
					   }

				   }

				   if($node_right!="")
				   {
				      $sql="select lt,rt from ntb_anzhi where node='$node_right'";
					  $r= $db->select($sql);
					  
					  $sql2=$this->Get_level($r[0]->lt,$r[0]->rt);
					   
					  $r= $db->select($sql2);
                      if($r)
					   {
							  foreach($r as $list)
							  {
								  if($list->uplevel==1)
								  {
									 $right_num1=$list->num;
								  }
								  else if($list->uplevel==2)
								  {
									 $right_num2=$list->num;
								  }
								  else if($list->uplevel==3)
								  {
									 $right_num3=$list->num;
								  }
								  else if($list->uplevel==4)
								  {
									 $right_num4=$list->num;
								  }
								  else if($list->uplevel==5)
								  {
									 $right_num5=$list->num;
								  }
								  else if($list->uplevel==6)
								  {
									 $right_num6=$list->num;
								  }
								  else if($list->uplevel==7)
								  {
									 $right_num7=$list->num;
								  }
								  else if($list->uplevel==8)
								  {
									 $right_num8=$list->num;
								  }
								  else if($list->uplevel==9)
								  {
									 $right_num9=$list->num;
								  }
								   else if($list->uplevel==10)
								  {
									 $right_num10=$list->num;
								  }
								  else
								  {
								  
								  }
							  }
					   }

				   }
                   
                   $level=0;
				   if($left_num10>=1 && $center_num10>=1 && $right_num10>=1)
				   {
				      $level=12;
				   }
				   else  if($left_num9>=1 && $center_num9>=1 && $right_num9>=1)
				   {
				      $level=11;
				   }
				   else  if($left_num8>=1 && $center_num8>=1 && $right_num8>=1 && $pv>=45000000)
				   {
				      $level=10;
				   }
				   else  if($left_num7>=1 && $center_num7>=1 && $right_num7>=1 && $pv>=15000000)
				   {
				      $level=9;
				   }
				   else  if($left_num6>=1 && $center_num6>=1 && $right_num6>=1 && $pv>=5400000)
				   {
				      $level=8;
				   }
				   else  if($left_num5>=1 && $center_num5>=1 && $right_num5>=1 && $pv>=1800000)
				   {
				      $level=7;
				   }
				   else  if($left_num4>=1 && $center_num4>=1 && $right_num4>=1 && $pv>=600000)
				   {
				      $level=6;
				   }
				   else  if($left_num3 >=2 && $center_num3>=2 && $pv>=288000)
				   {
				      $level=5;
				   }
				   else  if($left_num3 >=2 && $right_num3>=2  && $pv>=288000)
				   {
				      $level=5;
				   }
				   else  if($center_num3 >=2 && $right_num3>=2 && $pv>=288000)
				   {
				      $level=5;
				   }
				   else if($left_num3>=1 && $center_num3>=1 && $pv>=96000)
				   {
				      $level=4;
				   }
				   else if($left_num2>=1 && $center_num2>=1 && $pv>=19200)
				   {
				      $level=3;
				   }
				   else if($left_num1>=1 && $center_num1>=1 && $pv>=4800)
				   {
				      $level=2;
				   }
				   else if($pv>=2400)
				   {
				      $level=1;
				   }
				   else
				   {
				     $level=0;
				   }
				 
				  
                   //echo $node." ".$level." ".$pv." ".$left_num1." ".$center_num1."<br />";
				   if($level>$uplevel)
				   {
					   $user_str.="'".$node."',";
				       
						
				   }
			    }
				 $sql4 = "update ntb_user set uplevel = uplevel+1 where user_id in ($user_str'')";
				 
					    $r = $db->update($sql4);
						if($r == -1){ $rollback = true;$serrnum=19; break; }
				
			}
			else
			{
			   $rollback = true;$serrnum=19; break; 
			}
			
			
			
			
		

            

			
		} while(false);
		
	
		//业务结束，提交
		if($rollback == true){
			$db->rollback();
		    echo  $serrnum;
		} else {
		
			$db->commit();
			
		}
	}
     
	//8位获取随机用户名
     function Get_username($leng)
	 {
	    $returnStr='';
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
		for($i = 0; $i < $leng; $i ++) {
			$returnStr .= $pattern {mt_rand ( 0, 35 )}; //生成php随机数
		}
	    return $returnStr;

	 }

	//获得从主任 到七星董事 num1 - num10
	 function Get_level($lt,$rt)
	{
	  return "select b.uplevel,count(b.id) as num from ntb_anzhi  a left join ntb_user b on a.node=b.user_id where a.lt >= '$lt' and a.rt<= '$rt'"
	 ." and b.uplevel<>0 group by b.uplevel";
	}

}

?>