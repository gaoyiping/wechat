<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("start",$request->getAttribute("start"));
		$this->setAttribute("end",$request->getAttribute("end"));
		$this->setAttribute("directlist",$request->getAttribute("directlist"));
		$this->setAttribute("totals",$request->getAttribute("totals"));
		$this->setAttribute("weeks",$request->getAttribute("weeks"));
		$this->setAttribute("months",$request->getAttribute("months"));
		$this->setAttribute("datebar",$request->getAttribute("datebar"));
		$this->setAttribute("retails",$request->getAttribute("retails"));
		$this->setTemplate("index.tpl");
    }
}
?>