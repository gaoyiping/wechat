<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
        $this->setAttribute('kid',$request->getAttribute('kid'));
        $this->setAttribute('kefu_name', $request->getAttribute('kefu_name'));
        $this->setAttribute('kefu_num', $request->getAttribute('kefu_num'));

		$this->setTemplate("edit.tpl");
    }
}
?>