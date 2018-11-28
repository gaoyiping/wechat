<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class ajaxAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$GroupID = addslashes(trim($request->getParameter('GroupID')));
		$width = addslashes(trim($request->getParameter('width')));

       
	      $strID="";
	      $sql = "select  b.user_id node,b.uplevel as level ,(SELECT  COUNT(id)  from  ntb_user where pid=b.user_id) as num,b.user_name,b.wxname  from ntb_user b  where b.pid='$GroupID'";

		  $r = $db->select($sql);
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
					  $onclick="javascript:ShowMenu(this,'".$list->node."',30);";
					
				  }
				
                  	$color= $this->Get_color($list->level);

				 
				       $strID=$strID."<div  style='padding-left:5px;font-size:20px;height:25px;' > <span style='width:".$width."px;float:left; border-bottom:solid 1px #878585; height:15px;border-left:solid 1px #878585; ' ></span>"
				  ."<img style='vertical-align:-2px;' src='/new_style/images/".$img1.".gif' id='imgMenu".$GroupID."' onclick=\"".$onclick."\" border='0'><img style='display:".$img.";vertical-align:-2px;' src='/new_style/images/foldclose.gif' id='1Menu".$list->node."'  /><font style='color:".$color.";font-size:20px;'><song><a  style='color:".$color.";text-decoration:none;'  href='#' onclick=\"Showopen('".$list->node."');\">".$list->node." (".$list->wxname.")</a></font>&nbsp;</div><div id='Menu".$list->node."'  style='display:none;padding-left:30px;'></div>";
					   
			
				  
				 
			  }
		  }
          echo  $strID."[@]";
		return;
	}

	  public function Get_color($level)
	{
	    if ($level == "0") {
			$color = "#116600";
		} else if ($level == "1") {
			$color = "#1166FF";
		} else if ($level == "2") {
			$color = "#966F12";
		} else if ($level == "3") {
			$color = "#C40D74";
		} else {
			$color = "#C40D74";
		}
		return $color;

	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>