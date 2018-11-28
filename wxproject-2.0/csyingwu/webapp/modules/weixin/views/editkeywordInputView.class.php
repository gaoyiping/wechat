<?php
class editkeywordInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("system",$request->getAttribute("system"));
		$this->setTemplate("editkeyword.tpl");
    }
}
?>