<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('userID',$request->getAttribute('userID'));
		$this->setAttribute("gname",$request->getAttribute("gname"));
		$this->setAttribute("dianputype",$request->getAttribute("dianputype"));
        $this->setTemplate("index.tpl");
    }
}
?>