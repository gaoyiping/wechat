<?php
class keywordsInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("list",$request->getAttribute("list"));
		$this->setAttribute('name',$request->getAttribute("name"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$this->setTemplate("keywords.tpl");
    }
}
?>