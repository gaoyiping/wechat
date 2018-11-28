<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("ok",$request->getAttribute("ok"));
		$this->setAttribute("startdate",$request->getAttribute("startdate"));
		$this->setAttribute("enddate",$request->getAttribute("enddate"));
		$this->setAttribute("list",$request->getAttribute("list"));
		$this->setAttribute("total",$request->getAttribute("total"));
		$this->setAttribute("amounts",$request->getAttribute("amounts"));
		$this->setAttribute("pageamounts",$request->getAttribute("pageamounts"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$pageto = $request->getAttribute("pageto");
		if($pageto != ''){
			$r = rand();
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=tixianlist-$r.xls");
			$this->setTemplate("excel.tpl");
		} else {
			if("1" == $request->getAttribute("ok")){
				$this->setTemplate("oks.tpl");
			}else{
				$this->setTemplate("nots.tpl");
			}
		}
	}
  }

?>