<?php
class addmenuInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("parent_menu",$request->getAttribute("parent_menu"));
		$this->setTemplate("addmenu.tpl");
    }
}
?>