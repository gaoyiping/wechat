<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class delAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();		
		$id = intval($request->getParameter('id'));
        
		$sql = "select * from  admin_cg_group where GroupID = '$id'";
		$r=$db->select($sql);

		if($r)
		{
			$sql2 = "select GroupID from  admin_cg_group where G_ParentID = '$id'";
		    $r2=$db->select($sql2);
			if($r2)
			{
			 header("Content-type:text/html;charset=utf-8");
		      echo "<script type='text/javascript'>" .
			  "alert('请先删除下级地区！');" .
			  "location.href='index.php?module=group&action=right&GroupID=$id';</script>";
			 	return;
			}


		    if($r[0]->G_Num>0)
			{
			  header("Content-type:text/html;charset=utf-8");
		      echo "<script type='text/javascript'>" .
			  "alert('该地区下已有专卖店，不能删除！');" .
			  "location.href='index.php?module=group&action=right&GroupID=$id';</script>";
			 	return;
			}
		}

		$sql = "delete from  admin_cg_group where GroupID = '$id'";
		$db->delete($sql);
		header("Content-type:text/html;charset=utf-8");
		echo "<script type='text/javascript'>" .
			"alert('删除成功！');" .
			"location.href='index.php?module=group&action=right';;window.parent.frames['leftbody'].location.reload()</script>";
		return;
	}

	public function execute(){
		return $this->getDefaultView();
	}


	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>