<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $id = intval($request->getParameter("id"));
        $editable = $request->getParameter("editable");

        if($editable == 'true'){
            $news_title = trim($request->getParameter('news_title'));
            $ctype = trim($request->getParameter('ctype'));
            $sort = trim($request->getParameter('sort'));
            $content = trim($request->getParameter('content'));
        }else{
            $sql = "select * from ntb_newslist where id = '$id'";
            $r = $db->select($sql);
            if($r){
                $news_title = $r[0]->news_title;
                $ctype = $r[0]->ctype ;
                $sort = $r[0]->sort;
                $content = $r[0]->content;
            }
        }

        //绑定新闻分类
        $db = DBAction::getInstance();
        $sql = "select * from ntb_newsclass where tistrue = 0  order by sort";
        $rs = $db->select($sql);

        $request->setAttribute("ctypes",$rs);
        $request->setAttribute('id', $id);
        $request->setAttribute("ctype",$ctype);
        $request->setAttribute('news_title', isset($news_title) ? $news_title : '');
        $request->setAttribute('sort', isset($sort) ? $sort : '');
        $request->setAttribute('content', isset($content) ? $content : '');



        return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter('id'));

        $news_title = addslashes(trim($request->getParameter('news_title')));
        $sort = floatval(trim($request->getParameter('sort')));
        $content = addslashes($request->getParameter('content'));
        $ctype= addslashes($request->getParameter('ctype'));

        //将临时文件复制到upload_image目录下
        $imgURL=($_FILES['imgURL']['tmp_name']);

        $imgURL_name=($_FILES['imgURL']['name']);

        move_uploaded_file($imgURL,"../upfile/$imgURL_name");

        //检查新闻名称是否重复
        $sql = "select 1 from ntb_newslist where news_title = '$news_title' and id <> '$id'";
        $r = $db->select($sql);
        if ($r && count($r) > 0) {
            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('{$news_title} 已经存在，请选用其他标题进行修改！');" .
                "</script>";
            return $this->getDefaultView();
        }

		//更新数据表
		$sql = "update ntb_newslist " .
			"set news_title = '$news_title',ctype = '$ctype', sort = '$sort',imgURL = '$imgURL_name', content = '$content' "
			."where id = '$id'";
		$r = $db->update($sql);

		if($r == -1) {
		echo "<script type='text/javascript'>" .
				"alert('未知原因，新闻修改失败！');" .
				"location.href='index.php?module=newslist';</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('新闻修改成功！');" .
				"location.href='index.php?module=newslist';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>