<?php
class jdlistInputView extends SmartyView {
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
		$pageto = $request->getAttribute('pageto');
		$this->setTemplate('jdlist.tpl');
		
    }
}
?>