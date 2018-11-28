<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

    public function getDefaultView() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $startdate = $request->getParameter("startdate");
        $sql = "select count(id) c from ntb_admin";
        $r = $db->select($sql);
        //分页
        $total = intval($r[0]->c);
        $page = intval($request->getParameter('page'));
        $pagesize = 15;
        $pager = new ShowPager($total,$pagesize,$page);
        $offset = $pager->offset;
        $pagehtml = $pager->num_link("module=addadmin");
        //详情
        $sql = "select id,admin_id,add_date,role " . "from ntb_admin where role = 2 order by add_date desc limit $offset,$pagesize ";
        $r = $db->select($sql);
        $request->setAttribute("admin_list",$r);
        $request->setAttribute("pagehtml",$pagehtml);
        $request->setAttribute('startdate',$startdate);

        return View :: INPUT;

    }

    public function execute() {

    }

    public function getRequestMethods(){
        return Request :: NONE;
    }

}

?>