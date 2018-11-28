<?php
class orderInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("userinfo", $request->getAttribute("userinfo"));
		$this->setAttribute("shengs", $request->getAttribute("shengs"));
		$this->setAttribute("shis", $request->getAttribute("shis"));
		$this->setAttribute("xians", $request->getAttribute("xians"));
		$this->setAttribute("totalmoney", $request->getAttribute("totalmoney"));
		$this->setAttribute("ps", $request->getAttribute("ps"));
		$this->setAttribute("type", $request->getAttribute("type"));
        $this->setTemplate("order.tpl");
    }
}
?>