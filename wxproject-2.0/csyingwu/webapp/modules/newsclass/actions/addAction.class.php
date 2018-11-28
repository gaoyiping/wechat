<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$name_class = $request->getParameter('name_class');
		$sort = $request->getParameter('sort');


		$request->setAttribute('name_class', $name_class);
		$request->setAttribute('sort', $sort);
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $sort = floatval(trim($request->getParameter('sort')));
        $name_class = addslashes(trim($request->getParameter('name_class')));

		//检查分类名称是否重复
        $sql = "select 1 from ntb_newsclass where name_class = '$name_class'";
		$r = $db->select($sql);

        if ($r && count($r) > 0) {
            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('新闻分类 {$name_class} 已经存在，请选用其他名称！');" .
                "</script>";
            return $this->getDefaultView();
        }
		//添加分类
		$sql = "insert into ntb_newsclass(name_class,sort,add_date) "
            ."values('$name_class','$sort',CURRENT_TIMESTAMP)";
		$r = $db->insert($sql);
		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，添加新闻分类失败！');" .
				"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('添加新闻分类成功！');" .
				"location.href='index.php?module=newsclass';</script>";
			return $this->getDefaultView();
		}
		
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>