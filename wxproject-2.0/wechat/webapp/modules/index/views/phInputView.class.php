<?php
class phInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('list',$request->getAttribute('list'));
		$this->setAttribute('ph',$request->getAttribute('ph'));
		$this->setTemplate("ph.tpl");
    }
}
?>