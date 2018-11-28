<?php
class addInputView extends SmartyView {
	
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('bname', $request->getAttribute('bname'));
		$this->setAttribute('dsNo', $request->getAttribute('dsNo'));
		$this->setAttribute('btype', $request->getAttribute('btype'));
		$this->setAttribute('btel', $request->getAttribute('btel'));
	    $this->setAttribute("byinhang",$request->getAttribute("byinhang"));
		   $this->setAttribute("byhsNo",$request->getAttribute("byhsNo"));
		    $this->setAttribute("bbeizhu",$request->getAttribute("bbeizhu"));
			 $this->setAttribute("byhname",$request->getAttribute("byhname"));
			  $this->setAttribute("pid",$request->getAttribute("pid"));
	
        $this->setTemplate("add.tpl");
		
		
    }
}
?>