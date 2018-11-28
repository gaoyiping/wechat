<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class okallAction extends Action {

	public function getDefaultView() {
		return;
	}

	public function execute(){

		if($_SESSION['_admin_atype']!=1 && !in_array("b5",$_SESSION['_admin_permission'])){
			header("Location: index.php?module=permission");
			return;
		}
		
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$ids = $request->getParameter("ids");
		$url = $_SESSION['daili_url'];
		$ids_str = implode(',',$ids);
        
			if($ids == ''){
			
			echo "<script type='text/javascript'>" .
				"" .
				"location.href='$url';</script>";
			return;
		}


			$serrnum="1";
			    //事务开始
				$db->begin();
				$rollback = false;
				do{ 
                       
                       
                        //修改奖金记录状态成已发放
						$sql="update ntb_money_point set isf=1 where id in(".$ids_str.") ";
						$r= $db -> update($sql);
						if ($r < 1) { $rollback = true; $rollcode = 2; break; }

					
				
				 }while(false);

			    if($rollback == true){
					$db->rollback(); 
					 header('Content-Type: text/html;charset=utf-8');
						echo "<script type='text/javascript'>" .
							"alert('发放奖金失败！');" . 
							"location.href='$url';</script>";
				} else {
					$db->commit();
				
					header('Content-Type: text/html;charset=utf-8');
					echo "<script type='text/javascript'>" .
						"alert('发放奖金成功！');" . 
						"location.href='$url';</script>";
				}
		
		
		
	
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>