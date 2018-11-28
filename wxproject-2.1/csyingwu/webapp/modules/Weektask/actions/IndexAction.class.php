<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {
    public function getDefaultView() {
        $request = $this->getContext()->getRequest();   
        $admin_atype = $this->getContext()->getStorage()->read('_admin_atype');
        $db = DBAction::getInstance();

        $weekindex = (int)date('W');
        $weekday = array(null, "一", "二", "三", "四", "五", "六", "天");
        $leveltext = array("见习店小二", "店小二", "掌柜", "东家", "富豪", "大富豪");
        for ($level = 2; $level <= 5; $level++) {
            $sqlcmd = "SELECT `user`.`user_id`, `user`.`wxname`, `task`.`task_day` FROM `ntb_user_weektask` AS `task`, `ntb_user` AS `user` WHERE `task`.`task_week`={$weekindex} AND `task`.`task_done`=1 AND `user`.`user_id` = `task`.`user_id` AND `user`.`uplevel`={$level} ORDER BY `user`.`wxname` ASC";
            $userlist = $db->select($sqlcmd);
            for ($i = 0; $i < count($userlist); $i++) {
                $userlist[$i]->task_day = "星期" . $weekday[$userlist[$i]->task_day];
                $userlist[$i]->uplevel = $leveltext[$level];
            }
            $request->setAttribute("Level{$level}", $userlist);
            $request->setAttribute("Level{$level}Count", count($userlist));
        }
        return View::INPUT;
    }

    public function execute(){
    }

    public function getRequestMethods(){
        return Request::POST;
    }

}
?>