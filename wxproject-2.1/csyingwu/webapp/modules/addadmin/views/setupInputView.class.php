<?php
class setupInputView extends SmartyView {
    public function execute() {
        $request = $this->getContext()->getRequest();
        $this->setAttribute("home",$request->getAttribute("home"));
        $this->setTemplate("setup.tpl");
    }
}
?>