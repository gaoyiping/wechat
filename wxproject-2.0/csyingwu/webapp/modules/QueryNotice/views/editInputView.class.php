<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('id',$request->getAttribute('id'));
		$this->setAttribute("content",$request->getAttribute("content"));
		$this->setAttribute("title",$request->getAttribute("title"));
		$this->setAttribute("is_true",$request->getAttribute("is_true"));
		$this->setTemplate("edit.tpl");
    }
}
?>