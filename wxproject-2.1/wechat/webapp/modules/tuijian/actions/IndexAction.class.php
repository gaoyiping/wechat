<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();	
				
	    $userid = $this->getContext()->getStorage()->read('_user_id');
        $userlist_str="";
        $sql="select * from ntb_user a  where a.user_id='$userid' "; 
		  
       	$r=$db->select($sql);
        if($r)
		{
				$color= $this->Get_color($r[0]->uplevel);

				$userlist_str= $userlist_str."<div style='padding-left:0px;font-size:20px;height:25px;'> "
				."<img src='/new_style/images/collspand.gif' id='imgMenu".$r[0]->user_id."' onclick=\"javascript:ShowMenu(this,'".$r[0]->user_id."',30);\" border='0'> <img src='/new_style/images/foldclose.gif' style='vertical-align:-2px;' id='1Menu".$r[0]->user_id."'/><font size='2' ><song><a href='#' onclick=\"Showopen('".$r[0]->user_id."');\" style='color:".$color.";font-size:20px;'>".$r[0]->user_id."</a></song> (".$r[0]->wxname.")</font></div><div id='Menu".$r[0]->user_id."'  style='display:none;'></div>";
					
		}
		

		$request->setAttribute('userlist_str',$userlist_str);

		return View :: INPUT;
	}

	public function execute(){		
		
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
	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>