<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('ctypes',$request->getAttribute('ctypes'));
        $this->setAttribute('ctype',$request->getAttribute('ctype'));
        $this->setAttribute('id',$request->getAttribute('id'));
        $this->setAttribute('news_title',$request->getAttribute('news_title'));
        $this->setAttribute('sort',$request->getAttribute('sort'));
        $this->setAttribute('content',$request->getAttribute('content'));



			 
		$this->setTemplate("edit.tpl");
    }
}
?>