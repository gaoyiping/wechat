<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class tuijianajaxAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = addslashes(trim($request->getParameter('uid')));
		$type = $request->getParameter('type');
		$sql = "select user_id from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		//
		$sql = "select node from ntb_user_ref where p_node = '$userid'";
		$r = $db->select($sql);
		//
		$str="";
		if($r)
		{
			$img="collspand.gif";
		    foreach($r as $list)
			{
			 // $str=$str.$list->node;

			    
                  	$sql = "select node from ntb_user_ref where p_node = '$list->node'";
		            $r = $db->select($sql);

					if($r)
				    {
                          $img="expand.gif";     					
					}
			    $str=$str."<div  style='padding-left:;font-size:12px;height:25px;' onclick=\"javascript:checkpid('".$list->node."');\">"
				  ."<img src='/new_style/images/".$img."' id='imgMenu'  border='0'><img style='' src='/new_style/images/foldclose.gif' id='1Menu".$list->node."'  /><font size='2'><song>".$list->node."</font>&nbsp; </div>";
				
				 
			}
			echo $str;
		}
		return;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>