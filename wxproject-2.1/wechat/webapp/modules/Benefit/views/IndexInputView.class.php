<?php
class IndexInputView extends SmartyView {
	public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('benefit', $request->getAttribute('benefit'));
		$this->setTemplate("index.tpl");
	}
}