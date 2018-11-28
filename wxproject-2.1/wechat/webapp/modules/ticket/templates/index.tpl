<!--搜索页-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>推广二维码</title>
	<meta content="telephone=no" name="format-detection" />
	<link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png"/>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=320, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>

<body>
{if $img == 1}生成二维码出错，请待明日。请尝试另外推荐方式。{else}<img style="width:100%" src="./picture/{$img}" />{/if}
</body>
</html>