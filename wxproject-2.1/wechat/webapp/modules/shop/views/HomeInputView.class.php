<?php
class HomeInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('category_data',$request->getAttribute('category_data'));
		$this->setAttribute('product_data',$request->getAttribute('product_data'));
		$this->setAttribute('order',$request->getAttribute('order'));
		$this->setAttribute('user',$request->getAttribute('user'));
		$this->setAttribute('system',$request->getAttribute('system'));
		$this->setAttribute('category_data_count',$request->getAttribute('category_data_count'));
		
        $this->setTemplate("home.tpl");
    }
}
?>