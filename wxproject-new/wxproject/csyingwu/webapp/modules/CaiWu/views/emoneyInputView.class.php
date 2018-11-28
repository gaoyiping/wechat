<?php
class emoneyInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("userid",$request->getAttribute("userid"));
		$this->setAttribute("startdate",$request->getAttribute("startdate"));
		$this->setAttribute("enddate",$request->getAttribute("enddate"));
		$this->setAttribute("total",$request->getAttribute("total"));
		$this->setAttribute("emoneys",$request->getAttribute("emoneys"));
		$this->setAttribute("lmoneys",$request->getAttribute("lmoneys"));
		$this->setAttribute("pageemoneys",$request->getAttribute("pageemoneys"));
		$this->setAttribute("list",$request->getAttribute("list"));	
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setAttribute("type",$request->getAttribute("type"));	
		$this->setTemplate("emoney.tpl");
    }
}
?>