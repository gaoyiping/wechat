<?php
class addInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("cfnumber",$request->getAttribute("cfnumber"));
		$this->setAttribute("username",$request->getAttribute("username"));
		$this->setAttribute("emoney",$request->getAttribute("emoney"));
				$this->setAttribute("userid",$request->getAttribute("userid"));
		$this->setAttribute('error',$request->getError('error'));
        $this->setTemplate("add.tpl");
    }
}
?>