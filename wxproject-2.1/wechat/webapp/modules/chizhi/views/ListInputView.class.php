<?php
class ListInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("record_list",$request->getAttribute("record_list"));
		$this->setTemplate("list.tpl");
    }
}
?>