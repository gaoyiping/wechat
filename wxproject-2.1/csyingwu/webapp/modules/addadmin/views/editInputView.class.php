<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('info',$request->getAttribute('info'));

		$this->setTemplate("edit.tpl");
    }
}
?>