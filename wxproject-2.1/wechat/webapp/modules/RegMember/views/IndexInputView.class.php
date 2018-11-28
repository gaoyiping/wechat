<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("pid",$request->getAttribute("pid"));
		$this->setAttribute("uid",$request->getAttribute("uid"));
		$this->setAttribute("username",$request->getAttribute("username"));
		$this->setAttribute("idno",$request->getAttribute("idno"));
		$this->setAttribute("address",$request->getAttribute("address"));
		$this->setAttribute("cardname",$request->getAttribute("cardname"));
		$this->setAttribute("provcity",$request->getAttribute("provcity"));
		$this->setAttribute("cardnumber",$request->getAttribute("cardnumber"));
		$this->setAttribute("cardtype",$request->getAttribute("cardtype"));
		$this->setAttribute("tel",$request->getAttribute("tel"));
		$this->setAttribute("mobile",$request->getAttribute("mobile"));
		$this->setAttribute("email",$request->getAttribute("email"));
		$this->setAttribute("cID",$request->getAttribute("cID"));
		$this->setAttribute("usertype",$request->getAttribute("usertype"));
		
		// error 
		$this->setAttribute("error",$request->getError('error'));
        $this->setTemplate("index.tpl");
    }
}
?>