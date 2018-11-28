<?php
class IndexInputView extends SmartyView{
    public function execute(){
		$request = $this->getContext()->getRequest();
		$this->setAttribute("startdate", $request->getAttribute("startdate"));
		$this->setAttribute("enddate", $request->getAttribute("enddate"));
		$this->setAttribute("userid", $request->getAttribute("userid"));
$this->setAttribute("touserid", $request->getAttribute("touserid"));
		
		$this->setAttribute("choose", $request->getAttribute("choose"));
		$this->setAttribute("list", $request->getAttribute("list"));
		$this->setAttribute("total", $request->getAttribute("total"));
		$this->setAttribute("recordemoneys", $request->getAttribute("recordemoneys"));
		$this->setAttribute("pageemoneys", $request->getAttribute("pageemoneys"));
		$this->setAttribute("pagehtml", $request->getAttribute("pagehtml"));		
		$this->setTemplate("index.tpl");
    }
}
?>