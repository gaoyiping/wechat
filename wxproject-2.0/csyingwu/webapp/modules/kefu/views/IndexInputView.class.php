<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("kefu",$request->getAttribute("kefu"));
        $this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setTemplate("index.tpl");
    }
}
?>
