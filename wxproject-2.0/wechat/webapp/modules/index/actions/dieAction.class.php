<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class dieAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		
		$db = DBAction::getInstance();
		
		
		
		$request->setAttribute('list',$this->diedg($db,$userid));
		


		
		return View :: INPUT;
	}

	public function execute(){		
		
	}
	
	
	public function diedg($db,$userid){
		$arr = array();
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
				$arr[] = $rr[$i];
				
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
						$arr[] = $rrr[$j];
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
								
								$arr[] = $rrrr[$k];
								
							}
							
						}
					}
	
				}
					
					
			}
		}
	
		return $arr;
	
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>