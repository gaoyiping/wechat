<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

	public function getDefaultView() {

        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();

        //获取新闻类别
        $sql = "select id,name_class from ntb_newsclass ";
        $r = $db->select($sql);
        $request->setAttribute("ctype",$r);

		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
        $ctype = addslashes(trim($request->getParameter('ctype')));
        $news_title = addslashes(trim($request->getParameter('news_title')));
        $sort = floatval(trim($request->getParameter('sort')));
        $content = addslashes(trim($request->getParameter('content')));



        //将临时文件复制到upload_image目录下
        $imgURL=($_FILES['imgURL']['tmp_name']);

        $imgURL_name=($_FILES['imgURL']['name']);

        move_uploaded_file($imgURL,"../upfile/$imgURL_name");




        //发布新闻
        $sql = "insert into ntb_newslist(ctype,news_title,imgURL,sort,content,add_date) " .
            "values('$ctype','$news_title','$imgURL_name','$sort','$content',CURRENT_TIMESTAMP)";
        $r = $db->insert($sql);

        if($r == -1){

            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('未知原因，新闻发布失败！');" .
                "</script>";
            return $this->getDefaultView();

        }else{

            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('新闻发布成功！');" .
                "location.href='index.php?module=newslist';</script>";
            return $this->getDefaultView();
        }

		    return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>