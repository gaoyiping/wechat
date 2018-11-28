<?php
class addInputView extends SmartyView {
	
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("admin_id",$request->getAttribute("admin_id"));
        $this->setAttribute("first_pwd",$request->getAttribute("first_pwd"));
        $this->setTemplate("add.tpl");
		
		
    }
}
?>