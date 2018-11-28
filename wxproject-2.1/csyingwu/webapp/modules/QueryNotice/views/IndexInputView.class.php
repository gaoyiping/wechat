<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("notices",$request->getAttribute("notices"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setTemplate("index.tpl");
    }
}
?>