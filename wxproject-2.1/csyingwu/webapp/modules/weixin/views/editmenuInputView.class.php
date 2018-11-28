<?php
class editmenuInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("cat",$request->getAttribute("cat"));
		
		$this->setAttribute("parent_menu",$request->getAttribute("parent_menu"));
		
		$this->setTemplate("editmenu.tpl");
    }
}
?>