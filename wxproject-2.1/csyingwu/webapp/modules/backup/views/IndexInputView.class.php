<?php
class IndexInputView extends SmartyView {
    public function execute() {
    	$request = $this->getContext()->getRequest();
    	$this->setAttribute("nodes", $request->getAttribute("nodes"));
        $this->setTemplate("index.tpl");
    }
}
?>