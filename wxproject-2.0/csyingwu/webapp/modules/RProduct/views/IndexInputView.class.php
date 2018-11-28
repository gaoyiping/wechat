<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
			$this->setAttribute("isdelete",$request->getAttribute("isdelete"));
				$this->setAttribute("keyword",$request->getAttribute("keyword"));
		$this->setAttribute("rpros",$request->getAttribute("rpros"));
		$this->setAttribute("types",$request->getAttribute("types"));
		$this->setAttribute("type",$request->getAttribute("type"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setTemplate("index.tpl");
    }
}
?>