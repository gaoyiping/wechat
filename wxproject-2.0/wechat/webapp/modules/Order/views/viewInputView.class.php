<?php
class viewInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("orderid",$request->getAttribute("orderid"));
		$this->setAttribute("order",$request->getAttribute("order"));
		$this->setAttribute("orderdetail",$request->getAttribute("orderdetail"));
		$this->setTemplate("view.tpl");
    }
}
?>