<?php
class addInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("z_money",$request->getAttribute("z_money"));
		$this->setTemplate("add.tpl");

    }
}
?>