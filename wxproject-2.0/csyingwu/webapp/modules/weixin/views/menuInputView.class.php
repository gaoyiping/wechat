<?php
class menuInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("system",$request->getAttribute("system"));
		$this->setTemplate("menu.tpl");
    }
}
?>