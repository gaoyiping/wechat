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
	<div class="text-center">业绩考核</div>
	<div class="action"><a href="javascript:window.history.back();" class="pull-left"><i class="am-icon-chevron-left"></i></a></div>
 </header>
<section class="center">
<p class="lheight"></p>
<table class="bordered" style="font-weight: bold;">
	<tbody>
		<tr>
			<td width="26%">上周考核</td>
			<td>{if $lastcasedone}<span style="color:#5cb85c; font-size: 18px;">星期{$lastcaseday}完成！{else}<span style="color:#c9302c; font-size: 18px;">未完成！</span>{/if}</span></td>
		</tr>
		<tr>
			<td width="26%">本周考核</td>
			<td>{if $casedone}<span style="color:#5cb85c; font-size: 18px;">星期{$caseday}完成！{else}<span style="color:#c9302c; font-size: 18px;">未完成！</span>{/if}</span></td>
		</tr>
		<tr>
			<td width="26%">考核内容</td>
			<td{if $casedone} style="text-decoration:line-through"{/if}>硒之客{$casecount}人或复销{$casecount*310}积分。</td>
		</tr>
	</tbody>
</table>
<hr/>
<table class="bordered" style="font-weight: bold;">
	<tbody>
		<tr>
			<td width="26%">累计硒钻</td>
			<td{if $bvalue >= $blimit} style="color:#d9534f;"{/if}>￥{$bvalue}元</td>
		</tr>
		<tr>
			<td width="26%">硒钻封顶</td>
			<td>￥{$blimit}元</td>
		</tr>
	</tbody>
</table> 
<p class="lheight"></p>
</section>


{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  
<style type="text/css">{literal}table{border-spacing:0;width:100%}
.bordered{border:solid #ccc 1px;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;-webkit-box-shadow:0 1px 1px #ccc;-moz-box-shadow:0 1px 1px #ccc;box-shadow:0 1px 1px #ccc}
.bordered tr:hover{background:#fbf8e9;-o-transition:all .1s ease-in-out;-webkit-transition:all .1s ease-in-out;-moz-transition:all .1s ease-in-out;-ms-transition:all .1s ease-in-out;transition:all .1s ease-in-out}
.bordered td,.bordered th{border-left:1px solid #ccc;border-top:1px solid #ccc;padding:10px;text-align:left}
.bordered th{background-color:#dce9f9;background-image:-webkit-gradient(linear,left top,left bottom,from(#ebf3fc),to(#dce9f9));background-image:-webkit-linear-gradient(top,#ebf3fc,#dce9f9);background-image:-moz-linear-gradient(top,#ebf3fc,#dce9f9);background-image:-ms-linear-gradient(top,#ebf3fc,#dce9f9);background-image:-o-linear-gradient(top,#ebf3fc,#dce9f9);background-image:linear-gradient(top,#ebf3fc,#dce9f9);-webkit-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;-moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;box-shadow:0 1px 0 rgba(255,255,255,.8) inset;border-top:none;text-shadow:0 1px 0 rgba(255,255,255,.5)}
.bordered td:first-child,.bordered th:first-child{border-left:none}
.bordered th:first-child{-moz-border-radius:6px 0 0 0;-webkit-border-radius:6px 0 0 0;border-radius:6px 0 0 0}
.bordered th:last-child{-moz-border-radius:0 6px 0 0;-webkit-border-radius:0 6px 0 0;border-radius:0 6px 0 0}
.bordered th:only-child{-moz-border-radius:6px 6px 0 0;-webkit-border-radius:6px 6px 0 0;border-radius:6px 6px 0 0}
.bordered tr:last-child td:first-child{-moz-border-radius:0 0 0 6px;-webkit-border-radius:0 0 0 6px;border-radius:0 0 0 6px}
.bordered tr:last-child td:last-child{-moz-border-radius:0 0 6px 0;-webkit-border-radius:0 0 6px 0;border-radius:0 0 6px 0}
{/literal}<style>
</body>
</html>
