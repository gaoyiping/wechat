<?php
class jdListInputView extends SmartyView {
    public function execute() {
    $request = $this->getContext()->getRequest();
		$this->setAttribute("dsNo",$request->getAttribute("dsNo"));
		$this->setAttribute("zongjin",$request->getAttribute("zongjin"));
		$this->setAttribute("user_id",$request->getAttribute("user_id"));
		$this->setAttribute("pingzheng",$request->getAttribute("pingzheng"));
		$this->setAttribute("diqu",$request->getAttribute("diqu"));
		$this->setAttribute("qishu",$request->getAttribute("qishu"));
		$this->setAttribute("eqishu",$request->getAttribute("eqishu"));
        $this->setAttribute("amounts",$request->getAttribute("amounts"));
		$this->setAttribute("diqustr",$request->getAttribute("diqustr"));
		$this->setAttribute("b4",$request->getAttribute("b4"));
		$this->setAttribute("b5",$request->getAttribute("b5"));
		$this->setAttribute("rpros",$request->getAttribute("rpros"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$pageto = $request->getAttribute('pageto');
		if($pageto != ''){
			$r = rand();
			header("Content-type: application/msexcel;charset=utf-8");
			header("Content-Disposition: attachment;filename=jiang-$r.xls");
			$this->setTemplate("jdexcel.tpl");
		} else {
			$this->setTemplate('jdlist.tpl');
		}
		//$this->setTemplate('list.tpl');
		
    }
}
?>