<?php
class IndexInputView extends SmartyView {
    public function execute() {
    	$request = $this->getContext()->getRequest();
		$this->setAttribute("type",$request->getParameter('type'));
		$this->setTemplate("index.tpl");
    }
}
?>
