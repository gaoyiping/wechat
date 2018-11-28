<?php
class addInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('pname', $request->getAttribute('pname'));
		$this->setAttribute('cost', $request->getAttribute('cost'));
		$this->setAttribute('detail', $request->getAttribute('detail'));
        $this->setTemplate("add.tpl");
    }
}
?>