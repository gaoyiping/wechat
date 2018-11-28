<?php
class IndexInputView extends SmartyView {
    public function execute() {
    	$request = $this->getContext()->getRequest();
		$this->setAttribute("Level2", $request->getAttribute("Level2"));
		$this->setAttribute("Level3", $request->getAttribute("Level3"));
		$this->setAttribute("Level4", $request->getAttribute("Level4"));
		$this->setAttribute("Level5", $request->getAttribute("Level5"));
		$this->setAttribute("Level2Count", $request->getAttribute("Level2Count"));
		$this->setAttribute("Level3Count", $request->getAttribute("Level3Count"));
		$this->setAttribute("Level4Count", $request->getAttribute("Level4Count"));
		$this->setAttribute("Level5Count", $request->getAttribute("Level5Count"));
		$this->setTemplate("index.tpl");
    }
}
?>
