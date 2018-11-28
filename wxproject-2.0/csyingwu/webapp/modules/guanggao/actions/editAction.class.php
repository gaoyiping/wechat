<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {

        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();

        $id = intval($request->getParameter("id"));
        $editable = $request->getParameter("editable");

        if ($editable == 'true') {
            $tag_name = trim($request->getParameter('tag_name'));
            $sort = trim($request->getParameter('sort'));
            $tagURL = trim($request->getParameter('tagURL'));
        } else {
            $sql = "select * from ntb_guanggao where id = '$id'";
            $r = $db->select($sql);

            if($r){
                $tag_name = $r[0]->tag_name;
                $sort = $r[0]->sort;
                $tagURL = $r[0]->tagURL;
            }
        }

        $request->setAttribute('id', $id);
        $request->setAttribute('tag_name', isset($tag_name) ? $tag_name : '');
        $request->setAttribute('sort', isset($sort) ? $sort : '');
        $request->setAttribute('tagURL', isset($tagURL) ? $tagURL : '');

		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();

		$id = intval($request->getParameter('id'));
        $tag_name = addslashes(trim($request->getParameter('tag_name')));
        $sort = floatval(trim($request->getParameter('sort')));
        $tagURL = addslashes(trim($request->getParameter('tagURL')));

        //检查分类名是否重复
        $sql = "select id from ntb_guanggao where tag_name = '$tag_name' and id <> '$id'";
        $r = $db->select($sql);
        if ($r) {
            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('广告位 {$tag_name} 已经存在，请选用其他名称修改！');" .
                "</script>";
            return $this->getDefaultView();
        }

		//更新广告位列表
        if($_FILES['imgURL']['name']==""){
            $sql = "update ntb_guanggao " .
                "set tag_name = '$tag_name', sort = '$sort',tagURL = '$tagURL'"
                ."where id = '$id'";

            $r = $db->update($sql);
        }else{

            //将临时文件复制到upload_image目录下
            $imgURL=($_FILES['imgURL']['tmp_name']);
            $imgURL_name=($_FILES['imgURL']['name']);

            move_uploaded_file($imgURL,"../upfile/$imgURL_name");
            $imgurl=$imgURL_name;

            //更新广告位列表
            $sql = "update ntb_guanggao " .
                "set tag_name = '$tag_name', sort = '$sort',tagURL = '$tagURL',imgurl = '$imgurl'"
                ."where id = '$id'";

            $r = $db->update($sql);
        }

		if($r == -1) {
		echo "<script type='text/javascript'>" .
				"alert('未知原因，广告位修改失败！');" .
				"location.href='index.php?module=guanggao';</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('广告位修改成功！');" .
				"location.href='index.php?module=guanggao';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>