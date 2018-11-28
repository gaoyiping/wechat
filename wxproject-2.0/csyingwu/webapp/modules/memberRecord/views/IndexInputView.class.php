<?php
class IndexInputView extends SmartyView{
    public function execute(){
		$request = $this->getContext()->getRequest();
		$this->setAttribute("start", $request->getAttribute("start"));
		$this->setAttribute("end", $request->getAttribute("end"));
		$this->setAttribute("userid", $request->getAttribute("userid"));
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