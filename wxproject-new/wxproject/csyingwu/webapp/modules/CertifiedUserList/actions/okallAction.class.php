<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class okallAction extends Action {

	public function getDefaultView() {
		return;
	}

	public function execute(){

		
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$ids = $request->getParameter("ids");
		$lock = $request->getParameter("lock");
		$url = $_SESSION['daili_url'];
		$ids_str = implode(',',$ids);
        
			if($ids == ''){
			
			echo "<script type='text/javascript'>" .
				"" .
				"location.href='$url';</script>";
			return;
		}
		
		$up = $lock=='设置报单中心'?1:0;


			$serrnum="1";
			    //事务开始
				$db->begin();
				$rollback = false;
				do{ 
                        //修改奖金记录状态成已发放
						$sql="update ntb_user set  tui1=$up where id in(".$ids_str.") ";
						$r= $db -> update($sql);
						if ($r < 1) { $rollback = true; $rollcode = 2; break; }

				 }while(false);

			    if($rollback == true){
					$db->rollback(); 
					
					 header('Content-Type: text/html;charset=utf-8');
						echo "<script type='text/javascript'>" .
							"alert('操作失败！');" . 
							"location.href='$url';</script>";
				} else {
					$db->commit();
				
					header('Content-Type: text/html;charset=utf-8');
					echo "<script type='text/javascript'>" .
						"alert('操作成功！');" . 
						"location.href='$url';</script>";
				}
		
		
		
	
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>