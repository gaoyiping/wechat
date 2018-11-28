<?php
require_once (MO_LIB_DIR . '/DBAction.class.php');
require_once (MO_LIB_DIR . '/ShowPager.class.php');
class IndexAction extends Action {
	public function getDefaultView() {
		$request = $this->getContext ()->getRequest();
		$db = DBAction::getInstance ();
		$user_id = addslashes(trim($request->getParameter('userid')));
		$userlist_str = "";
		if ($user_id) {
			$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='$user_id'";
			$rr = $db->select($sqlcmd);
		} else {
			$rr = false;
		}
		if ($rr) {
			for($i=0;$i<count($rr);$i++){
				$r [0] = $rr[$i];
				$color = $this->Get_color ( $r [0]->uplevel );
				$wxname=  $r [0]->wxname;
				$userlist_str .= "<div style='padding-left:0px;font-size:12px;height:25px;'><img src='/new_style/images/collspand.gif' id='imgMenu{$r[0]->user_id}' onclick=\"javascript:ShowMenu(this,'{$r[0]->user_id}',30);\" border='0'> <img src='/new_style/images/foldclose.gif' style='vertical-align:-2px;' id='1Menu" . $r [0]->user_id . "'/><font size='2' ><song>{$r[0]->user_id}</song> (" . $r [0]->wxname . ")</font></div><div id='Menu" . $r [0]->user_id . "'  style='display:none;'></div>";
			}	
		} else {
			$userlist_str = "<font color='red'>会员不存在!</font>";
		}
		$request->setAttribute('userid', $user_id);
		$request->setAttribute('userlist_str', $userlist_str);
		
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