<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {
    public function getDefaultView() {
        $request = $this->getContext()->getRequest();   
        $admin_atype = $this->getContext()->getStorage()->read('_admin_atype');
        return View :: INPUT;
    }

    public function execute(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $adminid = $this->getContext()->getStorage()->read('_admin_id');
        header("Content-Type: text/html;charset=utf-8");
        $userid = strtolower(addslashes(trim($request->getParameter('userid'))));
        $nummoney = intval($request->getParameter('amount'));
        $password = md5(addslashes(trim($request->getParameter('password'))));
        $sex = intval($request->getParameter('sex'));
        $cfnumber = "NK".date("ymdhis").rand(0,9).rand(0,9).rand(0,9);
        if($nummoney <= 0){
            exit("<script type='text/javascript'>alert('金额不正确！');location.href='index.php?module=Recharge&type=user';</script>");
        }
        $sqlcmd = "SELECT * FROM `ntb_admin` WHERE `admin_id`='{$adminid}' AND `second_pwd`='{$password}'";
        $result = $db->select($sqlcmd);
        if($result==false){
            exit("<script type='text/javascript'>alert('二级密码错误！');location.href='index.php?module=Recharge&type=user';</script>");
        }
        $sqlcmd = "SELECT * FROM `ntb_user` WHERE `user_id`='{$userid}'";
        $result = $db->select($sqlcmd);
        if ($result == false) {
            exit("<script type='text/javascript'>alert('充值用户错误！');location.href='index.php?module=Recharge&type=user';</script>");
        }
        $db->begin();
        $sqlcmd = "UPDATE `ntb_user` SET `j_money`=`j_money`+{$nummoney} WHERE `user_id`='{$userid}'";
        $sid = $db->update($sqlcmd);
        if ($sid == -1) {
            $db->rollback();
            exit("<script type='text/javascript'>alert('充值失败！请重试！');location.href='index.php?module=Recharge&type=user';</script>");
        }
        $sqlcmd = "INSERT INTO `ntb_log` (`userid`, `money`, `event`, `utype`) VALUES ('{$userid}', {$nummoney}, '管理员 {$adminid} 为 {$userid} 充值积分：{$nummoney}', 3)";
        $rid = $db->update($sqlcmd);
        if ($rid == -1) {
            $db->rollback();
            exit("<script type='text/javascript'>alert('日志记录失败！请重试！');location.href='index.php?module=Recharge&type=user';</script>");
        }
        $db->commit();
        exit("<script type='text/javascript'>alert('充值成功！');location.href='index.php?module=Recharge&type=user';</script>");
    }

    public function getRequestMethods(){
        return Request :: POST;
    }

}
?>