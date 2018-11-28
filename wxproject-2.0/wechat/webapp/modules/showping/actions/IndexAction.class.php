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
		$sql = "select user_name, z_money  from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		if($r){
            		
			$request->setAttribute("spusername",$r[0]->user_name);
			$request->setAttribute("spemoney",$r[0]->z_money);
		}

		//绑定商品菜单
        $strMenu="";
	
		//取得商品分类数据
		$sql = "select * from ntc_type where tistrue=0 and ttype=1 and tID=26 order by torder" ;			
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
				$jifen =$value1->jifen;
				$danwei =$value1->danwei;
				$sNo =$value1->sNo;

				$strMenu = $strMenu.
				"<div><div id=\"divColumnItem_".$value->tID."_".$id."\" class=\"LH20 Width_per100 HideOverflow border_bm border_tp \">".
"<div style=\"margin-top: 2px; display: inline; margin-left: 30px\" id=\"imgColumnStatus_".$value->tID."_".$id."\" class=\"expand\"></div><div style=\"display: none\" id=\"divColumnDir_0\"></div>".
"<div id=\"divColumnTitle_".$value->tID."_".$id."\" class=\"AligntoLeft ML2 MT2 dline\" onmouseover=\"ShowColumn.OnmouseOverShowdiv(".$value->tID.",".$id.",'".$imgURL."','".$pname."',".$cost.",'".$detail."',".$ocost.",'".$zhuangxiangshu."',this)\"".
 "onmouseout=\"ShowColumn.OnmouseHiddiv(".$value->tID.",".$id.",'',this)\">".
"<div class=\"AligntoLeft\"><input id=\"chkboxpro_".$id."\" onclick=\"GetChooseGoods(".$id.",'".$pname."',".$cost.",".$jifen.",'False','".$danwei."','".$sNo."')\"".
" type=\"checkbox\" name=\"radion\" ></input></div>".
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
		$pwd = (strtolower($request->getParameter('pwd1')));
        //得到订单的商品的ID，金额,数量
	   $jishu=0;
       $fornum=200;
	   $strID="0";
	   $pv=0;
	   $strnum="";
	   $jiage=0;
	   $ayy=array();

	   $strsql="";

		
		$uplevel=0;
		
		

	    //判定会员ID是否存在
		$sql = "select user_id from ntb_user where user_id = '$uid'";
		$r = $db->select($sql);
		if($r){
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
				"alert('会员账号 $uid 已经存在！');location.href='index.php?module=showping';" . 
				"</script>";
				
		}
        
		
		//判定会员ID是否存在
		$sql = "select user_id from ntb_user where user_id = '$pid'";
		$r = $db->select($sql);
		if(!$r){
			header('Content-Type: text/html;charset=utf-8');
			echo "<script type='text/javascript'>" .
				"alert('推荐账号 $pid 不存在！');location.href='index.php?module=showping';" . 
				"</script>";
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
            
			

			 $ndianpu=$userid;
			//插入新会员基本信息***********************************************************************
			$sql = "insert into ntb_user(user_id,e_money,add_date," . 
				"user_name,first_pwd,second_pwd,idno,address,mobile,tel,e_mail," . 
				"card_name,provcity,card_type,card_number,z_money,usertype,dianpu,zhucetype,yeji,pv,smoney,uplevel) " . 
				"values('$uid','0',CURRENT_TIMESTAMP,'$username','$pwd1','$pwd2'," . 
				"'$idno','$address','$mobile','$tel','$email'," . 
				"'$cardname','$provcity','$cardtype','$cardnumber',0,'$usertype','$ndianpu','2','$pv',0,'$jiage',$uplevel)";
			$r = $db->insert($sql);
			if($r == -1){ $rollback = true;$serrnum=3; break; }

			

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
			/*

			//领导奖
			//找出所有直推线的上级
			//1、找出当前会员的lt、rt
			$sql="select lt,rt from ntb_user_ref where node='$uid'";
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
				"alert('未知原因，注册会员失败".$serrnum."若多次出现此情况，请及时联系管理员！');location.href='index.php?module=showping';" . 
				"</script>";
			
		} else {
			$db->commit();
			sendphone("恭喜，你已成功注册微优品代理，请牢记你的会员登录号:$uid,登录密码:$pwd","$mobile");
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
	
	
	

	
}

?>