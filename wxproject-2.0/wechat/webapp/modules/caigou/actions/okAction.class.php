<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');





class okAction extends Action {

	public function getDefaultView() {

		$request = $this->getContext()->getRequest();
		$idno = $request->getParameter("idno");
		$mima = $request->getParameter("mima");
        $jine = $request->getParameter("jine");
		 $pingzheng = $request->getParameter("sNo");
		
			
				$request->setAttribute('idno', $idno);
				$request->setAttribute('mima', $mima);
				$request->setAttribute('jine', $jine);
	            $request->setAttribute('pingzheng', $pingzheng);
				
		return View :: INPUT;
	}
 

	public function execute(){
	
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>