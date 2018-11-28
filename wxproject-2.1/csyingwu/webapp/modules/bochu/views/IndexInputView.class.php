<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('huiyuan',$request->getAttribute('huiyuan'));
			$this->setAttribute('dianpu',$request->getAttribute('dianpu'));
				$this->setAttribute('zongjin',$request->getAttribute('zongjin'));
					$this->setAttribute('yeji',$request->getAttribute('yeji'));
					$this->setAttribute('todayyeji',$request->getAttribute('todayyeji'));
        $this->setTemplate("index.tpl");
    }
}
?>