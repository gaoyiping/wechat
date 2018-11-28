<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

	public function getDefaultView() {
		
		if($_SESSION['_admin_atype']!=1 && !in_array("c1",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		$request = $this->getContext()->getRequest();


		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		
		$tiaoma = trim($request->getParameter('tiaoma'));
		$rsNo = trim($request->getParameter('rsNo'));
		$rname = $request->getParameter('rname');
		$rdanwei = $request->getParameter('rdanwei');
        $typeID= $request->getParameter('typeID');

		$rnum= $request->getParameter('rnum');
		
		
		
        

		//添加商品入库信息
		$sql = "insert into admin_cg_kucun(tiaoma,rsNo,rname,rdanwei,rnum,typeID,rdate,pubdate,pID,rtype) " .
			"values('$tiaoma','$rsNo','$rname','$rdanwei','$rnum','$typeID',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,0,1)";
		
		$r = $db->insert($sql);	
     
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，产品入库失败！');" .
				"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('产品入库成功！');" .
				"location.href='index.php?module=kucun&action=add';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>