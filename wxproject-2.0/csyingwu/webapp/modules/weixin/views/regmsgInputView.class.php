<?php
class regmsgInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("system",$request->getAttribute("system"));
		$this->setTemplate("regmsg.tpl");
    }
}
?>