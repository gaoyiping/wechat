<?php
class IndexInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();

		$this->setAttribute("board_no",$request->getAttribute("board_no"));
		$this->setAttribute("board1",$request->getAttribute("board1"));
		$this->setAttribute("board2",$request->getAttribute("board2"));
		$this->setAttribute("board3",$request->getAttribute("board3"));
		$this->setAttribute("board4",$request->getAttribute("board4"));
		$this->setAttribute("board5",$request->getAttribute("board5"));
		$this->setAttribute("board6",$request->getAttribute("board6"));
		$this->setAttribute("board7",$request->getAttribute("board7"));

		$this->setAttribute("board8",$request->getAttribute("board8"));
		$this->setAttribute("board9",$request->getAttribute("board9"));
		$this->setAttribute("board10",$request->getAttribute("board10"));
		$this->setAttribute("board11",$request->getAttribute("board11"));
		$this->setAttribute("board12",$request->getAttribute("board12"));
		$this->setAttribute("board13",$request->getAttribute("board13"));
		$this->setAttribute("board14",$request->getAttribute("board14"));
		$this->setAttribute("board15",$request->getAttribute("board15"));


		$this->setTemplate("index.tpl");
    }
}
?>