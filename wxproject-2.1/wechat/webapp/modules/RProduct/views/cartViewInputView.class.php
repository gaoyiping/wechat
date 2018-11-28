<?php
class cartViewInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("cart",$request->getAttribute("cart"));
		$this->setTemplate("cartView.tpl");
    }
}
?>