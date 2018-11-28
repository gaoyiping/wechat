<?php
class member extends spAdmin {
    function index() {
    	$userlist = Model("User")->findAll(); //访问M要数据赋值给userlist变量

    	$this->userlist = $userlist; //赋值给临时变量

    	$this->display("subpage/member.html"); // 显示模板
    }
}