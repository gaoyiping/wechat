<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
</head>

<body>
<header class="top">
	<div class="text-center"><b>硒客中心<b/></div>
</header>
<section class="center">
	<p class="lheight"></p>
	<div class="member-main">
		<div class="m-pic">
			<p>{if strlen($user->headimgurl)}<img id="tx" src="#">{else}<img src="style/images/tou.png">{/if}</p>
			<p><span><strong>{$user->uplevelname}</strong></span></p>
		</div>

		<p><strong class="red">{$user->wxname}</strong></p>
		<p>会员编号：{$user->user_id}</p>
		<p>关联好友：{$user->dianpuname}</p>

		<div class="total-bar"><span><b>累计积分：￥{$user->e_money|sprintf}</b></span> <span><b>累计销售：￥{$user->ljxse|sprintf}<b/></span></div>
	</div>
	<div class="list-menu">
		<ul>
			{foreach from=$notices item=notice name=f1}
			<div class="padding"><li class="m2"><a href="index.php?module=index&action=news&id={$notice->id}">最新公告：{$notice->title}</a></li></div>
			{/foreach}
			{if $user->uplevel==0}
			<div class="padding"><li class="m15"><a href="index.php?module=shop&cid=1">立即购买，即刻成为店小二</a></li></div>
			{/if}
		</ul>
		{if $user->uplevel}
		<ul>
			<div class="padding"><li class="m1"><a href="index.php?module=index&action=rq&pid={$user->user_id}">我的硒粉<span>{$user->t1+$user->t2+$user->t3}</span></a></li></div>
			<div class="padding"><li class="m2"><a href="index.php?module=index&action=tg">我的推广<span>{$user->cn}</span></a></li></div>
			<div class="padding"><li class="m3"><a href="index.php?module=salary">我的积分<span>余额 ￥{$user->j_money|sprintf}</span></a></li></div>
			<div class="padding"><li class="m4"><a href="index.php?module=ticket&userid={$user->user_id}">推广二维码</a></li></div>
		</ul>
		{/if}
		<ul>
			<div class="padding"><li class="m6"><a href="index.php?module=HandleOrder">订单管理</a></li></div>
			{if $user->uplevel}
			<div class="padding"><li class="m5"><a href="index.php?module=index&action=ph">排行榜</a></li></div>
			<div class="padding"><li class="m3"><a href="index.php?module=chizhi&action=List">积分转积分</a></li></div>
			<div class="padding"><li class="m9"><a href="index.php?module=Cash&action=List">积分兑换</a></li></div>
			{/if}
			<div class="padding"><li class="m7"><a href="index.php?module=cz&action=Get">积分获取</a></li></div>
		</ul>
		<ul>
			{if $benefit}
			<div class="padding"><li class="m7"><a href="index.php?module=Benefit">分期补贴</a></li></div>
			{/if}
			<div class="padding"><li class="m12"><a href="index.php?module=index&action=sync">同步微信资料</a></li></div>
			<div class="padding"><li class="m10"><a href="index.php?module=ModifyInfo&action=bank">银行卡管理</a></li></div>
			<div class="padding"><li class="m14"><a href="index.php?module=ModifyInfo">收货地址管理</a></li></div>
		</ul>
	</div>
	<p class="lheight"></p>
</section>
<script type="text/javascript" charset="utf-8">
document.getElementById("tx").src="{$user->headimgurl}";
</script>
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}
</body>
</html>
