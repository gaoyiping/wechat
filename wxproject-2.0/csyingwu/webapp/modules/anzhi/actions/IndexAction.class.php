<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class IndexAction extends Action {
	
	
	   
	    public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		
		
		$userid = addslashes(trim($request->getParameter('userid')));
		if($userid == ''){
			$sql = "select user_id from ntb_user order by id  limit 0,1";
		    $r = $db->select($sql);
			if($r)
			{
			  $userid = $r[0]->user_id;
			}
		}
		
		//查询节点表
        $sql = "select * from ntb_board_face where node='".$userid."' order by board_no desc   limit 0,1"  ;
		  $r = $db->select($sql);
       
		   $left_name="";
		   $right_name="";					
		   if($r)
		   {
				$left_name= $r[0]->node_left;
                 $right_name= $r[0]->node_right;
						
			}
			
		

		//按用户查询名字和会员级别
          $sql = "select a.user_id,a.add_date,b.level from ntb_user a left join ntb_org b on a.user_id=b.user_id  WHERE  a.user_id='".$userid."'" ;
		   $r = $db->select($sql);
			 $username="";
			 $jname="";
			 $adddate="";
			 if($r)
			 {
					     $username= $r[0]->user_id;
                         $jname= $r[0]->level;
						 $adddate =$r[0]->add_date;
						
			  }
	     //查询已经结算的单数
  

		 $yijiesuan=0;

        //查询左侧要结算的单数
        $left_shu=0;
		$right_shu=0;
       
      
		
		$leftnum=0;
		$rightnum=0;

        $colorleft="#2953ee";
		$colorright="#2953ee";
		$jie=0;
		if(intval($right_shu)< intval($left_shu))
			{
		 $leftnum  =intval($left_shu)-intval($right_shu);
		 $jie=intval($right_shu);
		 $colorleft="#ee4e29";
		}
		else if(intval( $left_shu)< intval($right_shu))
			{
		   $rightnum=intval($right_shu)-intval($left_shu);
		   	$jie=intval($left_shu);
			 $colorright="#ee4e29";
		}
		else
			{
	
		}
        
		$userlist_str = "<table class='tablecss' align='center'  cellspacing='1'  ><tr class='trlan'><td "
		."colspan='3' >".$userid."</td></tr>"
		
		."</table>";
       
	    	
	     //绑定节点图
		 $userlist_str=$userlist_str. $this->Get_shu($left_name,$right_name,0,0,$userid,"");
			

	
		$request->setAttribute('userlist_str',$userlist_str);
		return View :: INPUT;
	}

	public function execute() {
		
	}


    public function Get_shu($leftname,$rightname,$jishu,$rightjishu,$shangji,$zuoyou)
	{
		$jishu++;
		$divwidth="";
		if($jishu==1)
		{
		  $divwidth="482";
		}
		if($jishu==2)
		{
		  $divwidth="240";
		}
	    if($jishu==3)
		{
		  $divwidth="160";
		}
		if($jishu==4)
		{
		  $divwidth="120";
		}	
		  
		$rightjishu++;
		$db = DBAction::getInstance();


	
	


          	$weizhuce1= "<table class='tablecss2' align='center'  cellspacing='1' ><tr class='weizhucecss'><td "
		.">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
		$userlist_str="";	 
        //绑定第一代
		

	
			//绑定第一代左侧
			if($leftname=="")
			{
			
					$userlist_str=$userlist_str."<table align='center' cellspacing=0 cellpadding=0><tr><td align='center' colspan=2> <div style='width:".$divwidth."px; text-align:center;'><div style='background:#fff; width:1px;'></div></div><div style='border-top:solid 1px #fff;"
			 ."width:".$divwidth."px; border-left:solid 1px #fff; border-right:solid 1px #fff;'></div></td><tr><tr><td valign=top> ";

					 $weizhuce= "<table class='tablecss1' align='center'  cellspacing='1'  ><tr class='weizhucecss'><td "
	             	.">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
				 $userlist_str=$userlist_str. $weizhuce;
				

			    if($jishu<4)
			    {
			    $userlist_str=$userlist_str. $this->Get_shu("wu","wu",$jishu,$rightjishu,$shangji,$zuoyou);	
			    }
				
			}
			else if($leftname=="wu")
			{				

					$userlist_str=$userlist_str."<table align='center' cellspacing=0 cellpadding=0><tr><td align='center' colspan=2> <div style='width:".$divwidth."px; text-align:center;'><div style='background:#fff; width:1px;'></div></div><div style='border-top:solid 1px #fff;"
			 ."width:".$divwidth."px; border-left:solid 1px #fff; border-right:solid 1px #fff;'></div></td><tr><tr><td valign=top> ";


				 $userlist_str=$userlist_str. $weizhuce1;
				
			    if($jishu<4)
			    {
			      $userlist_str=$userlist_str. $this->Get_shu("wu","wu",$jishu,$rightjishu,$shangji,$zuoyou);	
			    }
				
			}
			else
			{

				$userlist_str=$userlist_str."<table align='center' cellspacing=0 cellpadding=0><tr><td align='center' colspan=2> <div style='width:".$divwidth."px; text-align:center;'><div style='background:#2994f4; width:1px;'></div></div><div style='border-top:solid 1px #2994f4;"
			 ."width:".$divwidth."px; border-left:solid 1px #2994f4; border-right:solid 1px #2994f4;'></div></td><tr><tr><td valign=top> ";


				$sql = "select * from ntb_board_face  where node='".$leftname."'  order by board_no desc limit 0,1 " ;
		             $r = $db->select($sql);

					 $left_name="";
					 $right_name="";
					
					  if($r)
				     {
					   $left_name= $r[0]->node_left;
                        $right_name= $r[0]->node_right;
					
					 }
					 
					//按用户查询名字和会员级别
                 	 $sql = "select a.user_id,a.add_date,b.level from ntb_user a left join ntb_org b on a.user_id=b.user_id  WHERE  a.user_id='".$leftname."'" ;
		             $r1 = $db->select($sql);
					 $username="";
					 $jname="";
				    $adddate="";
					  if($r1)
				     {
					     $username= $r1[0]->user_id;
                         $jname= $r1[0]->level;
						
						 $adddate =$r1[0]->add_date;
						
					 }
				
				$userlist_str = $userlist_str."<table class='tablecss' align='center'  cellspacing='1'  ><tr class='trlan'><td "
				."colspan='3'><a href='index.php?module=anzhi&userid=$leftname'>".$leftname."</a></td></tr>"
					
		
		."</table>";
               
			    	
					
					 if($jishu<4)
				     {
	                    $userlist_str=$userlist_str. $this->Get_shu($left_name,$right_name,$jishu,$rightjishu,$leftname,"left");
					 }
				
                    
			}

			

            $userlist_str=$userlist_str."</td><td valign=top>";
			if($rightname=="")
			{
				 $weizhuce= "<table class='tablecss1' align='center'  cellspacing='1'  ><tr class='weizhucecss'><td "
	             	.">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
				 $userlist_str=$userlist_str. $weizhuce;
				 if($rightjishu<4)
				{
					 $userlist_str=$userlist_str. $this->Get_shu("wu","wu",$jishu,$rightjishu,$shangji,$zuoyou);	
				}
	            					        
				
			}
			else if($leftname=="wu")
			{				
				 $userlist_str=$userlist_str. $weizhuce1;
				
			    if($jishu<4)
			    {
			      $userlist_str=$userlist_str. $this->Get_shu("wu","wu",$jishu,$rightjishu,$shangji,$zuoyou);	
			    }
				
			}
			else
			{
            //绑定第一代右侧
			
			    //按用户查询左右用户
				$sql = "select * from ntb_board_face where node='".$rightname."'  order by board_no desc limit 0,1" ;
		             $r = $db->select($sql);
					 $left_name1="";
					 $right_name1="";
				
					  if($r)
				     {
					     $left_name1= $r[0]->node_left;
                         $right_name1= $r[0]->node_right;
						
					 }
                    //按用户查询名字和会员级别
                 	 $sql = "select a.user_id,a.add_date,b.level from ntb_user a left join ntb_org b on a.user_id=b.user_id  WHERE  a.user_id='".$rightname."'" ;
		             $r1 = $db->select($sql);
					 $username="";
					 $jname="";
				    $adddate="";
					  if($r1)
				     {
					     $username= $r1[0]->user_id;
                         $jname= $r1[0]->level;
						 $adddate =$r1[0]->add_date;
						
					 }
				$userlist_str =$userlist_str. "<table class='tablecss' align='center'  cellspacing=1 cellpadding=0  ><tr class='trlan'><td "
				."colspan='3'><a href='index.php?module=anzhi&userid=$rightname'>".$rightname."</a></td></tr>"
				
				
		
		."</table>";
			     
					 if($rightjishu<4)
				{
	                   $userlist_str=$userlist_str. $this->Get_shu($left_name1,$right_name1,$jishu,$rightjishu,$rightname,"right");
				}
			}
		
		 $userlist_str=$userlist_str."</td></tr></table>";
			
		
		return  $userlist_str;
	}

	 public function Get_zuonum($userid)
	 {
		 $db = DBAction::getInstance();
		$strID="";
	      $sql = "select * from ntb_board_face where node='".$userid."' border by board_no desc   limit 0,1";
		
		  $r = $db->select($sql);
		  if($r)
		  {
		   $strID= $this->Get_num( $r[0]->node_left,$r[0]->node_right,"");
		  }
		  return $strID;
	    
	 }
     

	   public function Get_num($leftname,$rightname,$strID)
	  {
		if($strID=="")
		{
		 static $strID="";
		 $strID="";
		
		}
		else
		 {
			  static $strID;
		 }
	  
		 $strID=$strID."'".$leftname."','". $rightname."',";

		$db = DBAction::getInstance();

			//绑定第一代左侧
			if($leftname!="")
			{
				  	$sql = "select * from ntb_board_face where node='".$leftname."' border by board_no desc   limit 0,1" ;
		             $r = $db->select($sql);
					 $left_name1="";
					 $right_name1="";
					
					  if($r)
				     {
					   $left_name1= $r[0]->node_left;
                       $right_name1= $r[0]->node_right;
					   $this->Get_num($left_name1,$right_name1,$strID);
						
					 }
			}
		
			if($rightname!="")
			{
				  	$sql = "select * from ntb_board_face where node='".$rightname."' border by board_no desc   limit 0,1" ;
		             $r = $db->select($sql);
					 $left_name1="";
					 $right_name1="";
					
					  if($r)
				     {
					   $left_name1= $r[0]->node_left;
                       $right_name1= $r[0]->node_right;
					   $this->Get_num($left_name1,$right_name1,$strID);
						
					 }
			}
			return $strID;

	}
	
	public function getRequestMethods() {
		return Request :: NONE;
	}

}
?>