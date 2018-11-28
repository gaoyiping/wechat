<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("info", $request->getAttribute("info"));

		$this->setAttribute("Total2", $request->getAttribute("Total2"));
		$this->setAttribute("Total3", $request->getAttribute("Total3"));
		$this->setAttribute("Total4", $request->getAttribute("Total4"));
		$this->setAttribute("Total5", $request->getAttribute("Total5"));

		$this->setAttribute("Money", $request->getAttribute("Money"));
		$this->setAttribute("Paper", $request->getAttribute("Paper"));

		$this->setTemplate("index.tpl");
    }
}
?>