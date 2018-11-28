<?php
class listInputView extends SmartyView {
    public function execute() {


		$request = $this->getContext()->getRequest();
		$this->setAttribute("dsNo",$request->getAttribute("dsNo"));
		$this->setAttribute("zongjin",$request->getAttribute("zongjin"));
		$this->setAttribute("user_id",$request->getAttribute("user_id"));
		$this->setAttribute("pingzheng",$request->getAttribute("pingzheng"));
		$this->setAttribute("diqu",$request->getAttribute("diqu"));
		$this->setAttribute("qishu",$request->getAttribute("qishu"));
        $this->setAttribute("amounts",$request->getAttribute("amounts"));
		$this->setAttribute("diqustr",$request->getAttribute("diqustr"));
		$this->setAttribute("total",$request->getAttribute("total"));
		$this->setAttribute("rpros",$request->getAttribute("rpros"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setAttribute("m",$request->getAttribute("m"));
		$this->setAttribute("type",$request->getAttribute("type"));
		$this->setAttribute("startdate",$request->getAttribute("startdate"));
		$this->setAttribute("enddate",$request->getAttribute("enddate"));
		$pageto = $request->getAttribute('pageto');
		$this->setAttribute("type",$request->getAttribute("type"));
		$this->setAttribute("cj",$request->getAttribute("cj"));
		$this->setAttribute("jdj",$request->getAttribute("jdj"));
		$this->setAttribute("fxj",$request->getAttribute("fxj"));
		$this->setAttribute("bdj",$request->getAttribute("bdj"));
		$this->setAttribute("lyj",$request->getAttribute("lyj"));
		$this->setAttribute("cfj",$request->getAttribute("cfj"));
		$this->setAttribute("fhj",$request->getAttribute("fhj"));
		$this->setAttribute("xfb",$request->getAttribute("xfb"));
		
		
		
		$this->setTemplate('list.tpl');
		
    }
}
?>