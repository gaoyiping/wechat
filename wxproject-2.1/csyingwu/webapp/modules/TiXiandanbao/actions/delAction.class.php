<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class delAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id =$request->getParameter("id");
			$sql = "select * from ntb_record where id ='$id'";
				$r= $db->select($sql);
				if($r)
		        {
				  $request->setAttribute('info',$r[0]);
				}
			return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
				$request = $this->getContext()->getRequest();	
			
				$id =$request->getParameter("id");
				$money =$request->getParameter("money");
				$shouxufei =$request->getParameter("shouxufei");
				$userid =$request->getParameter("userid");
					$content =$request->getParameter("content");
                $s=0;
					$rollback = false;
				$db->begin();
				do{
						$sql = "delete from ntb_record where id ='$id'";
						$r= $db->delete($sql);
					if($r == -1){$rollback = true; $s=1;break;}

						$sql = "update  admin_cg_danbao set bemoney= bemoney+ ".$money." where bloginID ='$userid'";
                       
						
						$r= $db->update($sql);
						if($r == -1){$rollback = true; $s=2;break;}


						//插入留言
					$sql = "insert into ntb_message(user_id,title,content,add_date,r_user_id,isdu) " .
						   "values('admin','','$content',CURRENT_TIMESTAMP,'$userid',0)";
						 $r = $db->insert($sql);
						if($r == -1){$rollback = true; $s=3;break;}

				}while(false);
	           	if($rollback){
			        $db->rollback();
					header("Content-Type:text/html;charset=utf-8");
					echo "<script type='text/javascript'>" .
						"alert('未知原因，".$s."操作失败！');" .
						"window.parent.hidePopWin(true);</script>";
				}else{
						$db->commit();
					header("Content-Type:text/html;charset=utf-8");
					echo "<script type='text/javascript'>" .
						"alert('操作成功！');" .
						"window.parent.hidePopWin(true);</script>";
				}
				return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>