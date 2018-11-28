<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');


class IndexAction extends Action {
	public function up(){
		$db = DBAction::getInstance();
		//开始使用事务 注册会员
		$db->begin();
		
		$rollback = false;
		do{
			//升级
			//找出每个人的直推数及每个人的团队的人数
			$sql="select * from ntb_user";
			$r = $db->select($sql);
			for($i=0;$i<count($r);$i++){
				$user = $r[$i];
				$user_id = $user->user_id;
				$sql="select * from ntb_user_ref where p_node='$user_id'";
				$tuirow = $db->select($sql);
				
				//直推人数
				$cn = count($tuirow); 
				
				$sql="select * from ntb_anzhi where p_node='$user_id'";
				$anzhirow = $db->select($sql);
				$anzhi = array();
				//然后再算出每个人的安置线的人数
				for($j=0;$j<count($anzhirow);$j++){
					$juser = $anzhirow[$j];
					$juid = $juser->node;
					$sql="select lt,rt from ntb_anzhi where node='$juid'";
					$jrow = $db->select($sql);
					$jlt = $jrow[0]->lt;
					$jrt = $jrow[0]->rt;
					$sql="SELECT count(*) cn FROM `ntb_anzhi` WHERE lt>=$jlt and rt<=$jrt";
					$jrow = $db->select($sql);
					$jcn = $jrow[0]->cn;
					$anzhi[] = $jcn; //安置人数
				}
				
				//当前聘位
				$oldlevel = $user->uplevel;
				if($oldlevel==0 && $cn >= 3){ //升为主管
					$sql="update ntb_user set uplevel=1 where user_id='$user_id'";
					$r = $db->update($sql);
					if($r == -1){ $rollback = true;$serrnum=22; break; }
				}
				
				if($oldlevel==1 && $cn >= 5){ //升为经理
					$needup = 0;
					for($k=0;$k<count($anzhi);$k++){
						if($anzhi[$k]>=50 ){
							$needup++;
						}
					}
					if($needup>=2){
						$sql="update ntb_user set uplevel=2 where user_id='$user_id'";
						$r = $db->update($sql);
						if($r == -1){ $rollback = true;$serrnum=23; break; }
					}
				}
				
				if($oldlevel==2 && $cn >= 7){ //升为总监
					$needup = 0;
					$needup2=0;
					for($k=0;$k<count($anzhi);$k++){
						if($anzhi[$k]>=50 ){
							$needup++;
						}
						if($anzhi[$k]>=100){
							$needup2++;
						}
					}
					if($needup>=2 && $needup2>=1){
						$sql="update ntb_user set uplevel=3 where user_id='$user_id'";
						$r = $db->update($sql);
						if($r == -1){ $rollback = true;$serrnum=24; break; }
					}
				}
				
			}
			
			
			
     	} while(false);
		
	   
		//业务结束，提交
		if($rollback == true){
			$db->rollback();
			
		} else {
			$db->commit();
			
		}

     	return;
		
	}

	public function getDefaultView() {
		
		//$this->up();
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$oppwd = strtolower(addslashes(trim($request->getParameter("location"))));
      
		//获得当前账户余额
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		//用户信息
		$sql = "select user_name, z_money  from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		if($r){
            		
			$request->setAttribute("spusername",$r[0]->user_name);
			$request->setAttribute("spemoney",$r[0]->z_money);
		}

		//绑定商品菜单
        $strMenu="";
	
		//取得商品分类数据
		$sql = "select * from ntc_type where tistrue=0 and ttype=1 order by torder" ;			
		$list = $db->select($sql);
		
