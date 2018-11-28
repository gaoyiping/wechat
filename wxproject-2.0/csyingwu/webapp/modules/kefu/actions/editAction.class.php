<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {

        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $kid = intval($request->getParameter("kid"));
        $editable = $request->getParameter("editable");

        if ($editable == 'true') {
            $kefu_name = trim($request->getParameter('kefu_name'));
            $kefu_num = trim($request->getParameter('kefu_num'));

        } else {

            $sql = "select * from ntb_kefu where kid = '$kid'";
            $r = $db->select($sql);
            if($r){
                $kefu_name = $r[0]->kefu_name;
                $kefu_num = $r[0]->kefu_num;
            }
        }

        $request->setAttribute('kid', $kid);
        $request->setAttribute('kefu_name', isset($kefu_name) ? $kefu_name : '');
        $request->setAttribute('kefu_num', isset($kefu_num) ? $kefu_num : '');

		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$kid = intval($request->getParameter('kid'));
        $kefu_name = addslashes(trim($request->getParameter('kefu_name')));
        $kefu_num = floatval(trim($request->getParameter('kefu_num')));

		//更新列表
		$sql = "update ntb_kefu " .
			"set kefu_name = '$kefu_name', kefu_num = '$kefu_num'"
			."where kid = '$kid'";
		
		$r = $db->update($sql);

		if($r == -1) {
            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('未知原因，客服修改失败！');" .
                "</script>";
            return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('客服修改成功！');" .
				"location.href='index.php?module=kefu';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>