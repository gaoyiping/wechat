<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');





class okAction extends Action {

	public function getDefaultView() {

		$request = $this->getContext()->getRequest();
		$idno = $request->getParameter("idno");
		$mima = $request->getParameter("mima");
        $jine = $request->getParameter("jine");
        $jifen = $request->getParameter("jifen");
         $location = $request->getParameter("location");
		 if($location=="oppwd")
		 {
		     $request->setAttribute('oppwd', "&location=oppwd");
		 }
		 else
		{
		   $request->setAttribute('oppwd', "");
		 }

		
		 $pingzheng = $request->getParameter("pingzheng");
		
			
				$request->setAttribute('idno', $idno);
					$request->setAttribute('jifen', $jifen);
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