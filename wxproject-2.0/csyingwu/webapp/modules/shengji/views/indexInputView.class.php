<?php
class indexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("list",$request->getAttribute("list"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		//2013-05-22 修改
		if($request->getAttribute("type")==3){
			$this->setTemplate("pinwei.tpl");
		}else{
        	$this->setTemplate("index.tpl");
		}
    }
}
?>