<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();		
		$this->setAttribute("uID",$request->getAttribute("uID"));
		//处理错误信息
		$this->setAttribute('error',$request->getError('error')); 
        $this->setTemplate("index.tpl");
    }
}

?>