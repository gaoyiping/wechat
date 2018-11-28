<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("User",$request->getAttribute("User"));
		$this->setAttribute("cfnumber",$request->getAttribute("cfnumber"));
        $this->setTemplate("index.tpl");
    }
}
?>