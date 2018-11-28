<?php
//echo $_GET['echostr']; exit;
date_default_timezone_set('Asia/Chongqing');
require_once(dirname(__FILE__)."/webapp/config.php");
require_once(MO_APP_DIR."/mojavi.php");
require_once(dirname(__FILE__).'/webapp/config/db_config.php');
require_once(dirname(__FILE__).'/webapp/lib/DBAction.class.php');
require('callback.php');
$db = DBAction::getInstance();
$wechatObj = new wechatCallbackapi();
$wechatObj -> valid($db);
$base_url = 'http://' . $_SERVER['SERVER_NAME'] . '/';
$wechatObj -> responseMsg($db, $user, $base_url);
?>