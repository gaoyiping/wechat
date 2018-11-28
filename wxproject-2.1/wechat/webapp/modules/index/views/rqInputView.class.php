<?php
class rqInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("Level1", $request->getAttribute("Level1"));
		$this->setAttribute("Level2", $request->getAttribute("Level2"));
		$this->setAttribute("Level3", $request->getAttribute("Level3"));
		$this->setAttribute("userlist", $request->getAttribute("userlist"));
		$this->setAttribute("uplevel", $request->getAttribute("uplevel"));
		$this->setTemplate("rq.tpl");
    }
}
?>