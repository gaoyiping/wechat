<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$user_name = $this->getContext()->getStorage()->read('_user_name');
		$db = DBAction::getInstance();		

		$sql = "SELECT * from `ntb_notice` ORDER BY `add_date` DESC LIMIT 1";
		$result = $db->select($sql);
		$request->setAttribute("notices", $result);

		$namelist = array(
			0 => '见习店小二',
			1 => '店小二',
			6 => '伙计',
			2 => '掌柜',
			3 => '东家',
			4 => '富豪',
			5 => '大富豪',
			7 => '董事'
		);
		$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$userid}'";
		$result = $db->select($sqlcmd);
		if ($result) {
			$result[0]->uplevelname = $namelist[$result[0]->uplevel];
			$pid = $result[0]->pid;
			$sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$pid}'";
			$relation = $db->getone($sqlcmd);
			if ($relation) {
				if ($relation['wxname']) {
					$result[0]->dianpuname = $relation['wxname'];
				} else {
					$result[0]->dianpuname = $pid;
				}
			} else {
				$result[0]->dianpuname = "无";
			}

			$sqlcmd = "SELECT COUNT(*) `invite` FROM `ntb_user` WHERE `pid`='{$userid}'";
			$invite = $db->select($sqlcmd);
			if ($invite) {
				$result[0]->cn = $invite[0]->invite;
			}
			$request->setAttribute('user',$result[0]);

			$sqlcmd = "SELECT * FROM `ntb_user_benefit` WHERE `user_id`='{$userid}' AND `benefit_less`>0.1";
			$result = $db->getone($sqlcmd);
			$benefit = $result ? 1 : 0;
			$request->setAttribute('benefit',$benefit);
		}
		return View::INPUT;
	}
	
	public function dg($db,$userid){
		$count = 0;
		$sql = "select * from ntb_user where pid='$userid'";
		$rr = $db->select($sql);
		if($rr){
			$count = $count+count($rr); //第一层
			for($i=0;$i<count($rr);$i++){
					$uid = $rr[$i]->user_id;
					
					$sql = "select * from ntb_user where pid='$uid'";
					$rrr = $db->select($sql);
					
					if($rrr){
						$count = $count+count($rrr); //第二层
						
						for($j=0;$j<count($rrr);$j++){
							$uuid = $rrr[$j]->user_id;
							
							$sql = "select * from ntb_user where pid='$uuid'";
							$rrrr = $db->select($sql);
							
							if($rrrr){
								$count = $count+count($rrrr); //第三层
							}
						}
						
					}
					
					
			}
		}
		
		return $count;
		
	}
	
	
	public function diedg($db,$userid){
		$count = 0;
		$sql = "select * from ntb_user where pid='$userid'";
		$rr = $db->select($sql);
		if($rr){
			//$count = $count+count($rr); //第一层
			for($i=0;$i<count($rr);$i++){
				$uid = $rr[$i]->user_id;

				$sql = "select count(*) sam from ntb_record where type=1  and operation='$uid'";
				$rsr = $db->select($sql);
				if($rsr[0]->sam == 0){
					continue;
				}
				
				$count++;
				
				$sql = "select * from ntb_user where pid='$uid'";
				$rrr = $db->select($sql);
					
				if($rrr){
					//$count = $count+count($rrr); //第二层
	
					for($j=0;$j<count($rrr);$j++){
						$uuid = $rrr[$j]->user_id;
							
						$sql = "select count(*) sam from ntb_record where type=1  and operation='$uuid'";
						$rsr = $db->select($sql);
						if($rsr[0]->sam == 0){
							continue;
						}
						
						$count++;
						
						$sql = "select * from ntb_user where pid='$uuid'";
						$rrrr = $db->select($sql);
							
						if($rrrr){
							//$count = $count+count($rrrr); //第三层
							
							for($k=0;$k<count($rrrr);$k++){
								$uuuid = $rrrr[$k]->user_id;
								
								$sql = "select count(*) sam from ntb_record where type=1  and operation='$uuuid'";
								$rsr = $db->select($sql);
								if($rsr[0]->sam == 0){
									continue;
								}
								
								$count++;
								
							}
							
						}
					}
	
				}
					
					
			}
		}
	
		return $count;
	
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request::NONE;
	}

}

?>