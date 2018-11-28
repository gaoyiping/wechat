<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();	
				

	     
		  $user_id =addslashes(trim($request->getParameter('userid')));
          $userlist_str="";
           
		  $uid=$user_id;
          if($user_id=="")
		  {
		    
		       $sql="select bloginID from admin_cg_danbao   where tuijiansNo='' "; 
               $r=$db->select($sql);
			   $uid=$r[0]->bloginID;
		  }
		 
		  

		       $sql="select a.bloginID,a.btype as level,a.bname from admin_cg_danbao a  where a.bloginID='$uid' "; 
		  
           	   $r=$db->select($sql);
               if($r)
				{
				     $color= $this->Get_color($r[0]->level);

					    $color= $this->Get_color($r[0]->level);

											$userlist_str= $userlist_str."<div style='padding-left:0px;font-size:12px;height:25px;'> "
							."<img src='/new_style/images/collspand.gif' id='imgMenu".$r[0]->bloginID."' onclick=\"javascript:ShowMenu(this,'".$r[0]->bloginID."',30);\" border='0'> <img src='/new_style/images/foldclose.gif' style='vertical-align:-2px;' id='1Menu".$r[0]->bloginID."'/><font size='2' ><song><a   style='color:".$color."'>".$r[0]->bloginID."</a></song> (".$r[0]->bname.")</font></div><div id='Menu".$r[0]->bloginID."'  style='display:none;'></div>";
					
				}
				else
					{
				   $userlist_str="<font color='red'>会员不存在!</font>";
				}  
		

	   if($user_id=="")
		{
	     $request->setAttribute('userid','');
	   }
	   else
		{
	       $request->setAttribute('userid',$uid);
	   }
		

		$request->setAttribute('userlist_str',$userlist_str);

		return View :: INPUT;
	}

	public function execute(){		
		
	}

	

    public function Get_color($level)
	{
	
	   if($level=="1")
	  {
	       return "#116600"; 
	  }
	  	  else if($level=="2")
	  {
	       return "#1166FF"; 
	  }
	 
	  else
		{
	  
	  }

	}
	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>