<?php
class modifyInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("userinfo", $request->getAttribute("userinfo"));
		$this->setAttribute("userid", $request->getAttribute("userid"));
		$this->setAttribute("jjkghtml", $request->getAttribute("jjkghtml"));
		$this->setTemplate('modify.tpl');
    }
}
?>