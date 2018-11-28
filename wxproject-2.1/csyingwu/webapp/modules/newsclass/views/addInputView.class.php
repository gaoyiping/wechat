<?php
class addInputView extends SmartyView {
	
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("name_class",$request->getAttribute("name_class"));
        $this->setAttribute("sort",$request->getAttribute("sort"));
        $this->setTemplate("add.tpl");
		
		
    }
}
?>