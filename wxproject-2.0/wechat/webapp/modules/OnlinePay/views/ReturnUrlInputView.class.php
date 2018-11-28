<?php
class ReturnUrlInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('c',$request->getAttribute('c'));
		$this->setAttribute('error',$request->getError('error'));
        $this->setTemplate("index.tpl");
    }
}
?>