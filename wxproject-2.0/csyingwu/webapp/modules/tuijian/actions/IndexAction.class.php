<?php
require_once (MO_LIB_DIR . '/DBAction.class.php');
require_once (MO_LIB_DIR . '/ShowPager.class.php');
class IndexAction extends Action {
	public function getDefaultView() {
		
		
		
		$request = $this->getContext ()->getRequest ();
		$db = DBAction::getInstance ();
		$user_id = addslashes ( trim ( $request->getParameter ( 'userid' ) ) );
		$userlist_str = "";
		
		$uid = $user_id;
		if ($user_id == "") {
			
			$sql = "select * from ntb_user   where pid  is NULL and id=1";
			//$r = $db->select ( $sql );
			//$uid = $r [0]->node;
		}else{
		
			$sql = "select * from ntb_user a  where a.user_id='$uid' ";
		}
		
		$rr = $db->select ( $sql );
		if ($rr) {
			for($i=0;$i<count($rr);$i++){
				$r [0] = $rr[$i];
				$color = $this->Get_color ( $r [0]->uplevel );
				$wxname=  $r [0]->wxname;
				$userlist_str = $userlist_str . "<div style='padding-left:0px;font-size:12px;height:25px;'> " . "<img src='/new_style/images/collspand.gif' id='imgMenu" . $r [0]->user_id . "' onclick=\"javascript:ShowMenu(this,'" . $r [0]->user_id . "',30);\" border='0'> <img src='/new_style/images/foldclose.gif' style='vertical-align:-2px;' id='1Menu" . $r [0]->user_id . "'/><font size='2' ><song><a href='#' onclick=\"Showopen('" . $r [0]->user_id . "');\" style='color:" . $color . "'>" . $r [0]->user_id . "</a></song> (" . $r [0]->wxname . ")</font></div><div id='Menu" . $r [0]->user_id . "'  style='display:none;'></div>";
			}
			
		} else {
			$userlist_str = "<font color='red'>会员不存在!</font>";
		}
		
		if ($user_id == "") {
			$request->setAttribute ( 'userid', '' );
		} else {
			$request->setAttribute ( 'userid', $uid );
		}
		
		$request->setAttribute ( 'userlist_str', $userlist_str );
		
		return View::INPUT;
	}
	public function execute() {
	}
	public function Get_color($level) {
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
	public function getRequestMethods() {
		return Request::NONE;
	}
}
?>