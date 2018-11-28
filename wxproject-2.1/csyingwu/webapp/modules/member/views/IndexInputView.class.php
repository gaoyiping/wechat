<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("members",$request->getAttribute("members"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setTemplate("index.tpl");
    }
}
?>