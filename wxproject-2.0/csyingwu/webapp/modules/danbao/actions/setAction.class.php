<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class setAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();	
        $name = $request->getParameter('name');
		$userID = $request->getParameter('userID');
		$btype = $request->getParameter('btype');
		$bshuoming = $request->getParameter('bshuoming');
		
		
         
         $strstring="";
       
		 $sql="select GroupID,G_CName from admin_cg_group  where G_ParentID=0 order by GroupID"; 
		  
         $r=$db->select($sql);

         if($r)
		 {
		             if($btype==4)
			         {
						 foreach($r as $list)
						 {
							 
							   $strstring.="<li style='float:left;width:120px;'><label><input type='radio' name='bstr'" 
							   ." value='".$list->GroupID."' />".$list->G_CName."</label></li>";
						 }
                     }
					 if($btype==3)
					{
						 $strstring.=" <select id='dianputype' name='dianputype'>";
						 foreach($r as $list)
						 {
							 
							   $strstring.="";
						 }
					}
					
		 }


        $request->setAttribute('strstring', $strstring);
		$request->setAttribute('name', $name);
		$request->setAttribute('userID', $userID);
		$request->setAttribute('btype', $btype);
		$request->setAttribute('bshuoming', $bshuoming);

		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		$userid = trim($request->getParameter("id"));
		$GroupID = trim($request->getParameter("groupID"));
		$ygroupID = trim($request->getParameter("ygroupID"));
		$sgroupID = trim($request->getParameter("sgroupID"));
        $btype = $request->getParameter('btype');
		$groupname = $request->getParameter("groupname");

		$bstr1 = $request->getParameter("bstr");
		$ids_str="";
		if($bstr1!="")
		{
          $ids_str = implode(',',$bstr1);
        }
		$bstr="";
            
		$bshuoming="";
       
		if($btype==0)
		{
		   $bstr="0,".$GroupID.",0";          
	       $bshuoming= $groupname;
		}
		else if($btype==1)
		{
		  $bstr="0,".$ids_str.",0";

		  $sql1 = "select a.G_CName,(select G_CName from admin_cg_group b  where  b.GroupID=a.G_ParentID) as bname from admin_cg_group a where a.GroupID in ($bstr)";
		   $r1 = $db->select($sql1);
		   if($r1)
			{
		        $bshuoming=$r1[0]->bname."(";
				$num=0;
		        foreach ($r1 as $list)
				{
                        $num=$num+1;
						if($num==1)
					    {
						     $bshuoming.= $list->G_CName;
						}
						else
					    {
						     $bshuoming.= " | ".$list->G_CName;

						}
			      }
                $bshuoming.=")";
			}

		}
		else if($btype==2)
		{
		   $bstr="0,".$ygroupID.",0";



		   $sql1 = "select a.G_CName,(select G_CName from admin_cg_group b  where  b.GroupID=a.G_ParentID) as bname from admin_cg_group a where a.GroupID in ($bstr) ";
		   $r1 = $db->select($sql1);
		   if($r1)
			{
		      
			          $bshuoming=$r1[0]->bname."-".$r1[0]->G_CName;
			
			}
		}
		else if($btype==3)
		{
		 $bstr="0,".$ids_str.",0";

		  $sql1 = "select a.G_CName,(select G_CName from admin_cg_group b  where  b.GroupID=a.G_ParentID) as bname from admin_cg_group a where a.GroupID in ($bstr)";
		   $r1 = $db->select($sql1);
		   if($r1)
			{
		        $bshuoming=$r1[0]->bname."(";
				$num=0;
		        foreach ($r1 as $list)
				{
                        $num=$num+1;
						if($num==1)
					    {
						     $bshuoming.= $list->G_CName;
						}
						else
					    {
						     $bshuoming.= " | ".$list->G_CName;

						}
			      }
                $bshuoming.=")";
			}
		}
		else if($btype==4)
		{
		   $bstr="0,".$sgroupID.",0";

		   $sql1 = "select a.G_CName,(select G_CName from admin_cg_group b  where  b.GroupID=a.G_ParentID) as bname from admin_cg_group a where a.GroupID in ($bstr)";
		   $r1 = $db->select($sql1);
		   if($r1)
			{
		      
			         $bshuoming=$r1[0]->G_CName;
			
			}
		}
		else if($btype==5)
		{
		
		}
		else
		{
		
		}
	 

	  		//¸üÐÂ
		$sql = "update admin_cg_danbao set bstr='$bstr',bshuoming='$bshuoming',btype='$btype' ".
			   "where bloginID = '$userid'";
	   
		$r = $db->update($sql);
	
        	if($r == -1) {
					header("Content-type:text/html;charset=utf-8");
		echo "<script type='text/javascript'>" .
				"alert('Error!');" .
				"location.href='index.php?module=danbao';</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('ok!');" .
				"location.href='index.php?module=danbao';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>