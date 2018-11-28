<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<!-- jQuery library (served from Google) -->
<script src="bxslider/js/jquery.min.js"></script>
<!-- bxSlider Javathript file -->
<script src="bxslider/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="bxslider/css/jquery.bxslider.css" rel="stylesheet" />
<title>唯若健商城</title>
</head>

<body>
<header class="top"><div class="text-center"><b>商城首页</b></div></header>
<p class="lheight"></p>
<div class="container">
	{foreach from=$goodlist item=goods name=f1}
	<div class="row">
		<div class="media media-{$smarty.foreach.f1.iteration%4}" style="height:auto; border-radius: 5px; padding: 8px;">
			<div class="media-left">
				{if $goods->isgroup}
				<a href="index.php?module=shop&action=group&id={$goods->id}">
					<img class="img-responsive" style="width:130px; border: 2px solid #EEE; border-radius: 3px;" src="/upfile/{$goods->imgURL}">
				</a>
				{else}
				<a href="index.php?module=shop&action=goods&id={$goods->id}">
					<img class="img-responsive" style="width:130px; border: 2px solid #EEE; border-radius: 3px;" src="/upfile/{$goods->imgURL}">
				</a>
				{/if}
			</div>
			<div class="media-body">
				<h3 class="media-heading">{$goods->pname}</h3>
				<p>价格：￥{$goods->zhuanmaijia}元</p>
				<div>
					{if $goods->isgroup}
					<a class="btn white" style="-webkit-border-radius:3px !important;" href="index.php?module=shop&action=group&id={$goods->id}">
						点击购买 <i class="am-icon-caret-right"></i>
					</a>
					{else}
					<a class="btn white" style="-webkit-border-radius:3px !important;" href="index.php?module=shop&action=goods&id={$goods->id}">
						点击购买 <i class="am-icon-caret-right"></i>
					</a>
					{/if}
				</div>
			</div>
		</div>
	</div>
	{/foreach}
</div> 
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  
</body>
</html>
