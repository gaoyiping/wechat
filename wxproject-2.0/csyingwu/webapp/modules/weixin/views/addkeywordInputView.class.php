<?php
class addkeywordInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setTemplate("addkeyword.tpl");
    }
}
?>