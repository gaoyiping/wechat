<?php
class IndexInputView extends SmartyView {
    public function execute() {
    	$request = $this->getContext()->getRequest();
    	$this->setAttribute("total", $request->getAttribute("total"));
    	$this->setAttribute("benefitlist", $request->getAttribute("benefitlist"));
        $this->setTemplate("index.tpl");
    }
}