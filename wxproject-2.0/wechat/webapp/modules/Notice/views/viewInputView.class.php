<?php
class viewInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("content",$request->getAttribute("content"));
		$this->setAttribute("title",$request->getAttribute("title"));
		$this->setTemplate("view.tpl");
    }
}
?>