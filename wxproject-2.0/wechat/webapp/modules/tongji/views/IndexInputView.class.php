<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("userinfo", $request->getAttribute("userinfo"));
			$this->setAttribute("gname",$request->getAttribute("gname"));
		$this->setAttribute("jibie", $request->getAttribute("jibie"));
		$this->setTemplate("index.tpl");
    }
}
?>