<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("cfnumber",$request->getAttribute("cfnumber"));
		$this->setAttribute("username",$request->getAttribute("username"));
		$this->setAttribute("type",$request->getAttribute("type"));
		$this->setAttribute("tuanname",$request->getAttribute("tuanname"));
		$this->setAttribute("tuan",$request->getAttribute("tuan"));
		$this->setAttribute("cn",$request->getAttribute("cn"));
		$this->setAttribute("level",$request->getAttribute("level"));
		$this->setAttribute('error',$request->getError('error'));
        $this->setTemplate("index.tpl");
    }
}
?>