<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class ajaxAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$GroupID = addslashes(trim($request->getParameter('GroupID')));
		$width = addslashes(trim($request->getParameter('width')));
		$fuID = addslashes(trim($request->getParameter('fuID')));
		$funame = addslashes(trim($request->getParameter('funame')));

       
	      $strID="";
	      $sql = "select  *,(SELECT  COUNT(GroupID)  from  admin_cg_group where G_ParentID=a.GroupID) as num  from admin_cg_group a  where a.G_ParentID='$GroupID'";

		 
		
		  $r = $db->select($sql);
		  
		 
		 
		  if($r)
		  {
          
		 
			  foreach($r as $list)
			  {
				 
				  $img="none";
			      $img1="expand";
                  $select="";
				  $onclick="";
				  if($list->num!=0)
				  {
					 
				     $img="";
                     $img1="collspand";
					  $onclick="javascript:ShowMenu(this,'Menu".$list->GroupID."','".$list->GroupID."',50,'".$list->G_CName."','".$list->G_ParentID."');";
					
				  }
				  if($list->G_Level==4)
				  {
				    $select ="javascript:xNowMove('".$list->G_CName."',".$list->GroupID.",".$GroupID.",'".$fuID."','".$funame."');";
				  }
                  
				  $color="#000000";
				 
				       $strID=$strID."<div  style='padding-left:5px;font-size:12px;height:25px;' ><input type='text' style='width:".$width."px;float:left; border-bottom:dashed 1px #878585; height:10px;border-top:solid 1px #fff; border-left:solid 1px #fff;border-right:solid 1px #fff; ' />"
				  ."<img style='vertical-align:-2px;' src='/new_style/images/".$img1.".gif' id='imgMenu".$GroupID."' onclick=\"".$onclick."\" border='0'><img style='display:".$img.";vertical-align:-2px;' src='/new_style/images/foldclose.gif' id='1Menu".$list->GroupID."'  /><font style='color:".$color.";font-size:12px;'><song><a  target='mainbody' style='color:#000;text-decoration:none;' onclick=\"".$select."\" >".$list->G_CName."</a></font>&nbsp;</div><div id='Menu".$list->GroupID."'  style='display:none;'></div>";
					   
			
				  
				 
			  }
		  }
          echo  $strID."|";
		return;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>