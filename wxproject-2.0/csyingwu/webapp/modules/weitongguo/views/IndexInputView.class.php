<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("ok",$request->getAttribute("ok"));
		$this->setAttribute("startdate",$request->getAttribute("startdate"));
		$this->setAttribute("enddate",$request->getAttribute("enddate"));
		$this->setAttribute("list",$request->getAttribute("list"));
		//$this->setAttribute("total",$request->getAttribute("total"));
		//$this->setAttribute("totalemoneys",$request->getAttribute("totalemoneys"));
		//$this->setAttribute("pageemoneys",$request->getAttribute("pageemoneys"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$pageto = $request->getAttribute("pageto");
		
				$this->setTemplate("oks.tpl");
		
    }
}
?>