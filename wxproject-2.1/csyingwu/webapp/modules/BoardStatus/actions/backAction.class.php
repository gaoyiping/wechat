<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class backAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$boardno = $request->getParameter('boardno');
		//更新追盘
		$this->toWho($db);
		//选择追盘
		$sql = "select * from ntb_board where id = '$boardno'";
		$r = $db->select($sql);
		if(!$r){ return ;  }
		$tos = array();
		for($i=1;$i<=15;$i++){
			$filed = 'node_'.$i;
			if($r[0]->$filed == '') { break; }
			$tos[] = "'".$r[0]->$filed."'";
		}
		//选择详情
		$tos_str = implode(',',$tos);
		$sql = "select t3.node,t3.node_left,t3.node_right,t4.p_node,t5.is_black," .
			   "if(t3.left_ref=2,'*','') left_ref,if(t3.right_ref=2,'*','') right_ref " . 
			   "from ntb_board_back t1,ntb_user t2,ntb_board_face t3," . 
			   "ntb_user_ref t4,ntb_board t5 " . 
			   "where t1.to_node in ($tos_str) and t2.user_id = t1.from_node " . 
			   "and t3.board_no = t2.board_no and t3.node = t2.user_id " . 
			   "and t4.node = t2.user_id and t5.id = t2.board_no " . 
			// EDITED BY SKS AT 2010-3-18 START
			   //"order by t5.is_black desc";
			   "order by t5.is_black desc,t5.update_time desc";
			// EDITED BY SKS AT 2010-3-18 END
		$r = $db->select($sql);
		$nodes = array();
		if($r){
			foreach($r as $value){
				$nodes[] = array('n'=>$value->node,'p'=>$value->p_node,
					'l'=>$value->node_left,'r'=>$value->node_right,
					'lr'=>$value->left_ref,'rr'=>$value->right_ref,'b'=>$value->is_black);
			}
		}
		$request->setAttribute('nodes',$nodes);
		return View :: INPUT;
	}

	//确定你追谁
	function toWho($db){
		$sql = "select from_node from ntb_board_back " .
			   "where from_node is not null and to_node is null";
		$r = $db->select($sql);
		if(!$r){ return; }
		$froms = array();
		foreach($r as $value){
			$froms[] = $value->from_node;
		}
		for($i =0;$i<count($froms);$i++){
			$from_node = $froms[$i];
			$sql = "select t1.node, t1.rt, t2.board_no, t3.is_black " . 
				   "from (" . 
				   "	select tt2.rt, tt2.node " . 
				   "	from ntb_user_ref tt1, ntb_user_ref tt2 " .
				   "	where tt1.node='$from_node' and tt2.lt<tt1.lt and tt2.rt>tt1.rt " .
				   ") t1, ntb_user t2, ntb_board t3 " . 
				   "where t2.user_id = t1.node and t3.id =  t2.board_no " . 
				   "and t3.is_black = 0 order by t1.rt limit 1";
			$r = $db->select($sql);
			//找到，更新信息，否则不予处理
			if($r){
				$to_node = $r[0]->node;
				$sql_update = "update ntb_board_back set to_node = '$to_node' " . 
					          "where from_node = '$from_node' and to_node is null";
				$db->update($sql_update);
			}
		}
		return;
	}

	public function execute() {
		
	}

	public function getRequestMethods() {
		return Request :: NONE;
	}

}
?>