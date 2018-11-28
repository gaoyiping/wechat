<?php
class prosInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('list', $request->getAttribute('list'));
		$this->setAttribute('pname', $request->getAttribute('pname'));
		$this->setAttribute('pagehtml', $request->getAttribute('pagehtml'));
        $this->setTemplate("pros.tpl");
    }
}
?>