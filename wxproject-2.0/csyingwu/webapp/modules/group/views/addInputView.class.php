<?php
class addInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("G_CName",$request->getAttribute("G_CName"));
		$this->setAttribute("G_Level",$request->getAttribute("G_Level"));
		$this->setAttribute("GroupID",$request->getAttribute("GroupID"));
		

		
		$this->setTemplate("add.tpl");
    }
}
?>