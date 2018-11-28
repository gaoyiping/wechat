<?php
class deitInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("pinfo",$request->getAttribute("pinfo"));
		$this->setAttribute("num",$request->getAttribute("num"));
		$this->setAttribute("list",$request->getAttribute("list"));
		$this->setAttribute("diqu",$request->getAttribute("diqu"));
		$this->setAttribute("cuxiao",$request->getAttribute("cuxiao"));
	
		
				$this->setTemplate("deit.tpl");
		
    }
}
?>