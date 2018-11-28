<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute("ok",$request->getAttribute("ok"));
		$this->setAttribute("startdate",$request->getAttribute("startdate"));
		$this->setAttribute("enddate",$request->getAttribute("enddate"));
		$this->setAttribute("list",$request->getAttribute("list"));
		$this->setAttribute("userid",$request->getAttribute("userid"));
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
			if("1" == $request->getAttribute("ok")){
				$this->setTemplate("oks.tpl");
			}
			else if("2" == $request->getAttribute("ok")){
				$this->setTemplate("oks1.tpl");
			}
			else{
				$this->setTemplate("nots.tpl");
			}

		
		}
    }
}
?>