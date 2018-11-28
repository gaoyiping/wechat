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
<div class="text-center">提现记录</div>
<div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
 </header>
<section class="center">
 <p class="lheight"></p>
 
<div class="zhrjl">
  <span class="f-left"><i class="am-icon-money"></i>提现记录</span>
    <button class="f-right shqzhb"><i class="am-icon-plus"></i><a href="index.php?module=Cash">申请提现</a></button>
</div>
<div class="list-menu">
	<ul>
		{foreach from=$logs item=item name=f1}
		<div class="padding">
			<li>
				<span>时间：{$item->add_date}</span>
				<br/>
				金额：{$item->amount|sprintf}元{if $item->status == 0}<span style="color:#f0ad4e;font-weight:bold;">【审核中】</span>{elseif $item->status == 1}<span style="color:#449d44;font-weight:bold;">【成功】</span>{else}<span style="color:#c9302c;font-weight:bold;">【失败】</span>{/if}
			</li>
		</div>
		{/foreach}
	</ul>
</div>
 
 <p class="lheight"></p>
</section>
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  
</body>
</html>