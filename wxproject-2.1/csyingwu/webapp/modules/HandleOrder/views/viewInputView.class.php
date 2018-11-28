<?php
class viewInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("pinfo",$request->getAttribute("pinfo"));
		$this->setAttribute("num",$request->getAttribute("num"));
		$this->setAttribute("list",$request->getAttribute("list"));
	
		
		$this->setTemplate("view.tpl");
		
    }
}
?>