<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('goods_list',$request->getAttribute('goods_list'));
		$this->setAttribute('total',$request->getAttribute('total'));
		$this->setAttribute('totalmoney',$request->getAttribute('totalmoney'));
		$this->setAttribute('userinfo',$request->getAttribute('userinfo'));
		$this->setAttribute('type',$request->getAttribute('type'));
        $this->setTemplate("index.tpl");
    }
}
?>