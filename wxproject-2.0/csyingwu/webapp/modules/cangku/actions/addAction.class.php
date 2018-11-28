<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$cname = trim($request->getParameter('cname'));
		$csNo = trim($request->getParameter('csNo'));
		

		$request->setAttribute('cname', $cname);
		$request->setAttribute('csNo', $csNo);
		
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$cname = addslashes(trim($request->getParameter('cname')));
		$csNo = addslashes(trim($request->getParameter('csNo')));
		
		//检查商品名是否重复
		$sql = "select 1 from admin_cg_cangku where cname = '$cname'";
		$r = $db->select($sql);
		if ($r && count($r) > 0) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('仓库 {$pname} 已经存在，请选用其他名称！');" .
				"</script>";
			return $this->getDefaultView();
		}
		//添加商品
		$sql = "insert into admin_cg_cangku(csNO,cis_del,cbeizhu,pubdate,cName) " .
			"values('$csNo',0,'',CURRENT_TIMESTAMP,'$cname')";
		$r = $db->insert($sql);	
   
		
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，添加仓库失败！');" .
				"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('添加仓库成功！');" .
				"location.href='index.php?module=cangku';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>