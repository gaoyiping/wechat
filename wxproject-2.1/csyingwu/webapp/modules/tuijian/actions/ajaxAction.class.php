<?php
require_once (MO_LIB_DIR . '/DBAction.class.php');
class ajaxAction extends Action {
	public function getDefaultView() {
		$db = DBAction::getInstance ();
		$request = $this->getContext ()->getRequest ();
		$GroupID = addslashes(trim($request->getParameter('GroupID')));
		$width = addslashes(trim($request->getParameter('width')));
		
		$userlist_str = "";
		$sqlcmd = "SELECT `wxname`, `user_id` AS `node`, `uplevel` AS `level`, (SELECT COUNT(*) FROM `ntb_user` WHERE `pid`=`user`.`user_id`) AS `num` FROM `ntb_user` AS `user` WHERE `pid`='{$GroupID}'";
		// $sql = "select b.wxname, b.user_id node,b.uplevel as level ,(SELECT COUNT(id) from  ntb_user where pid=b.user_id) as num,b.user_name  from ntb_user b  where b.pid='$GroupID'";
		$r = $db->select ( $sqlcmd );
		
		if ($r) {
			
			foreach ( $r as $list ) {
				
				$img = "none";
				$img1 = "expand";
				
				$onclick = "";
				if ($list->num != 0) {
					
					$img = "";
					$img1 = "collspand";
					$onclick = "javascript:ShowMenu(this,'" . $list->node . "',30);";
				}
				
				$color = $this->Get_color ($list->level);

				switch ($list->level) {
					case 0: $level =  "见习店小二"; break;
					case 1: $level =  "店小二"; break;
					case 6: $level =  "伙计"; break;
					case 2: $level =  "掌柜"; break;
					case 3: $level =  "东家"; break;
					case 4: $level =  "富豪"; break;
					case 5: $level =  "大富豪"; break;
					case 7: $level =  "董事"; break;
				}
				
				$uid = $list->node;
				$sql = "select count(*) sam from ntb_record where type=1  and operation='$uid'";
				$rr = $db->select($sql);
				$msg = "已购";
				if($rr[0]->sam == 0){
					$msg = "未购";
				}
				$userlist_str .= "<div style='padding-left:5px;font-size:12px;height:25px;'><input type='text' style='width:{$width}px;float:left; border-bottom:dashed 1px #878585; height:10px;border-top:solid 1px #fff; border-left:solid 1px #fff;border-right:solid 1px #fff; ' />" . "<img style='vertical-align:-2px;' src='/new_style/images/" . $img1 . ".gif' id='imgMenu" . $GroupID . "' onclick=\"" . $onclick . "\" border='0'><img style='display:" . $img . ";vertical-align:-2px;' src='/new_style/images/foldclose.gif' id='1Menu" . $list->node . "'  /><font style='color:" . $color . ";font-size:12px;'>" . $list->node . " ({$list->wxname} [{$level} {$msg}])</font>&nbsp;</div><div id='Menu" . $list->node . "'  style='display:none;padding-left:30px;'></div>";
			}
		}
		echo $userlist_str . "[&]";
		return;
	}
	public function Get_color($level) {
		if ($level == "0") {
			$color = "#116600";
		} else if ($level == "1") {
			$color = "#1166FF";
		} else if ($level == "6") {
			$color = "#444ABB";
		} else if ($level == "2") {
			$color = "#966F12";
		} else if ($level == "3") {
			$color = "#C40D74";
		} else {
			$color = "#C40D74";
		}
		return $color;
	}
	public function execute() {
	}
	public function getRequestMethods() {
		return Request::NONE;
	}
}

?>