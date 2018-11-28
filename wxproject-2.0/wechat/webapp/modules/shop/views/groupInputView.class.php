<?php
class groupInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('goods',$request->getAttribute('goods'));
        $this->setTemplate("group.tpl");
    }
}
?>