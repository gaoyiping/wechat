<?php
class rightInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("G_CName",$request->getAttribute("G_CName"));
		$this->setAttribute("GroupID",$request->getAttribute("GroupID"));
$this->setAttribute("G_ParentID",$request->getAttribute("G_ParentID"));
		
		$this->setAttribute("G_ChildCount",$request->getAttribute("G_ChildCount"));
		$this->setAttribute("num",$request->getAttribute("num"));
		$this->setAttribute("rpros",$request->getAttribute("rpros"));

		
		$this->setTemplate("right.tpl");
    }
}
?>