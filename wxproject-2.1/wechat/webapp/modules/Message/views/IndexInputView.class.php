<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("title",$request->getAttribute("title"));
		$this->setAttribute("content",$request->getAttribute("content"));
		$this->setAttribute('toid',$request->getAttribute('toid'));
		$this->setAttribute('choose',$request->getAttribute('choose'));
		$this->setAttribute('error',$request->getError('error'));
		$this->setTemplate("index.tpl");
    }
}
?>