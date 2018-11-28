<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('c',$request->getAttribute('c'));
		$this->setAttribute('emoney',$request->getAttribute('emoney'));
		$this->setAttribute('error',$request->getError('error'));
        $this->setTemplate("index.tpl");
    }
}
?>