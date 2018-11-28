<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<title></title>
</head>
<body class="white">
<header class="top">
	<div class="text-center">转币记录</div><div class="action"><a href="javascript:window.history.back();" class="pull-left"><i class="am-icon-chevron-left"></i></a><div>
</header>
<section class="center">
	<p class="lheight"></p>
	<div class="zhrjl">
		<span class="f-left"><i class="am-icon-retweet"></i>转让记录</span>
		<button class="f-right shqzhb"><i class="am-icon-plus"></i><a href="index.php?module=chizhi">申请转让</a></button>
	</div>
	<div class="list-menu" style="padding-top: 5px;">
		<br/>
		<ul>
			{foreach from=$record_list item=record name=f1}
			<div class="padding">
				{if $record->amount>0}
				<li style="color: #c9302c">
					<b>从 {$record->accepter} 转入 {$record->amount}</b><span style="float:right">{$record->add_date}</span>
				</li>
				{/if}
				{if $record->amount<0}
				<li style="color: #449d44">
					<b>转出 {$record->amount|abs} 给 {$record->accepter}</b><span style="float:right">{$record->add_date}</span>
				</li>
				{/if}
			</div>
			{/foreach}
		</ul>
	</div>
	<p class="lheight"></p>
</section>
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  
</body>
</html>
