<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class printinfoAction extends Action {

	public function getDefaultView() {
		return;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$ids = $request->getParameter("ids");

			$ids_str = implode(',',$ids);
			header("Content-Type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"" .
				"location.href='index.php?module=print&ids=".$ids."';</script>";
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>