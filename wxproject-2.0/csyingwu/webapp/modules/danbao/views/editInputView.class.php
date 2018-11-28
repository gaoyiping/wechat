<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('info',$request->getAttribute('info'));
		$this->setAttribute('diqu',$request->getAttribute('diqu'));


			 
		$this->setTemplate("edit.tpl");
    }
}
?>