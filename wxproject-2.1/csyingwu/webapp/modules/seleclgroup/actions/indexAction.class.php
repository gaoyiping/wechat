<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');


class indexAction extends Action {

		public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();	
				


		  $userlist_str="";

		   $sql="select *,(SELECT  COUNT(GroupID)  from  admin_cg_group where G_ParentID=a.GroupID) as num   from admin_cg_group a where a.G_ParentID=0 order by a.GroupID"; 
		  
		  
           	   $r=$db->select($sql);
               if($r)
				{
				
                      foreach($r as $list)
					 {
						  $img="none";
						  $img1="expand";

						  $onclick="";
						  if($list->num!=0)
						  {
							
							 $img="";
							 $img1="collspand";
							  $onclick="javascript:ShowMenu(this,'Menu".$list->GroupID."','".$list->GroupID."',25,0,'');";
							
						  }

							$userlist_str= $userlist_str."<div style='padding-left:0px;font-size:12px;height:25px;'> "
							."<img style='vertical-align:-2px;' src='/new_style/images/".$img1.".gif' id='imgMenu".$list->GroupID."' onclick=\"".$onclick."\" border='0'> <img src='/new_style/images/foldclose.gif' id='1Menu".$list->GroupID."' style='vertical-align:-2px;'/><font  style='font-size:12px;'><song><a    style='color:#000;text-decoration:none;'>".$list->G_CName."</a></song></font></div><div id='Menu".$list->GroupID."'  style='display:none;'></div>";
							
					 }
					
				}
		

	
		

		$request->setAttribute('userlist_str',$userlist_str);

		return View :: INPUT;
	}



	 public function Get_zuonum($user_id,$width,$jishu,$yname,$sname)
	 {
		
		   $jishu++;
		   if($jishu==30)
		   {
		    return "";
		   }
		
		 $width=$width+28;
		 $db = DBAction::getInstance();
		 static $strID="";
	     $sql = "select  *,(SELECT  COUNT(GroupID)  from  admin_cg_group where G_ParentID=a.GroupID) as num  from admin_cg_group a  where a.G_ParentID='$user_id'";

		 
		
		  $r = $db->select($sql);
		  
		  if($width==35)
		 {
              $strID=$strID."<div id='Menu".$user_id."' >";
		 }
		 else
		 {
		    $strID=$strID."<div id='Menu".$user_id."' style='display:none;'>";
		 } 
		 
		  if($r)
		  {
          
		 
			  foreach($r as $list)
			  {
				 
				  $img="none";
			      $img1="expand";

				  $onclick="";

				  $select ="";
				  if($list->num!=0)
				  {
				     $img="";
                     $img1="collspand";

					  $onclick="javascript:ShowMenu(this,'Menu".$list->GroupID."');";

				  }

				  if($list->G_Level==4)
				  {
				   $select ="xNowMove('".$list->G_CName."',".$list->GroupID.",".$user_id.",'".$yname."','".$sname."');";
				  }
				  
                  
				  $color="#000000";
				 
				       $strID=$strID."<div  style='padding-left:5px;font-size:12px;height:25px;' ><input type='text' style='width:".$width."px;float:left; border-bottom:dashed 1px #878585; height:10px;border-top:solid 1px #fff; border-left:solid 1px #fff;border-right:solid 1px #fff; ' />"
				  ."<img src='/new_style/images/".$img1.".gif' style='vertical-align:-2px;' id='imgMenu".$user_id."' onclick=\"".$onclick."\" border='0'><img style='display:".$img."' src='/new_style/images/foldclose.gif' style='vertical-align:-2px;' id='1Menu".$list->GroupID."'  /><font style='color:".$color.";font-size:12px;'><song><a   style='color:#000;text-decoration:none;' onclick=\"".$select."\" >".$list->G_CName."</a></font>&nbsp;</div>";
					   
				  $this->Get_zuonum($list->GroupID,$width,$jishu,$list->G_CName,$sname);
				  
				 
			  }
		  }
           $strID=$strID."</div>";
		  
		   return $strID;
	    
	 }
    

	public function execute(){		
		
	}

	
	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>