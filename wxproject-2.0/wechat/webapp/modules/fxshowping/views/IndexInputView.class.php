<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('oppwd', $request->getAttribute('oppwd'));
		$this->setAttribute('strMenu', $request->getAttribute('strMenu'));
		$this->setAttribute('spusername', $request->getAttribute('spusername'));
		$this->setAttribute('spemoney', $request->getAttribute('spemoney'));

        $this->setAttribute("pid",$request->getAttribute("pid"));
		$this->setAttribute("uid",$request->getAttribute("uid"));
		$this->setAttribute("aid",$request->getAttribute("aid"));
		$this->setAttribute("username",$request->getAttribute("username"));
		$this->setAttribute("idno",$request->getAttribute("idno"));
		$this->setAttribute("address",$request->getAttribute("address"));
		$this->setAttribute("cardname",$request->getAttribute("cardname"));
		$this->setAttribute("provcity",$request->getAttribute("provcity"));

		$this->setAttribute("tel",$request->getAttribute("tel"));
		$this->setAttribute("mobile",$request->getAttribute("mobile"));
		$this->setAttribute("email",$request->getAttribute("email"));
        		$this->setAttribute("error",$request->getError('error'));

        $this->setTemplate("index.tpl");
    }
}
?>