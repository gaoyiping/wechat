<?php
class txInputView extends SmartyView {
    public function execute() {


		$request = $this->getContext()->getRequest();
		
		$this->setAttribute("user_id",$request->getAttribute("user_id"));
		$this->setAttribute("total",$request->getAttribute("total"));
		$this->setAttribute("rpros",$request->getAttribute("rpros"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		
		$pageto = $request->getAttribute('pageto');
		
		
		$this->setTemplate('tx.tpl');
		
    }
}
?>