﻿<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
	
		$this->setAttribute("userlist_str",$request->getAttribute("userlist_str"));
		$this->setAttribute("userid",$request->getAttribute("userid"));
		$this->setTemplate("index.tpl");
    }
}
?>