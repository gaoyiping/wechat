<?php
class sendedInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("list",$request->getAttribute("list"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setAttribute("type",$request->getAttribute("type"));
		$this->setTemplate("view.tpl");
    }
}
?>