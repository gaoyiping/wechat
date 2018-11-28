<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter("id"));
		$editable = $request->getParameter("editable");
		if ($editable == 'true') {
		$bname = trim($request->getParameter('bname'));
		$dsNo = trim($request->getParameter('dsNo'));
		$btel = $request->getParameter('btel');
		$btype = $request->getParameter('btype');
        $byinhang = $request->getParameter('byinhang');
		$byhsNo = $request->getParameter('byhsNo');
		$byhname = $request->getParameter('byhname');
		$bbeizhu = $request->getParameter('bbeizhu');
			$byinhangdiqu = $request->getParameter('byinhangdiqu');
					
		} else {
			$sql = "select * from admin_cg_danbao where bID = '$id'";
			$r = $db->select($sql);
			if($r){
				$request->setAttribute('info', $r[0]);

				 //获得省市县ID
			 $diqusql=" select a.GroupID as xianID,a.G_CName as xianname ,(select GroupID from  admin_cg_group where GroupID=a.G_ParentID) as shiID ,"
			 ." (select G_CName from  admin_cg_group where GroupID=a.G_ParentID) as shiname,"
			 ." (select  (select GroupID from  admin_cg_group where GroupID=b.G_ParentID) as GroupID from "
			 ." admin_cg_group b where b.GroupID=a.G_ParentID) as shengID ,"
			 ." (select  (select G_CName from  admin_cg_group where GroupID=b.G_ParentID) as GroupID from  admin_cg_group b where b.GroupID=a.G_ParentID)"
			 ." as shengname  from admin_cg_group  a where GroupID=".$r[0]->bxianID;
             $r_diqu = $db->select($diqusql);
			 
              if($r_diqu)
			  {
			      $request->setAttribute('diqu',$r_diqu[0]);
				

			  }


				
				
			}
		}
		

	

	   
		
			
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter('id'));
		$bname = trim($request->getParameter('bname'));
		$dsNo = trim($request->getParameter('dsNo'));
		$btel = $request->getParameter('btel');
		$btype = $request->getParameter('btype');
        $byinhang = $request->getParameter('byinhang');
		$byhsNo = $request->getParameter('byhsNo');
		$byhname = $request->getParameter('byhname');
		$bbeizhu = $request->getParameter('bbeizhu');
		$byinhangdiqu = $request->getParameter('byinhangdiqu');



		$bdizhi = $request->getParameter('bdizhi');

		

		$GroupID = trim($request->getParameter("groupID"));
		$ygroupID = trim($request->getParameter("ygroupID"));
		$sgroupID = trim($request->getParameter("sgroupID"));
       
        
	

		//更新商品
		$sql = "update admin_cg_danbao " .
			"set bname = '$bname', dsNo = '$dsNo', btel = '$btel'  ,byinhang='$byinhang', byhsNo='$byhsNo',byhname='$byhname',bbeizhu='$bbeizhu',byinhangdiqu='$byinhangdiqu' " 
		   .",bdizhi='$bdizhi', bxianID='$GroupID',bshiID='$ygroupID',bshengID='$sgroupID' "
			."where bID = '$id'";
		
		$r = $db->update($sql);

		if($r == -1) {
		echo "<script type='text/javascript'>" .
				"alert('修改店铺信息失败！');" .
				"location.href='index.php?module=danbao';</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('修改店铺信息成功！');" .
				"location.href='index.php?module=danbao';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>