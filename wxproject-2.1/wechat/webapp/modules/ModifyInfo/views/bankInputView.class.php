<?php
class bankInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("userinfo", $request->getAttribute("userinfo"));
		$this->setTemplate("bank.tpl");
    }
}
?>
