<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		//计算月用户总数
		$sql = "select max(sNo) as sNo,left(add_date,10) as add_date   from ntb_VIPmoney";
		$r = $db->select($sql);
		if($r)
		{
		  $request->setAttribute('info', $r[0]);
		}

		return View :: INPUT;
	}

	public function execute() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$sNo = intval($request->getParameter('sNo'));
	
		//获得vip点点奖会员
         $sql = "select a.*,b.lt,b.rt from ntb_vip a left join ntb_anzhi  b on a.userid=b.node";
		
		 $rs = $db->select($sql);   

		 $userlist="";
         $date_arr=array();
		 if($rs)
		 {
				foreach($rs  as $list)
				{
					
					$userlist.=$list->userid.",";
					
	 
					//获取一代直推培育奖
					  $sql = "select a.node,b.usertype from ntb_anzhi a left join ntb_user b on "
					  ." a.node=b.user_id where a.lt < '".$list->lt."' and a.rt > '".$list->rt."' and b.usertype=5 order by a.rt limit 11" ;
				   	  //echo $list->userid."--".$sql."<br />";
					  $r2 = $db->select($sql);  
					
						  if($r2)
						  {
								$i=0;
									
								foreach($r2 as $list1)
								{
									$i=$i+1;
									
								    //点点奖 
									if($i>0 && $i<6)
									{
								           $date_arr= $this->Get_arr($sNo,$date_arr,$list1->node,1000);
									
									}

									if($i>5)
									{
										
										  $date_arr= $this->Get_arr($sNo,$date_arr,$list1->node,500);
									
									}

								}
						  }
						  //vip直推

									$sqlt="select b.user_id,b.usertype from ntb_user_ref a left join ntb_user b on a.p_node=b.user_id where node='".$list->userid."' "
									." and b.usertype=5 limit 1";
						
									 $r3 = $db->select($sqlt);  
									
									if($r3)
									{
									      $date_arr= $this->Get_arr1($sNo,$date_arr,$r3[0]->user_id,1500);
									}
				}


				$sql="insert into ntb_VIPmoney (sNo,userid,t_money,f_money,s_money) values";
				for($i=0;$i<count($date_arr);$i++)
				{
						 $sNo=     $date_arr[$i]["sNo"];
						 $userid=	 $date_arr[$i]["userid"];
						 //>>判断该会员有没有VIP奖开关
						 $temp_sql = "select * from ntb_user where user_id='$userid'";
						 $r = $db->select ( $temp_sql );
						 if($r[0]->jjkg){
							 $jjkg = unserialize($r[0]->jjkg);
							 $f2 = false;
							 for($i=0;$i<count($jjkg);$i++){
							 	if($jjkg[$i]==2) $f2=true;
							 }
							 if(!$f2) continue;
						 }
						 //<<
						 $t_money=	 $date_arr[$i]["t_money"];
						 $f_money=	 $date_arr[$i]["f_money"];
				
						 $s_money=$t_money+$f_money;

						if($i==count($date_arr)-1)
						{
						  $sql.="('$sNo','$userid','$t_money','$f_money','$s_money');";
						}
						else
						{
						  $sql.="('$sNo','$userid','$t_money','$f_money','$s_money'),";
						}
				}
				
				$inser = $db->insert($sql);  
                     
				$sqld="delete  from ntb_vip";
				$db->delete($sqld);  

		}
        

	    
		$this->getContext()->getController()->redirect('index.php?module=vipjiang');
		return;
	}

	
	function Get_arr($sNo,$date_arr,$userid,$money)
	{
	   $num=0;
	 
	   for($i=0;$i<count($date_arr);$i++)
	   {
		 
	      if($date_arr[$i]["userid"]==$userid)
		  {
             
			  $date_arr[$i]["t_money"]=$date_arr[$i]["t_money"]+$money;
			   
			  $num=1;
		  }
	   }

	   if($num==0)
	   { 
		      $index=count($date_arr);
	          $date_arr[$index]["sNo"]=$sNo;
			  $date_arr[$index]["userid"]=$userid;
			  $date_arr[$index]["t_money"]=$money;
			  $date_arr[$index]["f_money"]=0;
	   }
	   return $date_arr;
	}

	function Get_arr1($sNo,$date_arr,$userid,$money)
	{
	   $num=0;
	 
	   for($i=0;$i<count($date_arr);$i++)
	   {
		 
	      if($date_arr[$i]["userid"]==$userid)
		  {
             
			  $date_arr[$i]["f_money"]=$date_arr[$i]["f_money"]+$money;
			   
			  $num=1;
		  }
	   }

	   if($num==0)
	   { 
		      $index=count($date_arr);
	          $date_arr[$index]["sNo"]=$sNo;
			  $date_arr[$index]["userid"]=$userid;
			  $date_arr[$index]["t_money"]=0;
			  $date_arr[$index]["f_money"]=$money;
	   }
	   return $date_arr;
	}

	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>