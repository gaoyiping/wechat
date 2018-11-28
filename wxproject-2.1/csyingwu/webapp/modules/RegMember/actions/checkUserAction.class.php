<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class checkUserAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$userid = addslashes(trim($request->getParameter('uid')));
		$type = $request->getParameter('type');
		$sql = "select user_id from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		//
		if($type == 'pid'){
			if($r) {
				echo "推荐账号 $userid 存在 √"; 
			} else {
				echo "推荐账号 $userid 不存在 ×";
			}
		}
		if($type == 'uid'){
			if(!$r) {
				  $sql1 = "select id from ntb_user_copy where user_id = '$userid'";
		          $r1 = $db->select($sql1);
				  if($r1)
				  {
				     echo "对不起，会员账号 $userid 已存在 ×";
				  }
				  else
				  {
				     echo "恭喜你，会员账号 $userid 可以使用 √"; 
				  }
				
			} else {
				echo "对不起，会员账号 $userid 已存在 ×";
			}
		}

		if($type == 'aid'){
            	$sql = "select node_left,node_right from ntb_board_face where node = '$userid'";
		      $r = $db->select($sql);

			  $sql1 = "select count(id) as num from ntb_user_copy where anzhi = '$userid'";
		      $r1 = $db->select($sql1);
              
			  $sum=0;
			  if($r1)
			  {
			    $sum=$r1[0]->num;
			  }

			if(!$r) {
				echo "1|"; 
			} else {
				if($r[0]->node_left!="" && $r[0]->node_right!="")
				{
				   echo "2|";
				}
				else if($sum==2)
				{
				  echo "2|";
				}
				else if($r[0]->node_left=="" && $sum==0)
				{
				   echo "3|";
				}
				else
				{
				   echo "4|";
				}
				
			}
		}
		return;
	}

	public function execute(){
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>