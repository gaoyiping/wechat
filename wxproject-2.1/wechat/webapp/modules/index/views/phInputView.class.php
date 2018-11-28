<?php
class phInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('userlist',$request->getAttribute('userlist'));
		$this->setAttribute('level',$request->getAttribute('level'));
		$this->setTemplate("ph.tpl");
    }
}
?>