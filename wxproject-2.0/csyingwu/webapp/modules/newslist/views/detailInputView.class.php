<?php
class detailInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("detail",$request->getAttribute("detail"));
		$this->setTemplate("detail.tpl");
    }
}
?>