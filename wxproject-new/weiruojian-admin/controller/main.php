<?php
class main extends spAdmin {
	function index() {
		$this->display('frameset/index.html');
	}

	function top() {
		$this->display('frameset/top.html');
	}

	function left() {
		$this->display('frameset/left.html');
	}

	function footer() {
		$this->display('frameset/footer.html');
	}

	function home() {
		$this->display('main/index.html'); //
	}
}