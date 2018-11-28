<?php
class M_Product extends spModel {
	var $pk = "id";
	var $table = "product";

	function product_get($pid) {
		$product = $this->findBy('id', $pid);
		if ($product) {
			return $product;
		}
	}
}