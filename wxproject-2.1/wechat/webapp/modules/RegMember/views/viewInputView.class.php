<?php
class viewInputView extends SmartyView{
    public function execute(){
		$request = $this->getContext()->getRequest();
		$this->setAttribute('shengjistr',$request->getAttribute('shengjistr'));
		$this->setAttribute('userinfo',$request->getAttribute('userinfo'));
		$this->setAttribute('list',$request->getAttribute('list'));
	

		$this->setTemplate('view.tpl');

    }
}
?>