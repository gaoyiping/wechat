<?php
class dieInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('list',$request->getAttribute('list'));
        $this->setTemplate("die.tpl");
    }
}
?>