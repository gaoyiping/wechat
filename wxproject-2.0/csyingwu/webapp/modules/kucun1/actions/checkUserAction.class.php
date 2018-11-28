<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class checkUserAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$bianhao = addslashes(trim($request->getParameter('bianhao')));
	
		$sql = "select a.*,b.tname,b.tID from ntc_rproducts a left join ntc_type b on a.id=b.tID where (a.sNo = '$bianhao' or a.tiaoma='$bianhao')";
		$r = $db->select($sql);
		
		
			if($r) {
				echo $r[0]->sNo."|".$r[0]->tiaoma."|".$r[0]->pname."|".$r[0]->danwei."|".$r[0]->tname."|".$r[0]->tID."|"; 
			} else {
				echo "no|";
			}
		

		return;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>