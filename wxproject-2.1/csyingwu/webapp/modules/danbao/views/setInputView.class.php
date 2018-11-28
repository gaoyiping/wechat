<?php
class setInputView extends SmartyView {
	
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('name', $request->getAttribute('name'));
		$this->setAttribute('userID', $request->getAttribute('userID'));
		$this->setAttribute('btype', $request->getAttribute('btype'));
		$this->setAttribute('bshuoming', $request->getAttribute('bshuoming'));
        $this->setAttribute('strstring', $request->getAttribute('strstring'));
	
        $this->setTemplate("set.tpl");
		
		
    }
}
?>