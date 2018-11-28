<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

	public function getDefaultView() {

		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $kefu_num = floatval(trim($request->getParameter('kefu_num')));
        $kefu_name = addslashes(trim($request->getParameter('kefu_name')));


		//添加在线客服
		$sql = "insert into ntb_kefu(kefu_name,kefu_num) "
            ."values('$kefu_name','$kefu_num')";
		$r = $db->insert($sql);

        /*$_kefu_num = $r[0]->kefu_num;
        $_kefu_name = $r[0]->kefu_name;
        $_id = $r[0]->id;

        $_SESSION['id']  = $_id;
        $_SESSION['kefu_num']  = $_kefu_num;
        $_SESSION['kefu_name']  = $_kefu_name;*/


		if($r == -1) {
            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('位置原因，客服添加失败！');" .
                "location.href='index.php?module=kefu';</script>";
        } else {
            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('客服添加成功！');" .
                "location.href='index.php?module=kefu';</script>";
        }
		
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>