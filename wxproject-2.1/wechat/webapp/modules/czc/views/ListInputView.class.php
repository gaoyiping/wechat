<?php
class ListInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();

		$this->setAttribute("logs",$request->getAttribute("logs"));
		$this->setTemplate("list.tpl");
    }
}
?>