		$i = 0;
		$pname="";
		$detail="";
		$cost="";
		$id="";
        $imgURL="";
		$jifen="";
        $imgClass="";
		foreach ($list as $value) {
			
			$i++;
			
			if($i==1){$imgClass="expand";}
			else{$imgClass="collspand";}

		   $strMenu = $strMenu.
		    "<div id=\"divColumnItem_0_".$value->tID."\" class=\"LH20 Width_per100 HideOverflow border_bm border_tp \">".
            "<div style=\"margin-top: 2px; display: inline; margin-left: 15px\" id=\"imgColumnStatus_0_".$value->tID."\"".
            " class=\"".$imgClass."\" onclick=\"ShowColumn.GetChildColumn(this)\"> </div>".
            " <div style=\"margin-top: 2px; margin-left: 2px\" id=\"divColumnDir_1_".$value->tID."\" class=\"collspandImg\"></div>".
            " <div id=\"divColumnTitle_0_".$value->tID."\" class=\"AligntoLeft LH20 dline MT2 ML2\">".
             $value->tname. "</div></div>";

            //取得商品数据
		    $sql1 = "select * from ntc_rproducts where is_del=0 and isdelete=0 and typeID=".$value->tID ;
			$list1 = $db->select($sql1);
            
           
            if($i==1){$strMenu = $strMenu."<div style='' id='ChildContainer_0_".$value->tID."'>";}
			else{$strMenu = $strMenu."<div style='display: none' id='ChildContainer_0_".$value->tID."'>";}

            foreach ($list1 as $value1)
			{
				$pname =$value1->pname;
				$detail =$value1->guige;
				$cost =$value1->zhuanmaijia;
				$id =$value1->id;
				$imgURL =$value1->imgURL;
				$jifen =$value1->jifen;
				$danwei =$value1->danwei;
				$sNo =$value1->sNo;

				$strMenu = $strMenu.
				"<div><div id=\"divColumnItem_".$value->tID."_".$id."\" class=\"LH20 Width_per100 HideOverflow border_bm border_tp \">".
"<div style=\"margin-top: 2px; display: inline; margin-left: 30px\" id=\"imgColumnStatus_".$value->tID."_".$id."\" class=\"expand\"></div><div style=\"display: none\" id=\"divColumnDir_0\"></div>".
"<div id=\"divColumnTitle_".$value->tID."_".$id."\" class=\"AligntoLeft ML2 MT2 dline\" onmouseover=\"ShowColumn.OnmouseOverShowdiv(".$value->tID.",".$id.",'".$imgURL."','".$pname."',".$cost.",'".$detail."',".$jifen.",this)\"".
 "onmouseout=\"ShowColumn.OnmouseHiddiv(".$value->tID.",".$id.",'',this)\">".
"<div class=\"AligntoLeft\"><input id=\"chkboxpro_".$id."\" onclick=\"GetChooseGoods(".$id.",'".$pname."',".$cost.",".$jifen.",'False','".$danwei."','".$sNo."')\"".
" type=\"radio\" name=\"radion\" ></input></div>".
"<div id=\"Div_desc_".$id."\" class=\"AligntoLeft\"> ".$pname."</div>".
"</div><div id=\"litl_".$value->tID."_".$id."\" runat=\"server\"></div></div></div>";
	 
			}
             $strMenu = $strMenu."</div>";
		}		
			
		$request->setAttribute('oppwd', $oppwd);	
		$request->setAttribute('strMenu', $strMenu);

		$request->setAttribute("pid",$request->getParameter("pid"));

		$request->setAttribute("aid",$request->getParameter("aid"));
		$request->setAttribute("uid",$request->getParameter("uid"));
		$request->setAttribute("username",$request->getParameter("username"));
		$request->setAttribute("idno",$request->getParameter("idno"));

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
        $request->setAttribute("error",$request->getParameter("error"));
		
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
		$usertype = 0;
	    
        //得到订单的商品的ID，金额,数量
	   $jishu=0;
       $fornum=200;
	   $strID="0";
	   $pv=0;
	   $strnum="";
	   $jiage=0;
	   $ayy=array();

	   $strsql="";


