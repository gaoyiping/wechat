<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class IndexAction extends Action {
	

	// EDITED BY SKS 2010.02.09 END
	
	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		$userid = $this->getContext()->getStorage()->read('_user_id');
        $board_no=0;

        $board1="";
		$board2="";
		$board3="";
		$board4="";
		$board5="";
		$board6="";
		$board7="";
		$board8="";
		$board9="";
		$board10="";
		$board11="";
		$board12="";
		$board13="";
		$board14="";
		$board15="";

		$sql="select board_no from ntb_user where user_id='$userid'";
		$r=$db->select($sql);
		if($r)
		{
		   $board_no=$r[0]->board_no;

           $sql="select * from ntb_board where id='$board_no'";
		   $r=$db->select($sql);
		    if($r)
			{
		      $board1 = $this->Get_user($r[0]->node_1); 
			  $board2 = $this->Get_user($r[0]->node_2); 
			  $board3 = $this->Get_user($r[0]->node_3); 
			  $board4 = $this->Get_user($r[0]->node_4); 
			  $board5 = $this->Get_user($r[0]->node_5); 
			  $board6 = $this->Get_user($r[0]->node_6); 
			  $board7 = $this->Get_user($r[0]->node_7); 

			  $board8 = $this->Get_user($r[0]->node_8); 
			  $board9 = $this->Get_user($r[0]->node_9); 
			  $board10 = $this->Get_user($r[0]->node_10); 
			  $board11 = $this->Get_user($r[0]->node_11); 
			  $board12 = $this->Get_user($r[0]->node_12); 
			  $board13 = $this->Get_user($r[0]->node_13); 
			  $board14 = $this->Get_user($r[0]->node_14); 
			  $board15 = $this->Get_user($r[0]->node_15); 
		    }
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
		$request->setAttribute('board14',$board14);
		$request->setAttribute('board15',$board15);
		
		$request->setAttribute('board_no',$board_no);
		return View :: INPUT;
	}

	public function execute() {
		
	}

	public function Get_user($userid) 
    {
		$user_id = $this->getContext()->getStorage()->read('_user_id');
		$db = DBAction::getInstance();
		$str="";
	    $sql="select left(add_date,10) as add_date  from ntb_user where user_id='$userid'";
		$r=$db->select($sql);
		if($r)
		{
            if($user_id==$userid)
            {
			  
			}


			$str=" <tr><td align='center' colspan='2'>"
             ."<span class='xuhao'><b style='color: black'>".$userid."</b></span>"
             ."</td> </tr><tr><td class='layel' colspan='2' style='color: #000000;'>"
             .$r[0]->add_date."</td></tr>";
   
		}
		else
		{
		   $str=" <tr><td align='center' colspan='2' class='layel'>"
             ."未注册"
             ."</td> </tr><tr><td class='layel' colspan='2' style='color: #000000;'>"
             ."</td></tr>";
		}
		return $str;
	}

	public function getRequestMethods() {
		return Request :: NONE;
	}

}
?>