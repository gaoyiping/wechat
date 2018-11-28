<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("keyword", $request->getAttribute("keyword"));
		$this->setAttribute("p_node", $request->getAttribute("p_node"));
		$this->setAttribute("uplevel", $request->getAttribute("uplevel"));
		$this->setAttribute("phone", $request->getAttribute("phone"));
		$this->setAttribute("startdate",$request->getAttribute("startdate"));
		$this->setAttribute("enddate",$request->getAttribute("enddate"));
		$this->setAttribute("total",$request->getAttribute("total"));
		$this->setAttribute("a2",$request->getAttribute("a2"));
		$this->setAttribute("userlist",$request->getAttribute("userlist"));
		$this->setAttribute("pagehtml",$request->getAttribute("pagehtml"));
		$pageto = $request->getAttribute('pageto');
		if($pageto != ''){
			$r = rand();
			header("Content-type: application/msexcel;charset=utf-8");
			header("Content-Disposition: attachment;filename=userlist-$r.xls");
			$this->setTemplate("excel.tpl");
		} else {
			$this->setTemplate('index.tpl');
		}
    }
}
?>