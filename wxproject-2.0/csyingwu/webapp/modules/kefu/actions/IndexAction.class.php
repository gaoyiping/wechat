<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

    public function getDefaultView() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $sql = "select count(kid) c from ntb_kefu";
        $r = $db->select($sql);

        //分页
        $total = intval($r[0]->c);
        $page = intval($request->getParameter('page'));
        $pagesize = 15;
        $pager = new ShowPager($total,$pagesize,$page);
        $offset = $pager->offset;
        $pagehtml = $pager->num_link("module=kefu");
        //详情显示
        $sql = "select * " .
            "from ntb_kefu limit $offset,$pagesize";
        $r = $db->select($sql);
        $request->setAttribute("kefu",$r);
        $request->setAttribute("pagehtml",$pagehtml);

        return View :: INPUT;

    }

    public function execute() {

    }

    public function getRequestMethods(){
        return Request :: NONE;
    }

}

?>