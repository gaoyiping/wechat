<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("info", $request->getAttribute("info"));

		$this->setTemplate("index.tpl");
    }
}
?>