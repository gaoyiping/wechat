<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<title></title>
</head>
<body>
<header class="top">
 <div class="text-center">排行榜</div>
<div class="action"><a href="javascript:window.history.back();" class="pull-left"><i class="am-icon-chevron-left"></i></a></div>
</header>
<p class="lheight"></p>
<section class="center">
	<div class="total-goods">
		<ul>
			{if $level <= 40}
			{foreach from=$userlist item=user name=idx}
			<li style="height:73px">
				<div style="float:left;width:90%">
					<p class="pic"><img style="height:50px" src="{$user->headimgurl}"></p>
					<p><span class="blue" >{$user->wxname}</span></p>
					<p>
						<span style="color:white;padding:2px 8px 2px 8px;background-color:#ca181f;-webkit-box-shadow:1px 1px 2px #444;-webkit-border-radius:1px;font-size:12px;">
							{if $user->uplevel==1}店小二{/if}
							{if $user->uplevel==6}伙计{/if}
							{if $user->uplevel==2}掌柜{/if}
							{if $user->uplevel==3}东家{/if}
							{if $user->uplevel==4}富豪{/if}
							{if $user->uplevel==5}大富豪{/if}
							{if $user->uplevel==7}董事{/if}
						</span>
						<span style="color:white;padding:2px 8px 2px 8px;background-color:#c8ab38;-webkit-box-shadow:1px 1px 3px #444;-webkit-border-radius:1px;font-size:12px;">
							积分爆表
						</span>
					</p>
				</div>
				<div style="float:right;width:20%;text-align:right;font-size:24px;padding:10px;font-family:monospace;">{$smarty.foreach.idx.iteration}</div>
			</li>
			{/foreach}
			{else}
			<li style="height:73px;text-align: center;">您不在排行榜内，请继续努力。<li>
			{/if}
		</ul>
	</div>
</div>
</section>
<footer>
	<div class="bottom">
		<div class="fhwszx"  style="text-align: center;"><a style="color:white"  href="index.php?module=index"><i class="am-icon-user am-icon-sm"></i></br>返回硒客中心</a></div>
	</div>
</footer>
</body>
</html>