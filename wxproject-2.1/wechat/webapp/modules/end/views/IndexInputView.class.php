<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('userID',$request->getAttribute('userID'));
        $this->setTemplate("index.tpl");
    }
}
?>