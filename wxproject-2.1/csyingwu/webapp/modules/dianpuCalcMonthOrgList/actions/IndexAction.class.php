<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		//计算月用户总数
		$sql = "select max(sNo) as sNo,left(add_date,10) as add_date   from ntb_money_copy";
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
		
	   

		//获得推荐奖会员
        $sql = "select a.userid,a.emoney,b.btype,b.tuijiansNo  from ntb_tuijianjiang_copy a left join admin_cg_danbao b on a.userid=b.bloginID ";
		$r = $db->select($sql);   
		if($r)
		{
		    foreach($r as $list)
			{
				$t_money=0;
				if($list->btype==1)
				{
			    	$t_money=$list->emoney*PV_MONEY*HDIANBU_MONEY;
				}
				else if($list->btype==2)
				{
			    	$t_money=$list->emoney*PV_MONEY*JDIANBU_MONEY;
				}
				else if($list->btype==3)
				{
				  $t_money=$list->emoney*PV_MONEY*LDIANBU_MONEY;
				}
				else
				{
				  
				}				

				$sql4 = "select userid    from ntb_money_copy where sNo='".$sNo."' and userid='".$list->userid."' ";
				$r4 = $db->select($sql4);

				if($r4)
				{
					 $sql_u="update ntb_money_copy set b_money=b_money+".$t_money." where sNo='".$sNo."' and userid='".$list->userid."' ";
					 $update_u = $db->update($sql_u);  
				}
				else
				{

					$sql="insert into ntb_money_copy (sNo,userid,b_money,add_date) values('$sNo','".$list->userid."','$t_money',CURRENT_TIMESTAMP)";
					$inser = $db->insert($sql);   
				}

				$tt_money=$list->emoney*PV_MONEY*0.02;

				//判断上级推荐人是否是连锁店
				$sql5 = "select bloginID,btype,tuijiansNo    from admin_cg_danbao where  bloginID='".$list->tuijiansNo."' ";
				$r5 = $db->select($sql5);
				if($r5)
				{
				    if($r5[0]->btype==3)
					{
						$sql4 = "select userid    from ntb_money_copy where sNo='".$sNo."' and userid='".$list->tuijiansNo."' ";
						$r4 = $db->select($sql4);

						if($r4)
						{
							 $sql_u="update ntb_money_copy set j_money=j_money+".$tt_money." where sNo='".$sNo."' and userid='".$list->tuijiansNo."' ";
							 $update_u = $db->update($sql_u);  
						}
						else
						{

							$sql="insert into ntb_money_copy (sNo,userid,j_money,add_date) values('$sNo','".$list->tuijiansNo."','$tt_money',CURRENT_TIMESTAMP)";
							$inser = $db->insert($sql);   
						}
					}


						$sql6 = "select bloginID,btype,tuijiansNo    from admin_cg_danbao where  bloginID='".$r5[0]->tuijiansNo."' ";
						$r6 = $db->select($sql6);
						if($r6)
						{
							if($r6[0]->btype==3)
							{
								$sql4 = "select userid    from ntb_money_copy where sNo='".$sNo."' and userid='".$r6[0]->bloginID."' ";
								$r4 = $db->select($sql4);

								if($r4)
								{
									 $sql_u="update ntb_money_copy set j_money=j_money+".$tt_money." where sNo='".$sNo."' and userid='".$r6[0]->bloginID."' ";
									 $update_u = $db->update($sql_u);  
								}
								else
								{

									$sql="insert into ntb_money_copy (sNo,userid,j_money,add_date) values('$sNo','".$r6[0]->bloginID."','$tt_money',CURRENT_TIMESTAMP)";
									$inser = $db->insert($sql);   
								}
							}
						}

				}

			}
		}



		//删除推荐奖会员
        $sql = "delete from  ntb_tuijianjiang_copy";
		$db->delete($sql);   


			//扣重复消费和税
		$sql="select a.*,b.btype from  ntb_money_copy a left join admin_cg_danbao b on a.userid=b.bloginID where a.sNo='".$sNo."' ";
        $r = $db->select($sql);   

		if($r)
		{
		    foreach($r as $list)
			{
				
                 $zongjin=$list->b_money+$list->j_money;

               
				 
				 $updatesql="update ntb_money_copy set y_money=".$zongjin." where id=".$list->id;
                $db->update($updatesql);  
				
              
			}
        }
       
		
		$this->getContext()->getController()->redirect('index.php?module=dianpuCalcMonthOrgList');
		return;
	}

	public function getRequestMethods() {
		return Request :: POST;
	}

}
?>