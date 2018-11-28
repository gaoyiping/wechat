<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("ok",$request->getAttribute("ok"));
		$this->setAttribute("startdate",$request->getAttribute("startdate"));
		$this->setAttribute("enddate",$request->getAttribute("enddate"));
		$this->setAttribute("list",$request->getAttribute("list"));
		$this->setAttribute("num",$request->getAttribute("num"));
		//$this->setAttribute("total",$request->getAttribute("total"));
		//$this->setAttribute("totalemoneys",$request->getAttribute("totalemoneys"));
		//$this->setAttribute("pageemoneys",$request->getAttribute("pageemoneys"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$pageto = $request->getAttribute("pageto");
		if($pageto != ''){
			$r = rand();
			header("Content-type: application/msexcel");
			header("Content-Disposition: attachment; filename=retaillist-$r.xls");
			$this->setTemplate("excel.tpl");
		} else {

				$this->setTemplate("yuding.tpl");
			
		}
    }
}
?>