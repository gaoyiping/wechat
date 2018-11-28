<?php
class setInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setTemplate("set.tpl");
    }
}
?>