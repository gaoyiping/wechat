<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("cart",$request->getAttribute("cart"));
		$this->setAttribute("express",$request->getAttribute("express"));
		$this->setTemplate("index.tpl");
    }
}
?>