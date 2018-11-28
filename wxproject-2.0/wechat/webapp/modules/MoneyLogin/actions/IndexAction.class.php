<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/job/MonthJob.class.php');
require_once(MO_LIB_DIR . '/job/DaliyJob.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$day = date('d');
		$hour = date('H');
		//执行计划任务
		//天计划：天0-5点
		//月计划：月1-5号，天0-5点	
//DELETE BY fly at 2010-02-05 13:43:50
/*
		if( ($day >= 1 && $day <= 5 ) && 
				($hour >= 0 && $hour <= 5) ) {
			monthOrgList($db);
		}
*/
//DELETE END
		if( $hour >= 0 && $hour <= 5 ) {
			daliyLevelUp($db);
		}			
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>