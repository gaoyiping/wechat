<?php
class ok2InputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("pinfo",$request->getAttribute("pinfo"));
		$this->setAttribute("list",$request->getAttribute("list"));
	
		
				$this->setTemplate("ok2.tpl");
		
    }
}
?>