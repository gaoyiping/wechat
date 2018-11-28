<?php
class YjkhInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('casedone',$request->getAttribute('casedone'));
		$this->setAttribute('casecount',$request->getAttribute('casecount'));
		$this->setAttribute('caseday',$request->getAttribute('caseday'));
		$this->setAttribute('lastcasedone',$request->getAttribute('lastcasedone'));
		$this->setAttribute('lastcaseday',$request->getAttribute('lastcaseday'));

		$this->setAttribute('bvalue',$request->getAttribute('bvalue'));
		$this->setAttribute('bcount',$request->getAttribute('bcount'));
		$this->setAttribute('blimit',$request->getAttribute('blimit'));
		header('Content-Type: text/html;charset=utf-8');
		$this->setTemplate("yjkh.tpl");
    }
}
?>