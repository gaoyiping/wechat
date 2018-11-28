<?php
class IndexInputView extends SmartyView {
    public function execute() {
			$request = $this->getContext()->getRequest();		
		$this->setAttribute("userid",$request->getAttribute("userid"));
			$this->setAttribute("choose",$request->getAttribute("choose"));
		$this->setAttribute("list",$request->getAttribute("list"));
		$this->setAttribute("kaituo_amounts",$request->getAttribute("kaituo_amounts"));
		$this->setAttribute("fenhong_amounts",$request->getAttribute("fenhong_amounts"));
		$this->setAttribute("jintie_amounts",$request->getAttribute("jintie_amounts"));
		$this->setAttribute("koushui_amounts",$request->getAttribute("koushui_amounts"));
		$this->setAttribute("lingdao_amounts",$request->getAttribute("lingdao_amounts"));
		$this->setAttribute("amounts",$request->getAttribute("amounts"));
				$this->setAttribute("amounts1",$request->getAttribute("amounts1"));
		$this->setAttribute("orgamounts",$request->getAttribute("orgamounts"));
 		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
				$this->setAttribute("enddate",$request->getAttribute("enddate"));
						$this->setAttribute("startdate",$request->getAttribute("startdate"));
        $this->setTemplate("index.tpl");
	}
}
?>