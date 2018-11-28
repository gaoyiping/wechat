<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

    public function getDefaultView() {

        return View :: INPUT;
    }

    public function execute(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $tag_name = addslashes(trim($request->getParameter('tag_name')));
        $sort = floatval(trim($request->getParameter('sort')));
        $tagURL = addslashes(trim($request->getParameter('tagURL')));

        //检查广告位名称是否重复
        $sql = "select 1 from ntb_guanggao where tag_name = '$tag_name'";
        $r = $db->select($sql);

        if ($r && count($r) > 0) {
            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('广告位 {$tag_name} 已经存在，请选用其他名称！');" .
                "</script>";
            return $this->getDefaultView();
        }


        //将临时文件复制到upload_image目录下
        $imgURL=($_FILES['imgURL']['tmp_name']);
        $imgURL_name=($_FILES['imgURL']['name']);
        move_uploaded_file($imgURL,"../upfile/$imgURL_name");


        //添加广告位
        $sql = "insert into ntb_guanggao(tag_name,sort,imgURL,tagURL) " .
            "values('$tag_name','$sort','$imgURL_name','$tagURL')";
        $r = $db->insert($sql);


        if($r == -1){

            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('未知原因，广告位添加失败！');" .
                "</script>";
            return $this->getDefaultView();

        }else{

            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('广告位添加成功！');" .
                "location.href='index.php?module=guanggao';</script>";
            return $this->getDefaultView();
        }

        return;
    }

    public function getRequestMethods(){
        return Request :: POST;
    }

}

?>