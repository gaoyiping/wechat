<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute('userID',$request->getAttribute('userID'));
		$this->setAttribute('user_name',$request->getAttribute('user_name'));
        $this->setAttribute('str_tonggao',$request->getAttribute('str_tonggao'));
		 $this->setAttribute('user',$request->getAttribute('user'));
		 $this->setAttribute('str_cuxiao',$request->getAttribute('str_cuxiao'));
		$this->setAttribute('amounts',$request->getAttribute('amounts'));
		$this->setAttribute('tixianjin',$request->getAttribute('tixianjin'));
        $this->setTemplate("index.tpl");
    }
}
?>