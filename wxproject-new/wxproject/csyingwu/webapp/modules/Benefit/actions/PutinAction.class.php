<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
class PutinAction extends Action {
    public function getDefaultView() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        return View::INPUT;
    }

    public function execute(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $userid = addslashes(trim($request->getParameter("userid")));
        $uservalue = addslashes(trim($request->getParameter("uservalue")));
        $uservalue = round($uservalue, 2);

        $sqlcmd = "UPDATE `ntb_user` SET `bt_money`=`bt_money`+{$uservalue} WHERE `user_id`='{$userid}'";
        $db->update($sqlcmd);
        header('Content-Type: text/html;charset=utf-8');
        exit("<script type='text/javascript'>alert('{$userid}福利充值{$uservalue}成功！');location.href='index.php?module=Benefit&action=Putin';</script>");
    }

    public function getRequestMethods() {
        return Request::POST;
    }
} 