<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class GetAction extends Action {

	public function getDefaultView() {
		return View :: INPUT;
	}

	public function execute(){
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>