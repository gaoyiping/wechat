<?php
class userpoint extends spMagic {
	function index(){
		$uid = $this->get_uid();
		$user = $this->get_user($uid);
		$user['point_ddjf'] += Model('RecordPoint')->get_ddjf($uid);
		$user['point_xifen'] += Model('RecordPoint')->get_xifen($uid);
		$this->user = $user;
		$this->display("userpoint-index.html");
	}

	function history() {
		$uid = $this->get_uid();
		$recordlist = Model('RecordPoint')->findAll("`rid`={$uid}", "`record_time` DESC", '*', 100);
		$this->recordlist = $recordlist;
		$this->display('userpoint-history.html');
	}

	function detail() {
		$this->display("userpoint-detail.html");
	}
}