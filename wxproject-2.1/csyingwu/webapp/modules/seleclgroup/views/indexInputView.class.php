﻿<?php
class indexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
	$this->setAttribute("userlist_str",$request->getAttribute("userlist_str"));
		$this->setTemplate("index.tpl");
    }
}
?>