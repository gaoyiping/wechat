<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter("id"));
		$editable = $request->getParameter("editable");
		if ($editable == 'true') {
			$cname = addslashes(trim($request->getParameter('cname')));
		    $csNo = addslashes(trim($request->getParameter('csNo')));
		
		
		} else {
			$sql = "select * from admin_cg_cangku where cid = '$id'";
			
			$r = $db->select($sql);
			if($r){
				$cname = $r[0]->cName;
				$csNo = $r[0]->csNO;
		
			}
		}
		
		$request->setAttribute('id', $id);
		$request->setAttribute('cname', isset($cname) ? $cname : '');
		$request->setAttribute('csNo', isset($csNo) ? $csNo : '');
		
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter('id'));
		$cname = addslashes(trim($request->getParameter('cname')));
		    $csNo = addslashes(trim($request->getParameter('csNo')));
	
		//检查商品名是否重复
		$sql = "select 1 from admin_cg_cangku where cName = '$cname' and cID <> '$id'";
		$r = $db->select($sql);
		if ($r && count($r) > 0) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('仓库 {$pname} 已经存在，请选用其他名称修改！');" .
				"</script>";
			return $this->getDefaultView();
		}
		//更新商品
		$sql = "update admin_cg_cangku " .
			"set cName = '$cname', csNo = '$csNo' " .
			"where cID = '$id'";
		$r = $db->update($sql);
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，修改仓库信息失败！');" .
				"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('修改仓库信息成功！');" .
				"location.href='index.php?module=cangku';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>