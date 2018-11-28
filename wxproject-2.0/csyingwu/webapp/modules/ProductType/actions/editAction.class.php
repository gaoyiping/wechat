<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter("id"));
		$editable = $request->getParameter("editable");
		if ($editable == 'true') {
			$pname = trim($request->getParameter('pname'));
			$cost = trim($request->getParameter('cost'));
		   $bgcolor=trim($request->getParameter('bgcolor'));
		    $ttype=trim($request->getParameter('ttype'));
		} else {
			$sql = "select * from ntc_type where tid = '$id'";
			
			$r = $db->select($sql);
			if($r){
				$pname = $r[0]->tname;
				$cost = $r[0]->torder;
		        $bgcolor= $r[0]->bgcolor;
				$ttype= $r[0]->ttype;
			}
		}
		
		$request->setAttribute('id', $id);
		$request->setAttribute('bgcolor', $bgcolor);
		$request->setAttribute('pname', isset($pname) ? $pname : '');
		$request->setAttribute('cost', isset($cost) ? $cost : '');
			$request->setAttribute('ttype', $ttype);
		
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter('id'));
		$pname = addslashes(trim($request->getParameter('pname')));
		$cost = floatval(trim($request->getParameter('cost')));
			$bgcolor = addslashes($request->getParameter('bgcolor'));
			    $ttype=trim($request->getParameter('ttype'));
	
		//检查商品名是否重复
		$sql = "select tID from ntc_type where tname = '$pname' and tid <> '$id'";
		$r = $db->select($sql);
		if ($r) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('产品分类 {$pname} 已经存在，请选用其他名称修改！');" .
				"</script>";
			return $this->getDefaultView();
		}
		//更新商品
		$sql = "update ntc_type " .
			"set tname = '$pname',bgcolor='$bgcolor',ttype='$ttype', torder = '$cost' " .
			"where tid = '$id'";
		$r = $db->update($sql);
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，修改产品分类失败！');" .
				"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('修改产品分类成功！');" .
				"location.href='index.php?module=ProductType';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>