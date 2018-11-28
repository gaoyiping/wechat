<?php
class M_Admin extends spModel {
	var $pk = 'id';
	var $table = 'admin_user';

	function checklogin($username, $password) {
		$password = md5(md5($password));
		$admin = $this->find(array('username'=> $username, 'password'=> $password));
		return $admin;
	}
}