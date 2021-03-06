<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("amounts",$request->getAttribute("amounts"));
		$this->setAttribute("list",$request->getAttribute("list"));
		$this->setAttribute("page_amounts",$request->getAttribute("page_amounts"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setAttribute("choose",$request->getAttribute("choose"));
		$this->setAttribute("emoney",$request->getAttribute("emoney"));
	    $this->setAttribute("userid",$request->getAttribute("userid"));
		$this->setAttribute("enddate",$request->getAttribute("enddate"));
		$this->setAttribute("startdate",$request->getAttribute("startdate"));
		$this->setAttribute("z_money",$request->getAttribute("z_money"));
		$this->setTemplate("index.tpl");
    }
}
?>