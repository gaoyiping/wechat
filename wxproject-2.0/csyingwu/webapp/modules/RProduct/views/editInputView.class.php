<?php
class editInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
		$this->setAttribute('id',$request->getAttribute('id'));
		$this->setAttribute('pname', $request->getAttribute('pname'));
		$this->setAttribute('cost', $request->getAttribute('cost'));
		$this->setAttribute('detail', $request->getAttribute('detail'));
		$this->setAttribute('imgurl', $request->getAttribute('imgurl'));
		$this->setAttribute('tbtype', $request->getAttribute('tbtype'));
	    $this->setAttribute("rtype",$request->getAttribute("rtype"));
		$this->setAttribute("jifen",$request->getAttribute("jifen"));
		$this->setAttribute("zhekou",$request->getAttribute("zhekou"));
		$this->setAttribute("isdelete",$request->getAttribute("isdelete"));
		$this->setAttribute("isrec",$request->getAttribute("isrec"));
		$this->setAttribute("typeID",$request->getAttribute("typeID"));
        $this->setAttribute("qidingnum",$request->getAttribute("qidingnum"));

		$this->setAttribute('sNo', $request->getAttribute('sNo'));
		$this->setAttribute('tiaoma', $request->getAttribute('tiaoma'));
	    $this->setAttribute("danwei",$request->getAttribute("danwei"));
		$this->setAttribute("zhuanmaijia",$request->getAttribute("zhuanmaijia"));
		$this->setAttribute("qiyejia",$request->getAttribute("qiyejia"));
		$this->setAttribute("sorder",$request->getAttribute("sorder"));
        $this->setAttribute("tixingshu",$request->getAttribute("tixingshu"));
        $this->setAttribute("good_number",$request->getAttribute("good_number"));
		$this->setAttribute("jiesuanjia",$request->getAttribute("jiesuanjia"));
		$this->setAttribute("jianyijia",$request->getAttribute("jianyijia"));
		$this->setAttribute("guige",$request->getAttribute("guige"));
		$this->setAttribute("zhuangxiangshu",$request->getAttribute("zhuangxiangshu"));
		
		$this->setAttribute("lirun",$request->getAttribute("lirun"));
		
		$this->setTemplate("edit.tpl");
    }
}
?>