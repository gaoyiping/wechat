<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {

    public function getDefaultView() {

        $db = DBAction::getInstance();

        $request = $this->getContext()->getRequest();
        $sql = "select count(id) c from ntb_newslist";
        $r = $db->select($sql);


        //分页
        $total = intval($r[0]->c);
        $page = intval($request->getParameter('page'));
        $pagesize = 15;
        $pager = new ShowPager($total,$pagesize,$page);
        $offset = $pager->offset;
        $pagehtml = $pager->num_link("module=newslist");

        //列表展示
        $sql = 'select a.id,a.ctype,a.news_title,a.sort,a.add_date,m.id AS mid,m.name_class '.'from ntb_newslist'." AS a LEFT JOIN ".' ntb_newsclass'." AS m  ON a.ctype = m.id "." order by sort limit $offset,$pagesize";
        $r = $db->select($sql);

        $request->setAttribute("list",$r);
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