<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		
		$this->setAttribute("user_id",$request->getAttribute("user_id"));
		$this->setAttribute("startdate",$request->getAttribute("startdate"));
		$this->setAttribute("enddate",$request->getAttribute("enddate"));
		
		$this->setAttribute("rpros",$request->getAttribute("rpros"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setTemplate("index.tpl");
    }
}
?>