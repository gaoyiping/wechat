<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("dianputype",$request->getAttribute("dianputype"));
        $this->setTemplate("index.tpl");
    }
}
?>