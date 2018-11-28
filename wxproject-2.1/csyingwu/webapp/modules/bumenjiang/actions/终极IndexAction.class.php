<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		//计算月用户总数
		$sql = "select max(sNo) as sNo,left(add_date,10) as add_date   from ntb_money";
		$r = $db->select($sql);
		if($r)
		{
		  $request->setAttribute('info', $r[0]);
		}
		
			

			//$inser = $db->insert($sql);  
		  

		return View :: INPUT;
	}

	public function execute() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$sNo = intval($request->getParameter('sNo'));

		//获取所有要参与奖金结算的会员

		//获得组织奖会员
         $sql = "select b.lt,b.rt,a.userid,a.left_money,a.right_money,a.center_money,(select usertype from ntb_user c where c.user_id=a.userid) as usertype"
		  ." from ntb_duipeng a left join ntb_user_ref b on a.userid=b.node  where (left_money<>0 && center_money<>0) or (left_money<>0 && right_money<>0)"
		 ." or (center_money<>0 && right_money<>0)";
		 $rfazhan = $db->select($sql);   

		 $userlist="";
        
		 if($rfazhan)
		{ 
				foreach($rfazhan as $list)
				{
					 $userlist.=$list->userid.",";
					
				}
             
				foreach($rfazhan as $list)
				{
					$lt=$list->lt;
					$rt=$list->rt;
	 
					//获取一代直推培育奖
				    $sql = "select a.node,a.p_node,b.uplevel,a.lt,a.rt from ntb_user_ref a left join ntb_user b on  a.node=b.user_id where a.lt < '$lt' and a.rt > '$rt' order by a.rt " ;
                   
					  $r2 = $db->select($sql);  
					
						  if($r2)
						  {
								for($i=0;$i<count($r2);$i++)
								{
									$uplevel=$r2[$i]->uplevel;
									$node=$r2[$i]->node;
									$v_lt=$r2[$i]->lt;
									$v_rt=$r2[$i]->rt;          
							        
									$limit=0;
									if($i<$uplevel)
									{$limit=$i+1;}
									else
									{$limit=$uplevel;}
									
								   $strsql="select level,GROUP_CONCAT(node) as user_str  from ntb_user_ref  where lt>'$v_lt' and rt<'$v_rt'  "
								   ." group by level  limit ".($i+1)."";
								   
								   $jinsuor = $db->select($strsql);  
								   $jishu=0;
								
								   for($k=0;$k<count($jinsuor);$k++)
								   {
                                        $user_str= $arr=split(",",$jinsuor[$k]->user_str);
									   
									    for($j=0;$j<count($user_str);$j++)
									    {
										    if(strpos($userlist,$user_str[$j].",")!=0)
											{
											   $jishu=$jishu+1;
											   break;
											}											
										}	
								   }
								   $daishu=$i+$jishu;
								   $bu=$i-$jishu;
							      
								   if($uplevel!=0)
									{
									   if($i-$bu<$uplevel){
										   if(strpos($userlist,$node.",")==0)
										   {
										      $userlist=$userlist.$node.",";
										   }
								           //echo "第".$i."层". $node."--拿".$list->userid."领导奖 级别：".$uplevel." 代数".$jishu." <br />";
									   }
									}

								}
							
						  }
				
				}
		}
        
		if($userlist!="")
		{
			
		    $userlist= $this->sub_string($userlist,strlen($userlist)-1);
			$arr=split(",",$userlist); 
			$arr1=array_unique($arr);
            $listss= sort($arr1);
		    
			$sql="insert into ntb_money (sNo,userid,add_date) values";
			for($i=0;$i<count($arr1);$i++)
			{
				if($i==count($arr1)-1)
				{
			      $sql.="('$sNo','".$arr1[$i]."',CURRENT_TIMESTAMP);";
				}
				else
				{
				  $sql.="('$sNo','".$arr1[$i]."',CURRENT_TIMESTAMP),";
				}
			}
			$inser = $db->insert($sql);  
		}
              $date_arr=array();
 
		     //结算对碰奖及管理奖及互动奖
			 if($rfazhan)
		     {
				$i=0;
				foreach($rfazhan as $list)
				{
					$usertype=$list->usertype;
					$left_moeny=$list->left_money;
					$center_moeny=$list->center_money;
					$right_moeny=$list->right_money;

					$left_jieyu=$list->left_money;
					$center_jieyu=$list->center_money;
					$right_jieyu=$list->right_money;

			    	$fruits = array($left_moeny, $center_moeny, $right_moeny);
                    rsort($fruits);
                    
					$fun=$fruits[2];
					$fun2=0;
					if(($fruits[0]-$fun)>$fruits[1])
					{
					  $fun2= $fruits[1];;
					}
					else
					{
					  $fun2=$fruits[0]-$fun;
					}
					
					//获取左中右大小区
				    if($left_moeny>=$center_moeny && $left_moeny>=$right_moeny)
					{
                       $left_jieyu=$left_jieyu-$fun-$fun2;
					   if($center_moeny>=$right_moeny)
					   {
						   //采用第2大区沉淀法
						  // $center_jieyu=$center_jieyu-$fun2;
						  $center_jieyu=0;
						  $right_jieyu=0;

					   }
					   else
					   {
					      $center_jieyu=0;
						  //$right_jieyu=$right_jieyu-$fun2;
						  $right_jieyu=0;
					   }
					}
					else if($center_moeny>$left_moeny && $center_moeny>$right_moeny)
					{
					   $center_jieyu=$center_jieyu-$fun-$fun2;
					   if($left_moeny>=$right_moeny)
					   {
                          //$left_jieyu=$left_jieyu-$fun2;
						  $left_jieyu=0;
						  $right_jieyu=0;
					   }
					   else
					   {
					      $left_jieyu=0;
						  $right_jieyu=0;
						  //$right_jieyu=$right_jieyu-$fun2;
					   }
					}
					else
					{
					   $right_jieyu=$right_jieyu-$fun-$fun2;
					   if($left_moeny>=$center_moeny)
					   {
                          //$left_jieyu=$left_jieyu-$fun2;
						  $left_jieyu=0;
						  $center_jieyu=0;
					   }
					   else
					   {
					      $left_jieyu=0;
						  $center_jieyu=0;
						 // $center_jieyu=$center_jieyu-$fun2;
					   }
					}
                     
                    $f_money= $this->Get_moeny($fun,$fun2,$usertype);
                    
                    //echo "会员:".$list->userid." le:".$usertype." 左".$fruits[0]." 中".$fruits[1]."右".$fruits[2]." 第一碰:".$fun." 第2碰:".$fun2." 总碰:".$this->Get_moeny($fun,$fun2,$usertype)."<br />";
					//echo "左余".$left_jieyu."中余".$center_jieyu."右余".$right_jieyu." <br />";
					
					
					$sql_u="update ntb_money set f_money=f_money+".$f_money." where sNo='".$sNo."' and userid='".$list->userid."' ";
					//$update_u = $db->update($sql_u);  
					 
					

						//更新对碰表奖金
						$sql_u_1="update ntb_duipeng set left_money=".$this->Get_jieyu($left_jieyu,$usertype).",center_money=".$this->Get_jieyu($center_jieyu,$usertype).", "
						." right_money=".$this->Get_jieyu($right_jieyu,$usertype)." where userid='".$list->userid."' ";
						// $update_u = $db->update($sql_u_1);  

						
						 $date_arr[$i]["sNo"]=$sNo;
						 $date_arr[$i]["userid"]=$list->userid;
						 $date_arr[$i]["t_money"]=0;
						 $date_arr[$i]["f_money"]=$f_money;
						 $date_arr[$i]["p_money"]=0;

						 $i++;
					


                   //*****************************************************领导奖结算****************************************************************

				   	$lt=$list->lt;
					$rt=$list->rt;
	 
					//获取一代直推培育奖
				    $sql = "select a.node,a.p_node,b.uplevel,a.lt,a.rt from ntb_user_ref a left join ntb_user b on  a.node=b.user_id where a.lt < '$lt' and a.rt > '$rt' order by a.rt " ;
                   
					  $r2 = $db->select($sql);  
					
						  if($r2)
						  {
								for($i=0;$i<count($r2);$i++)
								{
									$uplevel=$r2[$i]->uplevel;
									$node=$r2[$i]->node;
									$v_lt=$r2[$i]->lt;
									$v_rt=$r2[$i]->rt;          
							        
									$limit=0;
									if($i<$uplevel)
									{$limit=$i+1;}
									else
									{$limit=$uplevel;}
									
								   $strsql="select level,GROUP_CONCAT(node) as user_str  from ntb_user_ref  where lt>'$v_lt' and rt<'$v_rt'  "
								   ." group by level  limit ".($i+1)."";
								   
								   $jinsuor = $db->select($strsql);  
								   $jishu=0;
								
								   for($k=0;$k<count($jinsuor);$k++)
								   {
                                        $user_str= $arr=split(",",$jinsuor[$k]->user_str);
									   
									    for($j=0;$j<count($user_str);$j++)
									    {
										    if(strpos($userlist,$user_str[$j].",")!=0)
											{
											   $jishu=$jishu+1;
											   break;
											}											
										}	
								   }
								   $daishu=$i+$jishu;
								   $bu=$i-$jishu;
							   
								   if($uplevel!=0)
									{
									   if($i-$bu<$uplevel){
										    $p_moeny=$this->Get_lingdao($f_money,$jishu) ;
								        	$sql_u="update ntb_money set p_money=p_money+".$p_moeny." where sNo='".$sNo."' and userid='".$node."' ";
				                           // $update_u = $db->update($sql_u);  
											//echo "第".$i."层". $node."--拿".$list->userid."领导奖 级别：".$uplevel." 代数".$jishu." <br />";
									   }
									}

								}
							
						  }

						  //**************************************************************领导奖结算结束*****************************************
				   
				 }
              }
         
		 for($i=0;$i<count($date_arr);$i++)
		 {
		            echo     $date_arr[$i]["sNo"]."--";
					echo	 $date_arr[$i]["userid"]."--";
					echo	 $date_arr[$i]["t_money"]."--";
					echo	 $date_arr[$i]["f_money"]."--";
					echo	 $date_arr[$i]["p_money"]."<br />"; 
		 }
		 
         
		//$this->getContext()->getController()->redirect('index.php?module=bumenjiang');
		return;
	}
    

	//获得对碰奖金
	function Get_moeny($fun1, $fun2,$uplevel)
	{
	    $num=$fun1+$fun2;
		$moeny=0;
		if($uplevel==1)
		{
		  $moeny=$num*PUKA_PENGPENG;
		  if($fun1==0)
		  {
		     if($moeny>PUKA_FENG)
			 {
			   $moeny=PUKA_FENG;
			 }
		  }
		  else
		  {
		    if($moeny>PUKA_FENG*2)
			 {
			   $moeny=PUKA_FENG*2;
			 }
		  }

		  
		}
		else if($uplevel==2)
		{
		  $moeny=$num*YINKA_PENGPENG;
		  if($fun1==0)
		  {
		     if($moeny>YINKA_FENG)
			 {
			   $moeny=YINKA_FENG;
			 }
		  }
		  else
		  {
		    if($moeny>YINKA_FENG*2)
			 {
			   $moeny=YINKA_FENG*2;
			 }
		  }
		}
		else if($uplevel==3)
		{
		  $moeny=$num*JINKA_PENGPENG;
		  if($fun1==0)
		  {
		     if($moeny>JINKA_FENG)
			 {
			   $moeny=JINKA_FENG;
			 }
		  }
		  else
		  {
		    if($moeny>JINKA_FENG*2)
			 {
			   $moeny=JINKA_FENG*2;
			 }
		  }
		}
		else if($uplevel==4 || $uplevel==5)
		{
		  $moeny=$num*ZUANKA_PENGPENG;
		  if($fun1==0)
		  {
		     if($moeny>ZUANKA_FENG)
			 {
			   $moeny=ZUANKA_FENG;
			 }
		  }
		  else
		  {
		    if($moeny>ZUANKA_FENG*2)
			 {
			   $moeny=ZUANKA_FENG*2;
			 }
		  }
		}
		else
		{}
		return $moeny;

	}

	//对碰结余
	function Get_jieyu($money,$uplevel)
	{
           $smoney=$money;
			if($uplevel==1)
			{
			    if($smoney>PUKA_JIEYU)
				{
				  $smoney=PUKA_JIEYU;
				}
			}
			else if($uplevel==2)
			{
			 
			  if($smoney>YINKA_JIEYU)
				{
				  $smoney=YINKA_JIEYU;
				}
			}
			else if($uplevel==3)
			{
			  if($smoney>JINKA_JIEYU)
				{
				  $smoney=JINKA_JIEYU;
				}
			}
			else if($uplevel==4 || $uplevel==5)
			{
			    if($smoney>ZUANKA_JIEYU)
				{
				  $smoney=ZUANKA_JIEYU;
				}
			}
			else
			{}
			return $smoney;
	}


	//获得领导奖
	function Get_lingdao($money,$jishu)
	{
		$s_money=0;
	    if($jishu==1)
		{
		    $s_money=$money*U_DAISHU_1;
		}
		else if($jishu==2)
		{
		    $s_money=$money*U_DAISHU_2;
		}
		else if($jishu==3)
		{
		    $s_money=$money*U_DAISHU_3;
		}
		else if($jishu==4)
		{
		    $s_money=$money*U_DAISHU_4;
		}
		else if($jishu==5)
		{
		    $s_money=$money*U_DAISHU_5;
		}
		else if($jishu==6)
		{
		    $s_money=$money*U_DAISHU_6;
		}
		else if($jishu==7)
		{
		    $s_money=$money*U_DAISHU_7;
		}
		else if($jishu==8)
		{
		    $s_money=$money*U_DAISHU_8;
		}
		else if($jishu==9)
		{
		    $s_money=$money*U_DAISHU_9;
		}
		else if($jishu==10)
		{
		    $s_money=$money*U_DAISHU_10;
		}
		else if($jishu==11)
		{
		    $s_money=$money*U_DAISHU_11;
		}
		else
		{}

		return  $s_money;
	}
    

	function Get_arr($sNo,$date_arr,$userid,$money)
	{
	   $num=0;
	   for($i=0;$i<count($date_arr);$i++)
	   {
	      if($date_arr[$i]["userid"]==$userid)
		  {

			  $date_arr[$i]["f_money"]=$money;
			  $num=1;
		  }
	   }

	   if($num==0)
	   { 
		   $index=count($date_arr)+1;
	          $date_arr[$index]["sNo"]=$sNo;
			  $date_arr[$index]["userid"]=$userid;
			  $date_arr[$index]["t_money"]=0;
			  $date_arr[$index]["f_money"]=0;
			  $date_arr[$index]["p_money"]=$money;
	   }
	}
	function sub_string($str, $len)
		
	{
		    $charset="utf-8";
			if( !is_numeric($len) or $len <= 0) {//如果截取长度小于等于
				return "";      //返回空
			}
			$sLen = strlen($str);    //获取原始字串长度
			if( $len >= $sLen ) {   //如果截取长度大于总字符串长度
				return $str;     //直接返回当前字符串
			} 
			if ( strtolower($charset) == "utf-8" ) { //如果编码为为utf-8
				$len_step = 3;      //则中文字符长度为3
			} else {        //如果不是
				$len_step = 2;      //如果是gb2312或big5编码，则中文字符长度为2
			}
			//执行截取操作
			$len_i = 0;   //初始化计数当前已截取的字符串个数，此值为字符串的个数值
			$substr_len = 0; //初始化应该要截取的总字节数
			for( $i=0; $i < $sLen; $i++ ) { //开始循环
				if ( $len_i >= $len ) break; //总截取$len个字符串后，停止循环
				if( ord(substr($str,$i,1)) > 0xa0 ) { //如果是中文字符串
					$i += $len_step - 1;   //
					$substr_len += $len_step;  //当前总字节数加上相应编码的中文字符长度
				} else {        //如果字符不是中文
					$substr_len ++;     //加1个字节
				}
				$len_i ++;     //已经截取字符串个数增加
			}
			$result_str = substr($str,0,$substr_len ); //获取结果
			return $result_str;    //返回结果
    }


	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>