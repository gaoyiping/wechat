<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class psajaxAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$sheng = addslashes(trim($request->getParameter('sheng')));
		$shi = addslashes(trim($request->getParameter('shi')));
		$xian = addslashes(trim($request->getParameter('xian')));

		if($xian!=0){
			$sql = "select  *  from ntb_user a  where a.uplevel=1 and a.xian=".$xian;
			$ps = $db->select($sql);
		}else if($shi!=0){
			$sql = "select  *  from ntb_user a  where a.uplevel=2 and a.shi=".$shi;
			$ps = $db->select($sql);
		}else if($sheng!=0){
			$sql = "select  *  from ntb_user a  where a.uplevel=3 and a.sheng=".$sheng;
			$ps = $db->select($sql);
		}

	    $strID="";
		  	 
		if($ps)
		  {
          	foreach($ps as $list)
			{
				$strID.=$list->wxname.",".$list->user_id."[~]";
			}
		}
        echo  $strID;
		return;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>