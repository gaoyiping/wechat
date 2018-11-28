<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();	
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$user_name = $this->getContext()->getStorage()->read('_user_name');
		
		$GroupID_1 = $this->getContext()->getStorage()->read('_GroupID_1');
		$GroupID_2 = $this->getContext()->getStorage()->read('_GroupID_2');
				$GroupID_3 = $this->getContext()->getStorage()->read('_GroupID_3');
		$dianputype = $this->getContext()->getStorage()->read('_dianputype');
		$request->setAttribute('userID',$userid);
		$request->setAttribute('user_name',$user_name);
       
		$str_tonggao="";
		$str_dingdan="";
		$str_cuxiao="";
		$db = DBAction::getInstance();

		
		$sql1 = "select a.* from ntb_user a where user_id='$userid' ";
		$r = $db->select($sql1);
		if($r)
		{
			$sql = "select * from ntb_user_ref where node='$userid'";
			$rr = $db->select($sql);
			$r[0]->pnode =$rr[0]->p_node;
			
			$dianpu = $r[0]->dianpu;
			$sql = "select * from ntb_user where user_id='$dianpu'";
			$rr = $db->select($sql);
			if($rr){
				$r[0]->dianpuname =$rr[0]->user_name;
			}
		  	$request->setAttribute('user',$r[0]);
		}


		//累计奖金
		$sql = "select z_money  " .
			" from ntb_user where user_id = '$userid'";
        $r = $db->select($sql);
		$amounts=0;
		if($r)
		{
			
			$amounts = $r[0]->z_money;
			
			
		}
        $request->setAttribute('amounts',$amounts);


		//累计提现
        $sql = "select sum(s_money) as tixianjin from ntb_money_point where userid = '$userid' ";
	    $r = $db->select($sql);
		$tixianjin=0;
		if($r)
		{
			$tixianjin = $r[0]->tixianjin;
		}
          $request->setAttribute('tixianjin',$tixianjin);
		
        //绑定公司通告
		$sql1 = "select id,left(title,16) as title,left(add_date,10) as add_date  from ntb_notice  order by add_date desc limit 4";
		$list = $db->select($sql1);
		
	       if($list)
		   {
				foreach ($list as $value) {
                  
				
				  $str_tonggao=$str_tonggao."<li style='list-style-type:none;padding-left:0px;'>".$value->add_date."&nbsp;&nbsp;&nbsp;<a href='#' onclick=\"ShowDepartID('".$value->id."');\">".$value->title."</a></li>";

				}
		   }


		    //绑定公司通告
		$sql1 = "select id,left(content,16) as content,left(add_date,10) as add_date  from ntb_message where r_user_id='$userid'  order by id desc  limit 4";
		$list1 = $db->select($sql1);
		
	       if($list1)
		   {
				foreach ($list1 as $value) {
                  
				
				  $str_cuxiao=$str_cuxiao."<li style='list-style-type:none;padding-left:0px;'>".$value->add_date."&nbsp;&nbsp;&nbsp;<a href='#' > ".$value->content."</a></li>";

				}
		   }
            
			$request->setAttribute('str_tonggao',$str_tonggao);
		
			$request->setAttribute('str_cuxiao',$str_cuxiao);
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>