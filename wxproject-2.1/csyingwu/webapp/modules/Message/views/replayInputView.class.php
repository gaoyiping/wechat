<?php
class replayInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("msg",$request->getAttribute("msg"));
		$this->setAttribute("id",$request->getAttribute("id"));	
		$this->setTemplate("replay.tpl");	 
    }
}
?>