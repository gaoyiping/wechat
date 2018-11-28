<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('id',$request->getAttribute('id'));
		$this->setAttribute('pname', $request->getAttribute('pname'));
		$this->setAttribute('bgcolor', $request->getAttribute('bgcolor'));
		$this->setAttribute('ttype', $request->getAttribute('ttype'));
		
		$this->setAttribute('cost', $request->getAttribute('cost'));
		$this->setAttribute('detail', $request->getAttribute('detail'));
		$this->setTemplate("edit.tpl");
    }
}
?>