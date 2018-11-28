<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("error",$request->getError("error"));
		$this->setAttribute("type",$request->getParameter('type'));
		$this->setTemplate("index.tpl");
    }
}
?>