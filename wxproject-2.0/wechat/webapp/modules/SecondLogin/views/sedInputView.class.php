<?php
class sedInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("error",$request->getError("error"));
		$this->setTemplate("sed.tpl");
    }
}
?>