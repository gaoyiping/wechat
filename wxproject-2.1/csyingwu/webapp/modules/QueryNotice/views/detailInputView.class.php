<?php
class detailInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("notice",$request->getAttribute("notice"));
		$this->setTemplate("detail.tpl");
    }
}
?>