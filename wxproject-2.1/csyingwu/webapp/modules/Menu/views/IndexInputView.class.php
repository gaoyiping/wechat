<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("admin_atype",$request->getAttribute("admin_atype"));
		$this->setAttribute("admin_id",$request->getAttribute("admin_id"));
        $this->setTemplate("index.tpl");
    }
}
?>