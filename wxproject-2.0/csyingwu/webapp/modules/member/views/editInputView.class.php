<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('id',$request->getAttribute('id'));
		$this->setAttribute('permission',$request->getAttribute('permission'));
		$this->setTemplate("edit.tpl");
    }
}
?>