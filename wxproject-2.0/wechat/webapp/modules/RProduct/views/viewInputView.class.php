<?php
class viewInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("rpro",$request->getAttribute("rpro"));
		$this->setTemplate("view.tpl");
    }
}
?>