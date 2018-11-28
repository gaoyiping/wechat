<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
        $this->setAttribute('id',$request->getAttribute('id'));
        $this->setAttribute('tag_name', $request->getAttribute('tag_name'));
        $this->setAttribute('tagURL', $request->getAttribute('tagURL'));
        $this->setAttribute('sort', $request->getAttribute('sort'));

		$this->setTemplate("edit.tpl");
    }
}
?>