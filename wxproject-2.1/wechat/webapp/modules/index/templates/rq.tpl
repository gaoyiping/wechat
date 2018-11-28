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
	<div class="text-center">我的硒粉</div>
	<div class="action">
		<a href="javascript:window.history.back();" class="pull-left"><i class="am-icon-chevron-left"></i></a>
	</div>
</header>
<p class="lheight"></p>
<section class="center">
<div class="list-goods">
	<div class="g-nav">
		<ul>
			<li{if $uplevel == 1} class="on"{/if}><a href="index.php?module=index&action=rq&uplevel=1">硒之客<font color='red'><b>（{$Level1|default:0}）</b></font></a></li>
			<li{if $uplevel == 2} class="on"{/if}><a href="index.php?module=index&action=rq&uplevel=2">硒剑客<font color='red'><b>（{$Level2|default:0}）</b></font></a></li>
			<li{if $uplevel == 3} class="on"{/if}><a href="index.php?module=index&action=rq&uplevel=3">硒侠客<font color='red'><b>（{$Level3|default:0}）</b></font></a></li>
		</ul>
	</div>
	<div class="total-goods">
		<ul>
			{foreach from=$userlist item=user name=idx}
			<li style="height:73px">
				<div style="float:left;width:80%">
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
						&nbsp;&nbsp;
						<span style="color:white;padding:2px 8px 2px 8px;background-color:#c8ab38;-webkit-box-shadow:1px 1px 3px #444;-webkit-border-radius:1px;font-size:12px;">积分：{$user->e_money}</span>
					</p>
				</div>
				<div style="float:right;width:20%;text-align:right;font-size:24px;padding:10px;font-family:monospace;">{$smarty.foreach.idx.iteration}</div>
			</li>
			{/foreach}
		</ul>
	</div>
</div>
</section>
<footer>
	<div class="bottom">
		<div class="fhwszx" style="text-align: center;"><a  style="color:white"  href="index.php?module=index"><i class="am-icon-user am-icon-sm"></i></br>返回硒客中心</a></div>
	</div>
</footer>
</body>
</html>