<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("userinfo",$request->getAttribute("userinfo"));
		$this->setAttribute("prodinfo",$request->getAttribute("prodinfo"));
		$this->setAttribute("info_ok",$request->getAttribute("info_ok"));
		$this->setAttribute("prod_ok",$request->getAttribute("prod_ok"));
		$this->setAttribute("pros",$request->getAttribute("pros"));
		$this->setAttribute('fprice',$request->getAttribute("fprice"));
        $this->setTemplate("index.tpl");
    }
}
?>