<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("cj", $request->getAttribute("cj"));
		$this->setAttribute("jdj", $request->getAttribute("jdj"));
		$this->setAttribute("fxj", $request->getAttribute("fxj"));
		$this->setAttribute("bdj", $request->getAttribute("bdj"));
		$this->setAttribute("gwb", $request->getAttribute("gwb"));
		$this->setAttribute("sj", $request->getAttribute("sj"));
		$this->setAttribute("user", $request->getAttribute("user"));
		$this->setTemplate("index.tpl");
    }
}
?>