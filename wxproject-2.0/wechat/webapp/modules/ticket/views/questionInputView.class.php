<?php
class questionInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('img',$request->getAttribute('img'));
        $this->setTemplate("question.tpl");
    }
}
?>