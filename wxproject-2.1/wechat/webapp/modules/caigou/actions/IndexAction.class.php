<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	
		$delete=$request->getParameter("delete");
		$sNo=$request->getParameter("sNo");
		$userid = $this->getContext()->getStorage()->read('_user_id');
     

		//详情
		$sql = "select a.*,b.tname,b.bgcolor,(select sum(rnum) from admin_cg_kucun where rsNo=a.sNo and rtype=1 ) as ruku,(select sum(rnum) from admin_cg_kucun where rsNo=a.sNo and rtype=2 ) as chuku  from ntc_rproducts a left join ntc_type b on a.typeID=b.tID where a.isdelete=0 order by a.typeID,a.sorder";
		$r = $db->select($sql);
		//处理价格格式


		//如果退回上一步 则删除订单内容及订购明细内容
        if($delete=="yes" && $sNo!="")
		{
		
		  $sql="select moneys from ntc_rorder where sNo='$sNo' and user_id='$userid' ";
		  $r=  $db->select($sql);
		    
		  if($r)
		  {
			
		     $sql = "update ntb_user set z_money =z_money+".$r[0]->moneys." where user_id='$userid' " ;
			
			 $r = $db -> update($sql);
			
		  }
		 
			//删除订单表
		  $str="delete from ntc_rorder where sNo='".$sNo."' and user_id='".$userid."'";
		  $db->delete($str);
           
		

		  //删除总部出库明细
		  $str="delete from admin_cg_kucun where rliushui='".$sNo."' and user_id='".$userid."'";
		  $db->delete($str);

		    header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"location.href='index.php?module=caigou';</script>";
		}
		

        $sql1 = "select count(id) as zongji   from ntc_rproducts where isdelete=0";
		$r1 = $db->select($sql1);
         if($r1)
		{  
		   $request->setAttribute("zongji",$r1[0]->zongji);
		}
		
       
		 
		
		
	
		//获得当前账户余额
		$sql2 = "select user_name, z_money from ntb_user where user_id = '$userid'";
		$r2 = $db->select($sql2);
		if($r2){
          		
			$request->setAttribute("spemoney",$r2[0]->z_money);
		
		}
		$request->setAttribute("rpros",$r);
		
		return View :: INPUT;
		
	}

	public function execute() {
    	$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		 $tzongji=$request->getParameter("tzongji");
		 $zhongjine=$request->getParameter("zhongjine");

		 
        $num=200;

	    $jiage=0;
		$jishu=0;
	   //得要购买的商品ID 和购买数量
       for($i=1;$i<=$tzongji;$i++)
	   {	       
          if(isset($_POST["jiage".$i]))
		   {
			
			  if($_POST["tnum".$i]!="0")
			   {
			    $jishu=$jishu+ $_POST["tnum".$i];
	            $jiage=$jiage+($_POST["jiage".$i]*$_POST["tnum".$i]);
			   }
			
		   }
		   
	   }
       if($jiage==0)
	   {
	      header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('您没有选择产品！');" .
				"location.href='index.php?module=caigou';</script>";
			return $this->getDefaultView();
	   }
	   	//查询用户的电子货币
		$sql = "select * from ntb_user " .
			"where user_id = '$userid' ";
		$r = $db->select($sql);

		$xingming="";
		$dizhi="";
		$dianhua="";
		if($r){

            $xingming=$r[0]->user_name;
			$dizhi=$r[0]->address;
			$dianhua=$r[0]->mobile;
           
			if($r[0]->z_money<$jiage)
			{
			 header("Content-type:text/html;charset=utf-8");
			 echo "<script type='text/javascript'>" .
			 "alert('*您的电子货币余额不足！');" .
			 "location.href='index.php?module=caigou';</script>";
 
     		  return $this->getDefaultView();
			}


		}
        $bianhao="";

	  //添加订单
		$rollback = false;
		$rollcode = 0;
		$db->begin();
		do{
			
            //扣除专卖店的电子货币
									$sql = "update ntb_user set z_money =z_money-".$jiage." where user_id='$userid' " ;
									$r = $db -> update($sql);
									if ($r < 1) { $rollback = true; $rollcode = 7; break; }

            
			$bianhao= "DD".date("ymdhis").rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);

		    // 2.订单
			$sql_2 = "insert into ntc_rorder(" .
				"user_id, post_name, post_tel, post_address, " .
				"way, counts, moneys, emoneys, status, add_date,stype,sNo) values(" .
				"'".$userid."','".$xingming."','".$dianhua."','".$dizhi."',1,".$jishu.",".$jiage.",".$jiage.",'3', CURRENT_TIMESTAMP,'0','$bianhao')";
			
			$r_2 = $db->insert($sql_2, "last_insert_id");
			$order_id=$r_2;
	        if ($r_2 < 1) { $rollback = true; $rollcode = 1; break; }


		   //得要购买的商品ID 和购买数量添加到总部出库明细
           for($k=1;$k<=$tzongji;$k++)
	       {
	          if(isset($_POST["jiage".$k]))
		      {
			
					   if($_POST["tnum".$k]!="0")
					   {  
						 $strsql=" insert into admin_cg_kucun(" .
						"rsNo, rname, pID, typeID, rdate, rnum,rshangjia,rdanwei,rjiage,pubdate,tiaoma,rtype,rleixing,rliushui,user_id,shoujia) " .
						"values('".$_POST["tsNo".$k]."','".$_POST["pname".$k]."',".$_POST["tid".$k].",0,CURRENT_TIMESTAMP,".$_POST["tnum".$k].",''," .
						"'".$_POST["tdanwei".$k]."',".$_POST["jiage".$k].",".
						 "CURRENT_TIMESTAMP,'".$_POST["tiaoma".$k]."',2,0,'$bianhao','$userid',".$_POST["jiage".$k].") ;";
							$r_3 = $db->insert($strsql);
							if ($r_3 < 1) { $rollback = true; $rollcode = 4; break; }
					   }

		      }
		 		   
	       }



			
        } while(0);
		if ($rollback) 
		{ 
			$db->rollback(); 
			     header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"location.href='index.php?module=caigou';</script>";
		       
		} else 
		{
			$db->commit();
		
		           header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"location.href='index.php?module=caigou&action=ok2&sNo=".$bianhao."';</script>";
		}


				return;
	 
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>