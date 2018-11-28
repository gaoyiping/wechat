<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("userinfo", $request->getAttribute("userinfo"));
		$this->setAttribute("shengs", $request->getAttribute("shengs"));
		$this->setAttribute("shis", $request->getAttribute("shis"));
		$this->setAttribute("xians", $request->getAttribute("xians"));
		$this->setTemplate("index.tpl");
    }
}
?>
