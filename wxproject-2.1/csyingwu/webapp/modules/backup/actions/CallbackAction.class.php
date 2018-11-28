<?php
require_once(MO_CONFIG_DIR . '/db_config.php');
class CallbackAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		header("Content-type:text/html;charset=utf-8");
		//配置信息
		$cfg_dbhost = MYSQL_SERVER;
		$cfg_dbname = MYSQL_DATABASE;
		$cfg_dbuser = MYSQL_USER;
		$cfg_dbpwd = MYSQL_PASSWORD;
		$cfg_db_language = 'utf8';
		$to_file_name = "../upfile/data/".$request->getParameter('file');
		$to_file_name = realpath($to_file_name);
		mysql_connect($cfg_dbhost, $cfg_dbuser, $cfg_dbpwd) or die("不能连接数据库 $cfg_dbhost");//连接数据库
		mysql_select_db($cfg_dbname) or die ("不能打开数据库 $cfg_dbname");//打开数据库
		mysql_query("SET NAMES UTF8");
		$this->restore($to_file_name); //执行MySQL恢复命令
		mysql_close();
		// END 配置
		
		
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

	public function restore($fname)
	{
		if (file_exists($fname)) {
			//echo "还原开始，请不要关闭当前页面...";
			$sql_value="";
			$cg=0;
			$sb=0;
			$sqls=file($fname);
			foreach($sqls as $sql)
			{
				$sql_value.=$sql;
			}
			$a=explode(";\r\n", $sql_value);  //根据";\r\n"条件对数据库中分条执行
			$total=count($a)-1;
			for ($i=0;$i<$total;$i++)
			{
			//执行命令
			if(mysql_query($a[$i]))
				{
					$cg+=1;
				}
					else
					{
					$sb+=1;
					$sb_command[$sb]=$a[$i];
					}
					}
						echo "操作完毕，共处理 $total 条命令，成功 $cg 条，失败 $sb 条";
						//显示错误信息
						if ($sb>0)
							{
								echo "<hr><br><br>失败命令如下：<br>";
								for ($ii=1;$ii<=$sb;$ii++)
								{
								echo "<p><b>第 ".$ii." 条命令（内容如下）：</b>
								<br>".$sb_command[$ii]."</p><br>";
		}
		}            //-------------------
		}else{
			echo "MySQL备份文件不存在，请检查文件路径是否正确！";
        }
    }
    
}

?>