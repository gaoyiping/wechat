<?php
class groupInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("userinfo", $request->getAttribute("userinfo"));
		$this->setAttribute("totalmoney", $request->getAttribute("totalmoney"));
        $this->setTemplate("group.tpl");
    }
}
?>