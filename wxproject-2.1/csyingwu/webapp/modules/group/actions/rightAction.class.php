<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');


class rightAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();	
		  $GroupID = addslashes(trim($request->getParameter('GroupID')));
		  if($GroupID=="")
		  {
		     $sql1="select a.*,(select count(GroupID) from admin_cg_group where a.GroupID=G_ParentID) as num  from admin_cg_group a where a.G_ParentID=0  "; 
                  $r = $db->select($sql1);
				  if($r)
				  {
					  
			
					  $request->setAttribute("rpros",$r);
                       $request->setAttribute("GroupID",0);
					   $request->setAttribute("G_ParentID","");
					    	$request->setAttribute('G_ChildCount',count($r));

				  }
		  }
		  else
		  {
		     $sql="select *,count(GroupID) as num from admin_cg_group where GroupID='$GroupID'  limit 0,1"; 
		  	   $r=$db->select($sql);
               if($r)
				{
				   
				    	$request->setAttribute('G_CName',$r[0]->G_CName);
						$request->setAttribute('G_ParentID',$GroupID);
					
						
						
				}


				 $sql1="select a.*,(select count(GroupID) from admin_cg_group where a.GroupID=G_ParentID) as num from admin_cg_group a where a.G_ParentID='$GroupID'  "; 
			
                  $r = $db->select($sql1); 
		          //处理价格格式
		          	$request->setAttribute('G_ChildCount',count($r));
		          $request->setAttribute("rpros",$r);
				  $request->setAttribute("GroupID",$GroupID);
		   }
	    

		return View :: INPUT;
	}

	public function execute(){		
		
	}

	
	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>