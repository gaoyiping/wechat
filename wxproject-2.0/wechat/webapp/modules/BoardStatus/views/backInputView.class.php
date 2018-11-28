<?php
class backInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("nodes",$request->getAttribute("nodes"));
		$this->setTemplate("back.tpl");
    }
}
?>