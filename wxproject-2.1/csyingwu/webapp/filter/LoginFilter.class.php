<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
class LoginFilter extends Filter {

	public $effect;
	public $candirect = array("Default","Login") ;

    public function execute ($filterChain) {
		if($this->effect == false){
			$filterChain->execute();
			return;
		}

		//取得第一个访问模块的名称
		$controller = $this->getContext()->getController();
		$actionstack = $controller->getActionStack();
		$first = $actionstack->getFirstEntry();
		$firstmodule = $first->getModuleName();

		if(in_array($firstmodule,$this->candirect)){
			$filterChain->execute();
		} else {
			if($this->getContext()->getUser()->isAuthenticated()){
				
				$userid = $this->getContext()->getStorage()->read('_admin_id');
				$db = DBAction::getInstance();
				$sql = "select * from ntb_admin where admin_id ='$userid'";
				$r = $db->select($sql);
				$permission = unserialize($r[0]->permission);
				$permission[]="AdminLogin";
				$permission[]="index";
				$permission[]="Top";
				$permission[]="Menu";
				$permission[]="end";
				$permission[]="permission";
				if($r[0]->admin_atype!=1 && !in_array($this->getContext()->getModuleName(),$permission)){
					header("Location: index.php?module=permission"); 
					return;
				}else{
					$filterChain->execute();
				}
				
			} else {	
				$controller->redirect("index.php?module=Login");
			}
		}
		return;
	}

    public function initialize ($context, $params = null) {

		if($params['effect']){
			$this->effect = true;
		} else {
			$this->effect = false;
		}

		// initialize parent
		parent::initialize($context, $params);

		return true;

    }

}

?>