	   //得要购买的商品ID 和购买数量
       for($i=0;$i<$fornum;$i++)
	   {	       
          if(isset($_POST["txtjiage".$i]))
		   {
			    $jishu++;
				$strID.=$_POST["txtID".$i];				
	            $jiage=$jiage+($_POST["txtjiage".$i]*$_POST["txtNum".$i]);
				$pv=$pv+($_POST["txtjifen".$i]*$_POST["txtNum".$i]);
		   }
		   
	   }

	    if($pv<100)
		{
		    $request->setError('error',"*你下单额累计不足以开通会员卡！");
			return $this->getDefaultView();
		}
		
		if($jiage < 8990){
			$request->setError('error',"*开通会员卡不能少于8990人民币！");
			return $this->getDefaultView();
		}
		
		/* $request->setError('error',"*系统正在维护中。请16:30以后报单！");
		return $this->getDefaultView(); */

		/* if($pv>99){$usertype=1;}
        if($pv>399){$usertype=2;}
        if($pv>1199){$usertype=3;}
		if($pv>2399){$usertype=4;} */
		if($pv>1000){$usertype=1;}
		if($pv>3000){$usertype=2;}
		if($pv>6000){$usertype=3;}
		if($pv>13000){$usertype=4;}


		//查询用户的电子货币
		$sql = "select z_money from ntb_user " .
			"where user_id = '$userid' and z_money >= '".$jiage."'";
		$r = $db->select($sql);
		if(!$r){
			$request->setError('error',"*电子注册货币不足，无法开通会员卡！");
			return $this->getDefaultView();
		}

	    //判定会员ID是否存在
		$sql = "select user_id from ntb_user where user_id = '$uid'";
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
		
		//录入人员所属店铺
		$sql = "select dianpu from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		$ndianpu = 0;
		if($r) $ndianpu = $r[0]->dianpu;
		
