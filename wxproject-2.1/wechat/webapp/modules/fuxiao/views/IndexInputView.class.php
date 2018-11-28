<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();

		$this->setAttribute("total",$request->getAttribute("total"));
		$this->setAttribute("tyear",$request->getAttribute("tyear"));
		$this->setAttribute("fuxiaolist",$request->getAttribute("fuxiaolist"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));

		$this->setTemplate("input.tpl");
			
		
    }
}
?>