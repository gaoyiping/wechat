<?php

class login extends spAdmin {
	function __construct() {
		spController::__construct();
	}

	function index() {
		unset($_SESSION['UserInfo']);
		$this->display("login/index.html");
	}

	//验证登入
	function checklogin() {
		$username = $this->spArgs('username');
		$password = $this->spArgs('password');
		$admin = Model('Admin')->checklogin($username, $password);
		if ($admin) {
			$_SESSION['UserInfo'] = $admin;
			$this->jump(spUrl('main', 'index'));
		}
		$this->error('账号或密码错误，请重新输入！', spUrl('login', 'index'));
	}

	//注销登入
	function logout() {
		unset($_SESSION['UserInfo']);
		$this->jump(spUrl('login', 'index'));
	}
}