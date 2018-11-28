<?php
class listInputView extends SmartyView {
    public function execute() {


		$request = $this->getContext()->getRequest();
		$this->setAttribute("dsNo",$request->getAttribute("dsNo"));
		$this->setAttribute("user_id",$request->getAttribute("user_id"));
		$this->setAttribute("zongjin",$request->getAttribute("zongjin"));
		$this->setAttribute("diqu",$request->getAttribute("diqu"));
		$this->setAttribute("qishu",$request->getAttribute("qishu"));
		$this->setAttribute("bmj",$request->getAttribute("bmj"));
		$this->setAttribute("vipj",$request->getAttribute("vipj"));
		$this->setAttribute("fxj",$request->getAttribute("fxj"));
		$this->setAttribute("fhj",$request->getAttribute("fhj"));
		$this->setAttribute("lsj",$request->getAttribute("lsj"));
		$this->setAttribute("str_date",$request->getAttribute("str_date"));
		$this->setAttribute("end_date",$request->getAttribute("end_date"));
		
       
		$this->setTemplate('list.tpl');
		
    }
}
?>