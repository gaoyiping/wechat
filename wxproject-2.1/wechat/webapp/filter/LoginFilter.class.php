<?php

class LoginFilter extends Filter {

	public $effect;
	public $candirect = array("Default","Login","ticket","shop") ;

    public function execute ($filterChain) {
		if($this->effect == false){
			$filterChain->execute();
			return;
		}

		//取得第一个访问模块的名称
		$controller = $this->getContext()->getController();
		$actionstack = $controller->getActionStack();
		$first = $actionstack->getFirstEntry();
		$firstmodule = $first->getModuleName();

		if(in_array($firstmodule,$this->candirect)){
			$filterChain->execute();
		} else {
			if($this->getContext()->getUser()->isAuthenticated()){
				$filterChain->execute();
			} else {	
				$controller->redirect("index.php?module=Login");
			}
		}
		return;
	}

    public function initialize ($context, $params = null) {

		if($params['effect']){
			$this->effect = true;
		} else {
			$this->effect = false;
		}

		// initialize parent
		parent::initialize($context, $params);

		return true;

    }

}

?>