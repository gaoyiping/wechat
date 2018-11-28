<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('id',$request->getAttribute('id'));
$this->setAttribute('bname', $request->getAttribute('bname'));
		$this->setAttribute('bsNo', $request->getAttribute('bsNo'));
		$this->setAttribute('btype', $request->getAttribute('btype'));
		$this->setAttribute('btel', $request->getAttribute('btel'));
	    $this->setAttribute("byinhang",$request->getAttribute("byinhang"));
		   $this->setAttribute("byhsNo",$request->getAttribute("byhsNo"));
		    $this->setAttribute("bbeizhu",$request->getAttribute("bbeizhu"));
			 $this->setAttribute("byhname",$request->getAttribute("byhname"));
		$this->setTemplate("edit.tpl");
    }
}
?>