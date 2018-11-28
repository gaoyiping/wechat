<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("money", $request->getAttribute("money"));
		$this->setAttribute("jidukaishi", $request->getAttribute("jidukaishi"));
		$this->setAttribute("jidujieshu", $request->getAttribute("jidujieshu"));
		$this->setAttribute("xumoney", $request->getAttribute("xumoney"));

		$this->setTemplate("index.tpl");
    }
}
?>