<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class tellistAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		//查询
		$sql = "select distinct mobile from ntb_user " .
			"where mobile regexp '^1[358][0-9][0-9]{8}$' and mobile not like '%00000%'";
		$result = $db->select($sql);
		if($result){			
			header('Content-Type: application/octet-stream;charset=utf-8');
			header('Content-Disposition: attachment;filename=tellists.txt');
			$length = count($result);
			for($i=0;$i<$length;$i++){
				echo $result[$i]->mobile . "\r\n";
			}
			exit;
		} else {
			header('Content-Type: text/html;charset=utf-8');
			echo "没有合适的数据！";
		}
		return ;
	}

	public function execute() {
		
	}

	public function getRequestMethods() {
		return Request :: NONE;
	}

}

?>