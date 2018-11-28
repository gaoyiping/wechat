<?php
class viewInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("user_id",$request->getAttribute("user_id"));
		$this->setAttribute("add_date",$request->getAttribute("add_date"));
		$this->setAttribute("user_name",$request->getAttribute("user_name"));
		$this->setAttribute("address",$request->getAttribute("address"));
		$this->setAttribute("e_mail",$request->getAttribute("e_mail"));
		$this->setAttribute("mobile",$request->getAttribute("mobile"));
		$this->setAttribute("tel",$request->getAttribute("tel"));
		$this->setTemplate("view.tpl");
    }
}
?>