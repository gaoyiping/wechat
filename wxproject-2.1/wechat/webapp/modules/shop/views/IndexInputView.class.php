<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('goodlist',$request->getAttribute('goodlist'));
        $this->setTemplate("index.tpl");
    }
}
?>