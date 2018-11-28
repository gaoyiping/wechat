<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>茶馆信息管理系统</title>
<link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/new_style/js/jquery.js"></script>
<script type="text/javascript">
{literal}
$(function(){
	//顶部导航切换
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})
})
</script>
{/literal}

</head>

<body style="background:url(images/topbg.gif) repeat-x;">

    <div class="topleft">
    <a href="main.html" target="_parent"><img src="/new_style/images/logo.png" title="系统首页" /></a>
    </div>

    <ul class="nav">

    <li><a href="index.php?module=index" target="rightFrame" class="selected"><img src="/new_style/images/icon01.png" title="系统首页" /><h2>系统首页</h2></a></li>
    <li><a href="index.php?module=CertifiedUserList" target="rightFrame"><img src="/new_style/images/icon02.png" title="店铺管理" /><h2>店铺管理</h2></a></li>
    <li><a href="index.php?module=weixin"  target="rightFrame"><img src="/new_style/images/icon03.png" title="微信配置" /><h2>微信配置</h2></a></li>
    <li><a href="index.php?module=ProductType"  target="rightFrame"><img src="/new_style/images/icon04.png" title="进▪ 销▪ 存" /><h2>进▪ 销▪ 存</h2></a></li>
    <li><a href="index.php?module=QueryNotice" target="rightFrame"><img src="/new_style/images/icon05.png" title="综合管理" /><h2>综合管理</h2></a></li>
    <li><a href="index.php?module=system"  target="rightFrame"><img src="/new_style/images/icon06.png" title="系统管理" /><h2>系统管理</h2></a></li>
    </ul>

    <div class="topright">
    <ul>
    <li><span><img src="/new_style/images/help.png" title="帮助"  class="helpimg"/></span><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    <li><a href="index.php" target="_parent">退出</a></li>
    </ul>

    <div class="user">
    <span>{$admin_id}</span>
    
    </div>

    </div>

</body>
</html>
