 <?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$this->getContext()->getUser()->setAuthenticated(false);
		
		$request->setAttribute("adminid",$request->getParameter("adminid"));
        $request->setAttribute("adminpass",$request->getParameter("adminpass"));

      

		return View :: INPUT;
	}



	public function execute(){

		$db=DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		
		$adminid = addslashes(trim(strtolower($request->getParameter("adminid"))));
		$adminpass = md5(strtolower($request->getParameter("adminpass")));

        if($adminid == '' || $adminpass == ''){
            header("Content-type: text/html;charset=utf-8");
            echo"<script language='javascript'>" .
                "alert('用户名和密码不能为空');" .
                "location.href='index.php?module=Login';</script>";
            return ;
        }
        ;
        /*$ValiNumber = trim($request->getParameter("validateNum"));

        if (!isset($_SESSION["authnum_session"]) ||
            strtolower($_SESSION["authnum_session"]) != strtolower($ValiNumber) ){
            header("Content-type: text/html;charset=utf-8");
            echo"<script language='javascript'>" .
                "alert('验证码不正确');" .
                "location.href='index.php?module=Login';</script>";
            return ;
        }*/

		$sql = "select admin_id,first_pwd,admin_atype,permission from ntb_admin where " .
			   "admin_id = '$adminid' and first_pwd = '$adminpass'";
		$result = $db->select($sql);
		if($result==false){
			$sql="insert into ntb_log (userid,event) values ('$adminid','登录密码错误') ";
			$r= $db -> update($sql);

			header("Content-type: text/html;charset=utf-8");
			echo"<script language='javascript'>" .
				"alert('用户名或密码不正确');" .
				"location.href='index.php?module=Login';</script>";
			return ;
		}


		$_admin_id = $result[0]->admin_id;
		$_admin_atype = $result[0]->admin_atype;
		$_admin_permission = unserialize($result[0]->permission);
		if(!$_admin_atype){
			$_admin_atype=0;
			$sql="insert into ntb_log (userid,event) values ('$adminid','登录成功') ";
			$r= $db -> update($sql);
		}
		$this->getContext()->getUser()->setAuthenticated(true);


		$this->getContext()->getStorage()->write('_admin_id',$_admin_id);
		$this->getContext()->getStorage()->write('_admin_atype',$_admin_atype);
		$this->getContext()->getStorage()->write('_admin_permission',$_admin_permission);
		$this->getContext()->getController()->redirect("index.php?module=AdminLogin");

    }

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>