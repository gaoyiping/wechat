<?php
class IndexInputView extends SmartyView {
    public function execute() {
        $request = $this->getContext()->getRequest();
        $this->setAttribute("system",$request->getAttribute("system"));
        $this->setTemplate("index.tpl");
    }
}
?>