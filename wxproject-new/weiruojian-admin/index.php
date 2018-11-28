<?php

define("APP_PATH",dirname(__FILE__));
define("SP_PATH", '/home/SpeedPHP');

$spConfig = array(
	'db'=> array(
		'password'=> 'fa7fe7521b788f12b2d',
		'database'=> 'newcity',
	),
	'Wechat_AppID' => 'wxad3c152ccfd71355',
	'Wechat_AppSecret' => '2590e79390a178092f637637569947be',
	'ShopHome' => 'http://wx.weiruojian.com/index.php',
	'QR_FILE' => "UID%s_%s.jpg",
	'HEAD_FILE' => "UID%s_%s_HEAD.jpg",
);
require(SP_PATH."/SpeedPHP.php");
import($GLOBALS['G_SP']["sp_core_path"]."/spAdmin.php", FALSE, TRUE);
spRun();