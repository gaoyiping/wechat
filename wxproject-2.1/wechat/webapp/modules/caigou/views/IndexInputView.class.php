<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("rpros",$request->getAttribute("rpros"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setAttribute("zongji",$request->getAttribute("zongji"));
        $this->setAttribute("spemoney",$request->getAttribute("spemoney"));
		
		$this->setTemplate("index.tpl");
    }
}
?>