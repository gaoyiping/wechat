<?php
class detailInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("rpro",$request->getAttribute("rpro"));
		$this->setTemplate("detail.tpl");
    }
}
?>