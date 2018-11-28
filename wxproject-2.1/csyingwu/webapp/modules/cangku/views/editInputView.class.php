<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('id',$request->getAttribute('id'));
		$this->setAttribute('cname', $request->getAttribute('cname'));
		$this->setAttribute('csNo', $request->getAttribute('csNo'));
		
		$this->setTemplate("edit.tpl");
    }
}
?>