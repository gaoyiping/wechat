<?php

class spAdmin extends spController {
	public function __construct() {
		spController::__construct();
		if ($_SESSION['UserInfo'] ?? 0) {
			return;
		}
		$this->jump(spUrl('login', 'index'));
	}
}