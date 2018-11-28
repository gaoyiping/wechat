<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute("_admin_id",$request->getAttribute("_admin_id"));
		$this->setAttribute("error",$request->getError('error'));
        $this->setTemplate("index.tpl");
    }
}
?>