        //判断安置位置是否为空
		   $sql = "select node_left,node_center,node_right from  ntb_board_face where node='$aid' ";
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
					 if($r[0]->node_center!="")
					{
					     $request->setError('error',"*安置账号 $aid 中区已注册会员！");
						 return $this->getDefaultView();
					}
				}
				else if($squyu=="3")
				{
					 if($r[0]->node_right!="")
					{
					     $request->setError('error',"*安置账号 $aid 右区已注册会员！");
						 return $this->getDefaultView();
					}
				}else{}

		   }
		   else
		   {
		       $request->setError('error',"*安置账号异常！");
			   return $this->getDefaultView();
		   }
		 

            
		//开始使用事务 注册会员
		$db->begin();

		$rollback = false;
		do{
         
			//报单入库 加锁，同步**********************************************************************
			//ADD BY SKS AT 2010-11-16
			$sql_lock = "update ntb_system set value = value + 1 where name = 'LOCK'";
			$r = $db->update($sql_lock);
			if($r == -1){ $rollback = true;$serrnum=1; break; }
            
			//减少报单人电子货币 不开启电子货币注册****************************************************
			$sql = "update ntb_user set z_money = z_money - '" . $jiage . "' " . 
				"where user_id = '$userid' and z_money >= '".$jiage."'";
			 $r = $db->update($sql);
			 if($r == -1){ $rollback = true;$serrnum=2; break; }


			//插入新会员基本信息***********************************************************************
			$sql = "insert into ntb_user(user_id,e_money,add_date," . 
				"user_name,first_pwd,second_pwd,idno,address,mobile,tel,e_mail," . 
				"card_name,provcity,card_type,card_number,z_money,usertype,dianpu,zhucetype,yeji,pv,smoney) " . 
				"values('$uid','0',CURRENT_TIMESTAMP,'$username','$pwd1','$pwd2'," . 
				"'$idno','$address','$mobile','$tel','$email'," . 
				"'$cardname','$provcity','$cardtype','$cardnumber',0,'$usertype','$ndianpu','2','$pv',0,'$jiage')";
			$r = $db->insert($sql);
			if($r == -1){ $rollback = true;$serrnum=3; break; }

			
			$dingdan= "DD".date("ymdhis").rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
			//生成订单信息*******************************************************************************
			$sql_2 = "insert into ntc_rorder(" .
				"user_id, post_name, post_tel, post_address, " .
				"way, counts, moneys, emoneys, status, add_date,stype,sNo,dianpu,type) values(" .
				"'".$uid."','".$username."','".$tel."','".$address."',1,".$jishu.",".$jiage.",".$pv.",'3', CURRENT_TIMESTAMP,'0','$dingdan','$ndianpu',1)";
			
			$r_2 = $db->insert($sql_2, "last_insert_id");
			$order_id=$r_2;
	        if($r_2 == -1){ $rollback = true;$serrnum=4; break; }


		   //生成订单明细表******************************************************************************
           for($k=0;$k<$fornum;$k++)
	       {
	          if(isset($_POST["txtjiage".$k]))
		      {
					   if($_POST["txtNum".$k]!="0")
					   {  
						 $strsql=" insert into admin_cg_kucun(" .
						"rsNo, rname, pID, typeID, rdate, rnum,rdanwei,rjiage,pubdate,rtype,rleixing,rliushui,user_id,yeji) " .
						"values('".$_POST["txtsNo".$k]."','".$_POST["txtbname".$k]."',".$_POST["txtID".$k].",0,CURRENT_TIMESTAMP,".$_POST["txtNum".$k]."," .
						"'".$_POST["txtdanwei".$k]."',".$_POST["txtjiage".$k].",".
						 "CURRENT_TIMESTAMP,1,0,'$dingdan','$uid',".$_POST["txtpv".$k].") ;";
							$r_3 = $db->insert($strsql);					
							if($r_3 == -1){ $rollback = true;$serrnum=5; break; }
					   }
		      }
		 		   
	       }

		   	//秒发店补奖金********************************************************************************
		   	
			$dianbu=$jiage*0.3;
		    
						$sql = "update admin_cg_danbao set z_money = z_money + " . $dianbu . " where bloginID = '$ndianpu' ";
						$r = $db->update($sql);
						if($r == -1){ $rollback = true;$serrnum=26; break; }
		
						$sql = "insert into ntb_dianbu(bloginID,userid,type,emoney,beizhu) values('$ndianpu','$uid',1,'".$dianbu."','') ";
						$r = $db->insert($sql);
						if($r == -1){ $rollback = true;$serrnum=36; break; }
		    
 
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
			/* $sql = "insert into ntb_duipeng(userid,left_money,center_money,right_money,pv) " . 
				" values('$uid',0,0,0,'$pv')";
			$r = $db->insert($sql);
			if($r == -1){ $rollback = true;$serrnum=19; break; } */
			
			//增加三个复消
			/* $year=date('Y');
			$month = date('m') - 1 ;
			for ($i=0;$i<3;$i++){
				$month ++ ;
				 
				if($month > 12){
					$month = $month - 12;
					$year ++;
				}
				 
				if($month < 10){
					$fuxiaodate = $year .'-0'.$month;
				}else {
					$fuxiaodate = $year .'-'.$month;
				}
				 
				//插入数据
				$insertsql = " insert into ntb_fuxiao values (null,'$uid','$ndianpu',0,'$fuxiaodate',CURRENT_TIMESTAMP)";
				$r = $db->insert($insertsql);
				if($r == -1){ $rollback = true;break; }
				 
			} */
			
			//财务记录
			$type = E_MONEY_BAODAN;
			$sql = "insert into ntb_record (operation,amount,type,status,add_date,mtype) values ('$userid','-$jiage','$type',1,CURRENT_TIMESTAMP,1)";
			$r = $db->insert($sql);
			if($r == -1){ $rollback = true;$serrnum=19; break; }
			
			//秒算幸运奖
			//1、找出推荐人的前10名,每人发120元的幸运奖
			$sql="select user_id from ntb_user as a where id < (select id from ntb_user where user_id='$pid') order by a.id desc limit 0,10";
			$r = $db->select($sql);
			if($r){
				$sql = "insert into ntb_xingyunjiang (userid,pv) values";
				for($i=0;$i<count($r);$i++){
					$userid = $r[$i]->user_id;
					if ($i == count ( $r ) - 1) {
						$sql .= "('$userid','120');";
					} else {
						$sql .= "('$userid','120'),";
					}
				}
				$r = $db->insert ( $sql );
				
				if($r == -1){ $rollback = true;$serrnum=20; break; }
			}
			
			//开拓奖
			//1、找出当前会员的lt、rt
			$sql="select lt,rt from ntb_user_ref where node='$uid'";
			$r = $db->select($sql);
			$lt = $r[0]->lt;
			$rt = $r[0]->rt;
			
			//2、给前10代的会员每人120
			$sql="SELECT * FROM ntb_user_ref WHERE lt<$lt and rt>$rt order by id desc limit 0,10";
			$r = $db->select($sql);
			if($r){
				$sql = "insert into ntb_kaituojiang (userid,pv) values";
				for($i=0;$i<count($r);$i++){
					$userid = $r[$i]->node;
					if ($i == count ( $r ) - 1) {
						$sql .= "('$userid','120');";
					} else {
						$sql .= "('$userid','120'),";
					}
				}
				$r = $db->insert ( $sql );
				if($r == -1){ $rollback = true;$serrnum=21; break; }
			}
			
			
			//领导奖
			//找出所有直推线的上级
			//1、找出当前会员的lt、rt
			$sql="select lt,rt from ntb_user_ref where node='$uid'";
			$r = $db->select($sql);
			$lt = $r[0]->lt;
			$rt = $r[0]->rt;
				
			$sql="SELECT * FROM ntb_user_ref WHERE lt<$lt and rt>$rt order by id desc ";
			$r = $db->select($sql);
			$oldlevel = 0; //上一个给钱的等级
			$oldmoney = 0; //上一个给钱的非同级的钱
			$x=0;
			$y=0;
			$z=0;
			for ($i=0;$i<count($r);$i++){
			
				$money = 0;
			
				//判断当前人的等级
				$tempuser = $r[$i];
				$iddd = $tempuser->node;
				$sql="select uplevel from ntb_user where user_id='$iddd'";
				$rrr = $db->select($sql);
				$level = $rrr[0]->uplevel;
				$uuid = $tempuser->node;
				if($level==1){//如果是主管
					if($oldlevel<$level){ //如果上一个等级小于
						$money = 600-$oldmoney;
						$oldmoney = 600;
					}
					/* if($oldlevel==$level){ //如果是同级
						$money =30;
					} */
					if($x<9 && $i>0){
						$x++;
						$money = $money+30;
					}
					
				}
			
				if($level==2){//如果是经理
					if($oldlevel<$level){ //如果上一个等级小于
						$money = 860-$oldmoney;
						$oldmoney = 860;
					}
						
					/* if($oldlevel==$level){ //如果是同级
						$money =40;
					} */
					if($y<9 && $i>0){
						$y++;
						$money = $money+40;
					}
				}
			
				if($level==3){//如果是总监
					if($oldlevel<$level){ //如果上一个等级小于
						$money = 1200-$oldmoney;
						$oldmoney = 1200;
					}
						
					/* if($oldlevel==$level){ //如果是同级
						$money =50;
					} */
					if($z<9 && $i>0){
						$z++;
						$money = $money+50;
					}
				}
			
				if($money>0){
					$sql = "insert into ntb_jinjijiang (userid,pv) values ('$iddd',$money)";
					$rr = $db->update($sql);
					if($rr == -1){ $rollback = true;$serrnum=25; break; }
					$oldlevel = $level;
				}
			
				
			}
			
			//升级
			//找出每个人的直推数及每个人的团队的人数
			$sql="select * from ntb_user";
			$r = $db->select($sql);
			for($i=0;$i<count($r);$i++){
				$user = $r[$i];
				$user_id = $user->user_id;
				$sql="select * from ntb_user_ref where p_node='$user_id'";
				$tuirow = $db->select($sql);
				
				//直推人数
				$cn = count($tuirow); 
				
				$sql="select * from ntb_anzhi where p_node='$user_id'";
				$anzhirow = $db->select($sql);
				$anzhi = array();
				//然后再算出每个人的安置线的人数
				for($j=0;$j<count($anzhirow);$j++){
					$juser = $anzhirow[$j];
					$juid = $juser->node;
					$sql="select lt,rt from ntb_anzhi where node='$juid'";
					$jrow = $db->select($sql);
					$jlt = $jrow[0]->lt;
					$jrt = $jrow[0]->rt;
					$sql="SELECT count(*) cn FROM `ntb_anzhi` WHERE lt>=$jlt and rt<=$jrt";
					$jrow = $db->select($sql);
					$jcn = $jrow[0]->cn;
					$anzhi[] = $jcn; //安置人数
				}
				
				//当前聘位
				$oldlevel = $user->uplevel;
				if($oldlevel==0 && $cn >= 3){ //升为主管
					$sql="update ntb_user set uplevel=1 where user_id='$user_id'";
					$r = $db->update($sql);
					if($r == -1){ $rollback = true;$serrnum=22; break; }
				}
				
				if($oldlevel==1 && $cn >= 5){ //升为经理
					$needup = 0;
					for($k=0;$k<count($anzhi);$k++){
						if($anzhi[$k]>=50 ){
							$needup++;
						}
					}
					if($needup>=2){
						$sql="update ntb_user set uplevel=2 where user_id='$user_id'";
						$r = $db->update($sql);
						if($r == -1){ $rollback = true;$serrnum=23; break; }
					}
				}
				
				if($oldlevel==2 && $cn >= 7){ //升为总监
					$needup = 0;
					$needup2=0;
					for($k=0;$k<count($anzhi);$k++){
						if($anzhi[$k]>=50 ){
							$needup++;
						}
						if($anzhi[$k]>=100){
							$needup2++;
						}
						
					}
					if($needup>=3 && $needup2>=1 ){
						$sql="update ntb_user set uplevel=3 where user_id='$user_id'";
						$r = $db->update($sql);
						if($r == -1){ $rollback = true;$serrnum=24; break; }
					}
				}
				
			}
			
			
			
     	} while(false);
		
	   
		//业务结束，提交
		if($rollback == true){
			$db->rollback();
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
				"alert('未知原因，注册会员失败".$serrnum."若多次出现此情况，请及时联系管理员！');location.href='index.php?module=showping';" . 
				"</script>";
		} else {
			$db->commit();
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
				"alert('注册消费会员成功！');" . 
				"location.href='index.php?module=showping';</script>";
		}



     	return;

	}


   

	public function getRequestMethods(){
		return Request :: POST;
	}

	
	public function lingdao(){
		$db = DBAction::getInstance();
		
		//秒算幸运奖
		//1、找出推荐人的前10名,每人发120元的幸运奖
		$sql="select user_id from ntb_user as a where id < (select id from ntb_user where user_id='gs10000006') order by a.id desc limit 0,10";
		$r = $db->select($sql);
		if($r){
			$sql = "insert into ntb_xingyunjiang (userid,pv) values";
			for($i=0;$i<count($r);$i++){
				$userid = $r[$i]->user_id;
				if ($i == count ( $r ) - 1) {
					$sql .= "('$userid','120');";
				} else {
					$sql .= "('$userid','120'),";
				}
			}
			$r = $db->insert ( $sql );
		
			if($r == -1){ $rollback = true;$serrnum=20; break; }
		}
		
	}
}

?>