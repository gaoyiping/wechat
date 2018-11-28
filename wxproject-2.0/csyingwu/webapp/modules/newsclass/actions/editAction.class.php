<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {

        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $id = intval($request->getParameter("id"));
        $editable = $request->getParameter("editable");

        if ($editable == 'true') {
            $name_class = trim($request->getParameter('name_class'));
            $sort = trim($request->getParameter('sort'));
        } else {
            $sql = "select * from ntb_newsclass where id = '$id'";

            $r = $db->select($sql);
            if($r){
                $name_class = $r[0]->name_class;
                $sort = $r[0]->sort;
            }
        }

        $request->setAttribute('id', $id);
        $request->setAttribute('name_class', isset($name_class) ? $name_class : '');
        $request->setAttribute('sort', isset($sort) ? $sort : '');

		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter('id'));
        $name_class = addslashes(trim($request->getParameter('name_class')));
        $sort = floatval(trim($request->getParameter('sort')));

        //检查分类名是否重复
        $sql = "select id from ntb_newsclass where name_class = '$name_class' and id <> '$id'";
        $r = $db->select($sql);
        if ($r) {
            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('新闻分类 {$name_class} 已经存在，请选用其他名称修改！');" .
                "</script>";
            return $this->getDefaultView();
        }

		//更新分类列表
		$sql = "update ntb_newsclass " .
			"set name_class = '$name_class', sort = '$sort'"
			."where id = '$id'";
		
		$r = $db->update($sql);

		if($r == -1) {
		echo "<script type='text/javascript'>" .
				"alert('未知原因，修改新闻分类失败！');" .
				"location.href='index.php?module=newsclass';</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('修改新闻分类成功！');" .
				"location.href='index.php?module=newsclass';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>