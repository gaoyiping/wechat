<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$pname = trim($request->getParameter('pname'));
		$cost = trim($request->getParameter('cost'));
		$detail = $request->getParameter('detail');

		$request->setAttribute('pname', $pname);
		$request->setAttribute('cost', $cost);
		$request->setAttribute('detail', $detail);
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$pname = addslashes(trim($request->getParameter('pname')));
		$cost = floatval(trim($request->getParameter('cost')));
		$detail = addslashes($request->getParameter('detail'));
			$bgcolor = addslashes($request->getParameter('bgcolor'));
				$ttype = addslashes($request->getParameter('ttype'));
		//检查商品名是否重复
		$sql = "select 1 from ntc_type where tname = '$pname'";
		$r = $db->select($sql);
		if ($r && count($r) > 0) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('产品分类 {$pname} 已经存在，请选用其他名称！');" .
				"</script>";
			return $this->getDefaultView();
		}
		//添加商品
		$sql = "insert into ntc_type(tname,torder,tistrue,tpubdate,bgcolor,ttype) " .
			"values('$pname','$cost','0',CURRENT_TIMESTAMP,'$bgcolor','$ttype')";
		$r = $db->insert($sql);	
   
		
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，添加产品分类失败！');" .
				"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('添加产品分类成功！');" .
				"location.href='index.php?module=ProductType';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>