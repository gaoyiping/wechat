<?php
require_once (MO_CONFIG_DIR . '/db_config.php');
error_reporting(E_ERROR);
class DBAction {
	/*
	 * Auth: leilove321 Date : 2009-05-13
	 * Edit_1: fly Date : 2010-01-06
	 * 本类是用来调用数据库操作的
	 * 利用单例模式创建一个业务逻辑的实例 客户可以通过getInstance方法来得到DBAction的实例
	 * 在整个运行周期中，该实例只会被创建一次 
	 * 作为单例模式的需要，构造子方法被设置为private私有方法，不让客户端调用
	 * 作为单例模式的需要，提供DBAction类型的私有变量让getInstance方法使用作为返回
	 * 作为单例模式的需要，提供getInstance方法来为客户端得到DBAction的实例
	 */
	//属性
	public $mConnId; //连接标识

	private static $instances = null; //连接实例

	private function result_fetch(&$result) {
		if ($result) {
			$data = array();
			while ($row = mysql_fetch_assoc($result)) {
				$data[] = $row;
			}
			mysql_free_result($result);
			return $data;
		}
	}

	function gaoyiping_query($sqlcmd, $fetch = true) {
		$result = mysql_query($sqlcmd, $this->mConnId);
		if ($result) {
			if ($fetch) {
				$result = $this->result_fetch($result);
			}
			return $result;
		}
	}

	public function DBConnect() {
		$this->mConnId = mysql_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD);
		if (!$this->mConnId) {
			print " 连接数据库失败!可能是mysql数据库用户名或密码不正确!<br>";
			//DELETE BY FLY AT 2010-9-18
			//print(mysql_error()."<br>");
			//DELETE END
			return false;
		}
		mysql_select_db(MYSQL_DATABASE, $this->mConnId);
	}

	public static function getInstance() {
		if (null == self :: $instances) {
			self::$instances = new DBAction();
			self::$instances->DBConnect();
		}
		mysql_query("SET NAMES 'UTF8'", self :: $instances->mConnId);
		mysql_query("SET SESSION time_zone = '+8:00'", self :: $instances->mConnId);
		return self::$instances;
	}

	public function query($sql) {		
		$result = mysql_query($sql, $this->mConnId);
		return $result;
	}

	//查询
	public function select($sql) {
		$sql = trim($sql);
		if (empty ($sql)) {return;}
		$rs = $this->query($sql);
		if ((!$rs) || empty ($rs)) {return;}
		$data = array();
		while ($rd = mysql_fetch_object($rs)) {
			$data[] = $rd;
		}
		mysql_free_result($rs);
		return $data;
	}
	//查询返回数组
	public function selectarray($sql){
		$sql = trim($sql);
		if (empty ($sql)) {return;}
		$rs = $this->query($sql);
		if ((!$rs) || empty ($rs)) {return;}
		$data = array();
		while($row = mysql_fetch_array($rs)) {
			$data[] = $row;
		}
		mysql_free_result($rs);
		return $data;
	}
	
	// add by gaoyiping
	public function getone($sqlcmd) {
		$sqlcmd = trim($sqlcmd);
		$result = $this->gaoyiping_query($sqlcmd . ' LIMIT 1', false);
		if ($result) {
			$data = mysql_fetch_assoc($result);
			mysql_free_result($result);
			return $data;
		}
	}
	
	public function getRow($sql){
		$sql = trim($sql);
		if (empty ($sql)) {return;}
		$rs = $this->query($sql);
		if ((!$rs) || empty ($rs)) {return;}
		$data = array();
		while($row = mysql_fetch_array($rs)) {
			$data[] = $row;
		}
		mysql_free_result($rs);
		return $data[0];
	}
	//查询返回影响行
	public function selectrow($sql) {
		$sql = trim($sql);
		if (empty ($sql)) {return -1;}
		$rs = $this->query($sql);
		if ((!$rs) || empty ($rs)) {return 0;}
		$num= mysql_num_rows($rs);
		mysql_free_result($rs);
		return $num;
	}
	//插入
	// return 成功，返回执行影响行数或最后插入的ID，失败，返回-1
	public function insert($sql, $return = "affectedrows") {
		$sql = trim($sql);
		if (empty ($sql)) {return -1;}
		
		$rs = $this->query($sql);
		if ($rs == false) {return -1;}
		if (strtolower($return) == "last_insert_id") {
			return mysql_insert_id();
		} else {
			return mysql_affected_rows();
		}
	}
	//更新
	// return 成功，返回执行影响行数，失败，返回-1
	public function update($sql) {
		$sql = trim($sql);
		if (empty ($sql)) {return -1;}
	
		$rs = $this->query($sql);
		if ($rs == false) {return -1;}
		return mysql_affected_rows();
	}
	//删除
	// return 成功，返回执行影响行数，失败，返回-1
	public function delete($sql) {
		$sql = trim($sql);
		if (empty ($sql)) {return -1;}
		
		$rs = $this->query($sql);
		if ($rs == false) {return -1;}
		return mysql_affected_rows();
	}
	/* 无需使用 */
	//使用mysql扩展查询,查询结束需手工释放结果集
	public function i_query($sql) {
		$sql = trim($sql);
		if (empty ($sql)) {return false;}
		$rs = mysqli_query($this->mConnId, $sql);
		return $rs;
	}

	/*关闭连接*/
	public function close() {
		mysql_close($this->mConnId);
	}

	/* 事务处理函数 */
	public function begin() {
		return $this->query("START TRANSACTION");
	}
	public function commit() {
		return $this->query("COMMIT");
	}
	public function rollback() {
		return $this->query("ROLLBACK");
	}
	public function transaction($q_array) {
		$retval = 1;
		$this->begin();
		foreach ($q_array as $qa) {
			$result = $this->query($qa);
			if ($result == false) {
				$retval = 0;
				break;
			}
		}
		if ($retval == 0) {
			$this->rollback();
			return false;
		} else {
			$this->commit();
			return true;
		}
	}

}
?>