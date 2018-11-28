<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$bname = trim($request->getParameter('bname'));
			$pid = trim($request->getParameter('pid'));
		$dsNo = trim($request->getParameter('dsNo'));
		$btel = $request->getParameter('btel');
		$btype = $request->getParameter('btype');
        $byinhang = $request->getParameter('byinhang');
		$byhsNo = $request->getParameter('byhsNo');
		$byhname = $request->getParameter('byhname');
		$bbeizhu = $request->getParameter('bbeizhu');
       

		$request->setAttribute('pid', $pid);
		$request->setAttribute('bname', $bname);
		$request->setAttribute('dsNo', $dsNo);
        $request->setAttribute('btel', $btel);
		$request->setAttribute('btype', $btype);
		$request->setAttribute('byinhang', $byinhang);
		$request->setAttribute('byhsNo', $byhsNo);
		$request->setAttribute('byhname', $byhname);
		$request->setAttribute('bbeizhu', $bbeizhu);

		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$uid = strtolower(addslashes(trim($request->getParameter("uid"))));
		$pid = strtolower(addslashes(trim($request->getParameter("pid"))));
		$pwd1 = md5(strtolower($request->getParameter('pwd1')));
		$byinhangdiqu = trim($request->getParameter('byinhangdiqu'));
		$bname = trim($request->getParameter('bname'));
		$dsNo = trim($request->getParameter('dsNo'));
		$btel = $request->getParameter('btel');
		$btype = $request->getParameter('btype');
        $byinhang = $request->getParameter('byinhang');
		$byhsNo = $request->getParameter('byhsNo');
		$byhname = $request->getParameter('byhname');
		$bbeizhu = $request->getParameter('bbeizhu');

		
		$bdizhi = $request->getParameter('bdizhi');
	

		$GroupID = trim($request->getParameter("groupID"));
		$ygroupID = trim($request->getParameter("ygroupID"));
		$sgroupID = trim($request->getParameter("sgroupID"));

		$groupname = $request->getParameter("groupname");

		
       

		//检查商品名是否重复
		$sql = "select 1 from admin_cg_danbao where bloginID = '$uid'";
		$r = $db->select($sql);
		if ($r) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('店铺账号 {$bname} 已存在！');" .
				"</script>";
			return $this->getDefaultView();
		}


  
        

		//添加商品
		$sql = "insert into admin_cg_danbao(bname,dsNo,btel,btype,byinhang,byhsNo,byhname,bbeizhu,bisdel,bpubdate,bloginID,bloginpwd,byinhangdiqu,z_money,"
		."bdizhi,bshengID,bshiID,bxianID,e_money,tuijiansNo) " 
		."values('$bname','$dsNo','$btel','$btype','$byinhang','$byhsNo','$byhname','$bbeizhu',0,CURRENT_TIMESTAMP,'$uid','$pwd1',"
		."'$byinhangdiqu',0,'$bdizhi','$sgroupID','$ygroupID','$GroupID',0,'$pid')";
        

		//echo $sql;
		$r = $db->insert($sql);	
     
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，添加店铺失败！');" .
				"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('添加店铺成功！');" .
				"location.href='index.php?module=danbao';</script>";
			return $this->getDefaultView();
		}
		
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>