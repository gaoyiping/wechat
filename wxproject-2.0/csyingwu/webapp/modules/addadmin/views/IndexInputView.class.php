<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("admin_list",$request->getAttribute("admin_list"));
        $this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setTemplate("index.tpl");
    }
}
?>
