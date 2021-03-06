<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();	

				//查询参数
		$sqishu = addslashes(trim($request->getParameter('sqishu')));
			$user_id = addslashes(trim($request->getParameter('user_id')));
		$pingzheng = addslashes(trim($request->getParameter('pingzheng')));
		$diqu = addslashes(trim($request->getParameter('diqu')));
	
		 $pageto = $request->getParameter('pageto');

		$sql="select sNo  from  ntb_money_copy  group by sNo order by  sNo desc";
	
        $r1 = $db->select($sql);
		$qishu="";
		if($r1)
		{
			$num=0;
		  foreach($r1 as $value)
		  {
			  $num=$num+1;
			  if($sqishu!="")
			  {
				  if($sqishu==$value->sNo)
				  {
					   $qishu=$qishu."<option value='".$value->sNo."'  selected>".$value->sNo."</option>";
				  }
				  else
				  {		
				     $qishu=$qishu."<option value='".$value->sNo."'  >".$value->sNo."</option>";
				   }
			  }
			  else
			  {
				  if($num==1)
				  {
			         $qishu=$qishu."<option value='".$value->sNo."'  selected>".$value->sNo."</option>";
					 $sqishu=$value->sNo;
				  }
				  else
				  {
				      $qishu=$qishu."<option value='".$value->sNo."'  >".$value->sNo."</option>";
				  }
			  }
		  }
		}

		
		
       $condition = '';
	  

			$limit = true;
			$condition .= " and a.sNo='$sqishu' ";
		if($user_id!="")
		{
		  $condition .= " and a.userid='$user_id' ";
		} 
	
		$sql = "select count(a.id) c,sum(y_money) as zongjin   from ntb_money_copy a left join admin_cg_danbao b on a.userid=b.bloginID where 1=1  $condition";
	
    
		$r1 = $db->select($sql);	
		if($r1)
		{  
			//分页
			$total = intval($r1[0]->c);
			$zongjin= intval($r1[0]->zongjin);
			$page = intval($request->getParameter('page'));
			$pagesize = 100;
			$pager = new ShowPager($total,$pagesize,$page);
			$offset = $pager->offset;
				$url = "module=dianpudailijin&sqishu=$sqishu&user_id=$user_id";
			$pagehtml = $pager->num_link($url);
			$_SESSION['daili_url'] = "index.php?$url&page=".$pager->cur_page;
			//详情
			$sql = "select a.*,b.bname,a.b_money+a.j_money as zongjin,b.byinhangdiqu,b.byinhang,b.byhsNo,b.byhname,b.btel from ntb_money_copy a left join admin_cg_danbao b on a.userid=b.bloginID"
			." where 1=1 $condition  order by  a.sNo desc ";
			if($pageto == 'all'){
			
			$sql .= " ";
		
			} else {
				
				$sql .= " limit  $offset,$pagesize";
			
			}

			
			$r = $db->select($sql);
			//处理价格格式
	
			$request->setAttribute("user_id",$user_id);
			$request->setAttribute("zongjin",$zongjin);
		
			$request->setAttribute("rpros",$r);
			$request->setAttribute("pagehtml",$pagehtml); 
		}
		    $request->setAttribute('pageto',$pageto);
			$request->setAttribute("qishu",$qishu);

		
		return View :: INPUT;
		
	}
	



	public function execute() {

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>