<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');


class IndexAction extends Action {
	
public function getDefaultView() {
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$oppwd = strtolower(addslashes(trim($request->getParameter("location"))));
      
		//获得当前账户余额
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		//用户信息
		$sql = "select user_name, z_money,e_money  from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		if($r){
            		
			$request->setAttribute("spusername",$r[0]->user_name);
			$request->setAttribute("spemoney",$r[0]->z_money);
			$request->setAttribute("emoney",$r[0]->e_money);
		}

		//绑定商品菜单
        $strMenu="";
	
		//取得商品分类数据
		$sql = "select * from ntc_type where tistrue=0 and (ttype=1 or ttype=3) order by torder" ;			
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
				$zhuangxiangshu =$value1->zhuangxiangshu;
				$ocost =$value1->zhuanmaijia;
				$zhekou =$value1->zhekou;
				$cost =($value1->zhuanmaijia)*($zhekou/100);
				$id =$value1->id;
				$imgURL =$value1->imgURL;
				$jifen =($value1->jifen);
				$danwei =$value1->danwei;
				$sNo =$value1->sNo;

				$strMenu = $strMenu.
				"<div><div id=\"divColumnItem_".$value->tID."_".$id."\" class=\"LH20 Width_per100 HideOverflow border_bm border_tp \">".
"<div style=\"margin-top: 2px; display: inline; margin-left: 30px\" id=\"imgColumnStatus_".$value->tID."_".$id."\" class=\"expand\"></div><div style=\"display: none\" id=\"divColumnDir_0\"></div>".
"<div id=\"divColumnTitle_".$value->tID."_".$id."\" class=\"AligntoLeft ML2 MT2 dline\" >".
"<div class=\"AligntoLeft\"><input id=\"chkboxpro_".$id."\" onclick=\"GetChooseGoods(".$id.",'".$pname."',".$cost.",".$jifen.",'False','".$danwei."','".$sNo."')\"".
" type=\"checkbox\" name=\"radion\" ></input></div>".
"<div id=\"Div_desc_".$id."\" class=\"AligntoLeft\"> ".$pname."&nbsp;&nbsp;<a href='javascript:Showopen($id)'>[点击查看详细]</a></div>".
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
		$uid = $userid;
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
 
		$uplevel=0;
		
		//查询用户的电子货币
		$sql = "select z_money from ntb_user " .
			"where user_id = '$userid' and z_money >= '".$jiage."'";
		$r = $db->select($sql);
		if(!$r){
			$request->setError('error',"*电子注册货币不足，无法购买！");
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
			$sql = "update ntb_user set pv=pv+$pv,z_money = z_money - '" . $jiage . "' " . 
				"where user_id = '$userid' and z_money >= '".$jiage."'";
			 $r = $db->update($sql);
			 if($r == -1){ $rollback = true;$serrnum=2; break; }

			
			$dingdan= "DD".date("ymdhis").rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
			//生成订单信息*******************************************************************************
			$sql_2 = "insert into ntc_rorder(" .
				"user_id, post_name, post_tel, post_address, " .
				"way, counts, moneys, emoneys, status, add_date,stype,sNo,dianpu,type) values(" .
				"'".$userid."','','','',1,".$jishu.",".$jiage.",".$pv.",'3', CURRENT_TIMESTAMP,'0','$dingdan','',7)";
			
			$r_2 = $db->insert($sql_2, "last_insert_id");
			$order_id=$r_2;
	        if($r_2 == -1){ $rollback = true;$serrnum=4; break; }


		   //生成订单明细表******************************************************************************
	        $lirun = 0;
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
						 "CURRENT_TIMESTAMP,1,0,'$dingdan','$userid',".$_POST["txtpv".$k].") ;";
							$r_3 = $db->insert($strsql);					
							if($r_3 == -1){ $rollback = true;$serrnum=5; break; }
							
							
					   }
		      } 
	       }

			//财务记录
			$type = E_MONEY_FX;
			$sql = "insert into ntb_record (operation,amount,type,status,add_date,mtype) values ('$userid','-$jiage','$type',1,CURRENT_TIMESTAMP,1)";
			$r = $db->insert($sql);
			if($r == -1){ $rollback = true;$serrnum=19; break; }
			
			/*
			//领导奖
			//找出所有直推线的上级
			//1、找出当前会员的lt、rt
			$sql="select lt,rt from ntb_user_ref where node='$userid'";
			$r = $db->select($sql);
			$lt = $r[0]->lt;
			$rt = $r[0]->rt;
			
			//取出代数,点数
			$sql="select * from ntb_const where id=1";
			$r = $db->select($sql);
			$ds=0;
			$tcbl = array();
			if($r){
				$ds=$r[0]->ds;
				$tcbl = explode(",",$r[0]->tcbl);
			}
				
			//2、给前几代的会员分红
			$sql="SELECT * FROM ntb_user_ref WHERE lt<$lt and rt>$rt order by id desc  limit 0,$ds";
			$r = $db->select($sql);
			for ($i=0;$i<count($r);$i++){
				$money = $jiage*$tcbl[$i];
				$user = $r[$i];
				$userid = $user->node;
				$sql = "insert into ntb_money_point (userid,money,s_money,isf,type,fromuser) values ('$userid','$money','$money',1,0,'$uid');";
				$r1 = $db->insert ( $sql );
				if($r1 == -1){ $rollback = true;$serrnum=22; break; }
					
				$sql2="update ntb_user set z_money=z_money+$money where user_id='$userid'";
				$r2 = $db->update ( $sql2 );
				if($r2 == -1){ $rollback = true;$serrnum=23; break; }
			}
			*/
			
			
			
     	} while(false);
		
	   
		//业务结束，提交
		if($rollback == true){
			$db->rollback();
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
				"alert('未知原因，复消失败".$serrnum."若多次出现此情况，请及时联系管理员！');location.href='index.php?module=fxshowping';" . 
				"</script>";
		} else {
			$db->commit();
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
				"alert('重复消费成功！');" . 
				"location.href='index.php?module=fxshowping';</script>";
		}

     	return;

	}


	public function getRequestMethods(){
		return Request :: POST;
	}

	
}

?>