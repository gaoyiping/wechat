<?php
class Cart {
	var $base;
	var $rpros; 

	public function __construct($userid) {
		$this->base = array(
			'userid' => $userid,
			'counts' => "0",
			'moneys' => "0.00",
			'emoneys' => "0"
		);
		$this->rpros = array();
	}
}
?>