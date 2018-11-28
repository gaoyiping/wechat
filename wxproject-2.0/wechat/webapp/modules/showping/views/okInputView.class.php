<?php
class okInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
			$this->setAttribute('idno', $request->getAttribute('idno'));
		$this->setAttribute('jine', $request->getAttribute('jine'));
		$this->setAttribute('jifen', $request->getAttribute('jifen'));
		$this->setAttribute('mima', $request->getAttribute('mima'));
	$this->setAttribute('pingzheng', $request->getAttribute('pingzheng'));
	$this->setAttribute('oppwd', $request->getAttribute('oppwd'));
        $this->setTemplate("ok.tpl");
    }
}
?>