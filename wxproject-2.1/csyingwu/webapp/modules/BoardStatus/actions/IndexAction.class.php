<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class IndexAction extends Action {
	
	public function getDefaultView() {
	    $db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		
		$board1="";
		$board2=$this->Get_none();
		$board3=$this->Get_none();
		$board4=$this->Get_none();
		$board5=$this->Get_none();
		$board6=$this->Get_none();
		$board7=$this->Get_none();
		$board8=$this->Get_none();
		$board9=$this->Get_none();
		$board10=$this->Get_none();
		$board11=$this->Get_none();
		$board12=$this->Get_none();
		$board13=$this->Get_none();

       
        $link="";
		$userid = addslashes(trim($request->getParameter('userid')));
		if($userid == ''){
			$sql = "select user_id from ntb_user order by id  limit 0,1";
		    $r = $db->select($sql);
			if($r)
			{
			  $userid = $r[0]->user_id;
			}
		}
		else
	    {
		  	$sql = "select p_node from ntb_anzhi where node='$userid' and p_node<>1";
		    $r = $db->select($sql);
			if($r)
			{
			  $link = " href='index.php?module=BoardStatus&userid=".$r[0]->p_node."' ";
			}
		}
		
		  //绑定1号位
		  $r = $db->select($this->Get_sql($userid));

		   $lt2="";
		   $lt3="";
		   $lt4="";
		   $lt5="";
		   $lt6="";
		   $lt7="";
		   $lt8="";
		   $lt9="";
		   $lt10="";
		   $lt11="";
		   $lt12="";
		   $lt13="";
	
		 
		   if($r)
		   {
				
                   $lt2= $r[0]->node_left;
				   $lt3= $r[0]->node_right;
				   $lt4= $r[0]->node_center;
	
				   $board1=$this->Get_str($userid,$r[0]->user_name,$this->Get_num($lt2),$this->Get_num($lt4),$this->Get_num($lt3),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);

              
                   //绑定2号位
                   $r = $db->select($this->Get_sql($lt2));
				   // $r=false;
				   if($r)
			       {
					     
						   $lt5= $r[0]->node_left;
						   $lt6= $r[0]->node_center;
						   $lt7= $r[0]->node_right;
						   $board2=$this->Get_str($lt2,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);

						       //绑定5号位
							   $r = $db->select($this->Get_sql($lt5));
							   // $r=false;
							   if($r)
							   {									 
									   $board5=$this->Get_str($lt5,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);					
							   }
							   else{$board5=$this->Get_none();}

							   //绑定6号位
							   $r = $db->select($this->Get_sql($lt6));
							  
							  // $r=false;
							   if($r)
							   {
								 									  
									   $board6=$this->Get_str($lt6,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);
									
							   }
							    else{$board6=$this->Get_none();}
							   //绑定7号位
							   $r = $db->select($this->Get_sql($lt7));
							  // $r=false;
							   if($r)
							   {
									   $board7=$this->Get_str($lt7,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);
									
							   }
							   else{$board7=$this->Get_none();}
							 	

				   }
			       else{$board2=$this->Get_none();}

				   //绑定3号位
                   $r = $db->select($this->Get_sql($lt4));
				  
				  // $r=false;
                   if($r)
			       {
					 
						   $lt8= $r[0]->node_left;
						   $lt9= $r[0]->node_center;
						   $lt10= $r[0]->node_right;
						   $board3=$this->Get_str($lt4,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);


						       //绑定8号位
							   $r = $db->select($this->Get_sql($lt8));
							   // $r=false;
							   if($r)
							   {									 
									   $board8=$this->Get_str($lt8,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);									
							   }
							   else{$board8=$this->Get_none();}

							   //绑定9号位
							   $r = $db->select($this->Get_sql($lt9));
							 
							  // $r=false;
							   if($r)
							   {
								 									  
									   $board9=$this->Get_str($lt9,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);
									
							   }
							    else{$board9=$this->Get_none();}
							   //绑定10号位
							   $r = $db->select($this->Get_sql($lt10));
							  // $r=false;
							   if($r)
							   {
									   $board10=$this->Get_str($lt10,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);
									
							   }
							   else{$board10=$this->Get_none();}

						
				   }else{$board3=$this->Get_none();}
                   
				   //绑定3号位
                   $r = $db->select($this->Get_sql($lt3));
				  // $r=false;
                   if($r)
			       {
						   $lt11= $r[0]->node_left;
						   $lt12= $r[0]->node_center;
						   $lt13= $r[0]->node_right;
						   $board4=$this->Get_str($lt3,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);


						    //绑定11号位
							   $r = $db->select($this->Get_sql($lt11));
							   // $r=false;
							   if($r)
							   {									 
									   $board11=$this->Get_str($lt11,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);									
							   }
							   else{$board11=$this->Get_none();}

							   //绑定12号位
							   $r = $db->select($this->Get_sql($lt12));
							 
							  // $r=false;
							   if($r)
							   {
								 									  
									   $board12=$this->Get_str($lt12,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);
									
							   }
							    else{$board12=$this->Get_none();}
							   //绑定13号位
							   $r = $db->select($this->Get_sql($lt13));
							  // $r=false;
							   if($r)
							   {
									   $board13=$this->Get_str($lt13,$r[0]->user_name,$this->Get_num($r[0]->node_left),$this->Get_num($r[0]->node_center),$this->Get_num($r[0]->node_right),$r[0]->add_date,$r[0]->node_left,$r[0]->node_right,$r[0]->node_center,$r[0]->level,$r[0]->left_money,$r[0]->center_money,$r[0]->right_money,$r[0]->uplevel);
									
							   }
							   else{$board13=$this->Get_none();}


						
				   }
				   else{$board4=$this->Get_none();}
                   
						
		   }
			


		$request->setAttribute('board1',$board1);
		$request->setAttribute('board2',$board2);
		$request->setAttribute('board3',$board3);
		$request->setAttribute('board4',$board4);
		$request->setAttribute('board5',$board5);
		$request->setAttribute('board6',$board6);
		$request->setAttribute('board7',$board7);

		$request->setAttribute('board8',$board8);
		$request->setAttribute('board9',$board9);
		$request->setAttribute('board10',$board10);
		$request->setAttribute('board11',$board11);
		$request->setAttribute('board12',$board12);
		$request->setAttribute('board13',$board13);


		$request->setAttribute('link',$link);
	
		return View :: INPUT;
	}

	public function execute() {
		
	}
    
	//获得会员左右总人数
    public function Get_num($userid) {
          $db = DBAction::getInstance();
		 $num=0;
	    $sql = " select count(id) as num from ntb_anzhi b where b.lt>(select lt from ntb_anzhi where node='$userid')"
		." and rt<(select rt from ntb_anzhi where node='$userid' ) ";
		    $r = $db->select($sql);
			if($r)
			{
			  $num = $r[0]->num;
			}
			return $num;
	}


	public function Get_sql($userid)
	{
	  return  "select a.user_id,a.user_name,left(a.add_date,10) as add_date,c.node_left,c.node_center,c.node_right"
	  .",a.usertype as level,a.uplevel,"
		
		 ."(select left_money from ntb_duipeng d where a.user_id=d.userid) as  left_money,"
		 ."(select center_money from ntb_duipeng d where a.user_id=d.userid) as  center_money,"
		 ."(select right_money from ntb_duipeng e where a.user_id=e.userid) as right_money  "
		 ."from ntb_user a right join ntb_board_face c on a.user_id=c.node where a.user_id='$userid'  "
		 ."order by c.id desc limit 0,1";
	}

	  public function Get_none()
	{
		
 return "<table bgcolor='#5D97B7' width='94px' height='72px' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='center'>"
."<table width='85' bgcolor='#FFFF99' border='0' height='62' cellspacing='0' cellpadding='0'><tr><td>"
."<img src='modpub\images\head_12012.jpg' height='62' width='85'></img></td></tr></table></td></tr></table>";
	     
	}


	
    public function Get_str($userid,$name,$lt,$ct,$rt,$date,$node_left,$node_right,$node_center,$level,$left_money,$center_money,$right_money,$pinwei)
	{
		$level=$pinwei;
		$num=$lt;
		if($node_left!="")
		{
		  $num=$num+1;
		}

		$num1=$rt;
		if($node_right!="")
		{
		  $num1=$num1+1;
		}

		$num2=$ct;
		if($node_center!="")
		{
		  $num2=$num2+1;
		}
       $color="";
	
	   if($level=="0")
	  {
	       $color= "#116600"; 
	  }
	  	  else if($level=="1")
	  {
	       $color= "#1166FF"; 
	  }
	  	  else if($level=="2")
	  {
	       $color= "#966F12"; 
	  }
	  	  else if($level=="3")
	  {
	       $color= "#C40D74"; 
	  }
	  
	  else
	  {
	  		$color= "#C40D74";
	  }

	      return  " <table bgcolor='$color' width='2px' height='2px' border='0' align='center' cellpadding='0'"
                 ."cellspacing='0'><tr><td align='center' "
                 ." >   "
			     ."  <table class='netseach' width='86' border='0'  cellspacing='0' cellpadding='0'  id=\"divColumnTitle_".$userid."\"  "
				 ."onmouseover=\"ShowColumn.OnmouseOverShowdiv('".$userid."',".$num.",".$num2.",".$num1.",0,0,0,this,'".$this->Get_pinwei($pinwei)."')\""
				 ."onmouseout=\"ShowColumn.OnmouseHiddiv('".$userid."','',this)\" >"
                   ."<tr><td colspan='2' align='center'><span class='xuhao'><a href='index.php?module=BoardStatus&userid=".$userid."'>"
                   ." <b style='color: black'>".$userid." </b></a></span></td></tr><tr>"
                   ." <td class='layel' style='color: #000000;' colspan='2'>"
                   ." ".$name."</td></tr><tr><tr>"
                   ."<td colspan='2' class='layel' style='color: #000000;'>"
					."".$date."</td></tr></table>"
					."</td></tr></table><div id=\"litl_".$userid."\" runat=\"server\"></div>";
	}



	public function Get_pinwei($pinwei)
	{
	   if($pinwei==0)
	   {
	      return "商城会员";
	   }
	   else if($pinwei==1)
	   {
	   		return "县级代理";
	   }
	    else if($pinwei==2)
	   {
	   		return "市级代理";
	   }
	    else if($pinwei==3)
	   {
	   		return "省级代理";
	   }
	    
	}
    
	
	public function getRequestMethods() {
		return Request :: NONE;
	}

}
?>