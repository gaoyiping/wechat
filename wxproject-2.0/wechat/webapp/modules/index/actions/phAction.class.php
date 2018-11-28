<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class phAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');

		$db = DBAction::getInstance();
		
		//收益排名
		$sql = "select * from ntb_user where id<>1 and uplevel>0 order by e_money desc,id asc limit 0,39";
		$rr = $db->select($sql);
		
		$request->setAttribute('list',$rr);

		$ph = 0;

		$sql = "SELECT rownum from 
(SELECT @rownum:=@rownum+1 rownum, t.user_id,t.e_money From
(SELECT @rownum:=0,a.* FROM ntb_user a WHERE a.e_money>=0 and a.id<>1 ORDER BY e_money desc ) t) tt where tt.user_id='$userid'";
			$rr = $db->select($sql);
			if($rr){
				$ph =$rr[0]->rownum;
			}
		
			$request->setAttribute('ph',$ph);

		
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>