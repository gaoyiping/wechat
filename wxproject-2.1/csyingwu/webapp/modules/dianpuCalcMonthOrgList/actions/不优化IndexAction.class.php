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

		

		return View :: INPUT;
	}

	public function execute() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$sNo = intval($request->getParameter('sNo'));
	    echo "<div style='padding-top:200px;text-align:center;font-size:12px;'><img src='/new_style/images/loading_circle.gif' /> 正在结算中请稍候...</div>";
		
	    
		//获取所有要参与奖金结算的会员

		//获得发展奖会员
         $sql = "select b.lt,b.rt,a.userid,CASE WHEN a.left_money>right_money THEN a.right_money ELSE a.left_money END as emoney  from ntb_duipeng a left join ntb_user_ref b on a.userid=b.node  where a.left_money<>0 and a.right_money<>0";
		 $r1 = $db->select($sql);   
        
		 if($r1)
		{
		    foreach($r1 as $list)
			{
				
				$t_money=$list->emoney*PV_MONEY*FAZHAN_MONEY;
				$sql5 = "select userid    from ntb_money where sNo='".$sNo."' and userid='".$list->userid."' ";
                $r5 = $db->select($sql5);

                if($r5)
				{
					$sql_u="update ntb_money set f_money=f_money+".$t_money." where sNo='".$sNo."' and userid='".$list->userid."' ";
					$update_u = $db->update($sql_u);  
				}
				else
				{
					$sql="insert into ntb_money (sNo,userid,f_money,add_date) values('$sNo','".$list->userid."','$t_money',CURRENT_TIMESTAMP)";
					$inser = $db->insert($sql);  
				}
				
 
				//获取一代直推培育奖
				  $sql = "select a.node,b.usertype from ntb_user_ref a left join ntb_user b on "
				  ." a.node=b.user_id where a.lt < '".$list->lt."' and a.rt > '".$list->rt."' order by a.rt limit 3" ;
                  $r2 = $db->select($sql);  
				
				  if($r2)
				  {
					    $i=0;
						$p_money=$t_money*PEIYANG_MONEY;
						
				        foreach($r2 as $list1)
						{
							$i=$i+1;
							//判断是否第一代推荐人普卡会员和金卡会员都可得到奖金 

							$sql4 = "select userid    from ntb_money where sNo='".$sNo."' and userid='".$list1->node."' ";
						
							$r4 = $db->select($sql4);
							if($i==1)
							{
								if($r4)
								{
								    $sql_u="update ntb_money set p_money=p_money+".$p_money." where sNo='".$sNo."' and userid='".$list1->node."' ";
									$update_u = $db->update($sql_u);  
								}
								else
								{
									$sql="insert into ntb_money (sNo,userid,p_money,add_date) values('$sNo','".$list1->node."','$p_money',CURRENT_TIMESTAMP)";
									$inser = $db->insert($sql);  
									
									
								}
								
							}
							else
							{
								//判断2、3代推荐人是否是金卡会员
							    if($list1->usertype==2)
								{
									if($r4)
									{
									    $sql_u="update ntb_money set p_money=p_money+".$p_money." where sNo='".$sNo."' and userid='".$list1->node."' ";
									    $update_u = $db->update($sql_u);  
									}
									else
									{
										 $sql="insert into ntb_money (sNo,userid,p_money,add_date) values('$sNo','".$list1->node."','$p_money',CURRENT_TIMESTAMP)";
										 $inser = $db->insert($sql);  
										 	
									}
								}
							}
                                
						}
				  }
			}

			

		}


		//获得推荐奖会员
        $sql = "select userid,emoney  from ntb_tuijianjiang";
		$r = $db->select($sql);   
		if($r)
		{
		    foreach($r as $list)
			{
				$t_money=$list->emoney*PV_MONEY*TUIJIAN_MONEY;

				$sql4 = "select userid    from ntb_money where sNo='".$sNo."' and userid='".$list->userid."' ";
				$r4 = $db->select($sql4);

				if($r4)
				{
					 $sql_u="update ntb_money set t_money=t_money+".$t_money." where sNo='".$sNo."' and userid='".$list->userid."' ";
					 $update_u = $db->update($sql_u);  
				}
				else
				{

					$sql="insert into ntb_money (sNo,userid,t_money,add_date) values('$sNo','".$list->userid."','$t_money',CURRENT_TIMESTAMP)";
					$inser = $db->insert($sql);   
				}
			}
		}

		
		$this->getContext()->getController()->redirect('index.php?module=CalcMonthOrgList');
		return;
	}

	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>