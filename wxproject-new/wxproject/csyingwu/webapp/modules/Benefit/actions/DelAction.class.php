<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
class DelAction extends Action {
    public function getDefaultView() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $userid = addslashes(trim($request->getParameter("userid")));
        $sqlcmd = "DELETE FROM `ntb_user_benefit` WHERE `user_id`='{$userid}'";
        $db->query($sqlcmd);
        header('Content-Type: text/html;charset=utf-8');
        exit("<script type='text/javascript'>alert('{$userid}福利删除成功！');location.href='index.php?module=Benefit';</script>");
    }

    public function execute(){
    }

    public function getRequestMethods() {
        return Request::POST;
    }
} 