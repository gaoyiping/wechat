<?php
class goodsInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('goods_info',$request->getAttribute('goods_info'));
        $this->setTemplate("goods.tpl");
    }
}
?>