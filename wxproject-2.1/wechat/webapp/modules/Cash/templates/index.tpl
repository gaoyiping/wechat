<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<link href="style/dialog/css/blackbox.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="modpub/js/check.js"> </script>
<script src="style/dialog/js/jquery.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/dialog.js" type="text/javascript"></script> 
<title></title>

<script type="text/javascript">
var hasMoney = {$User->j_money|sprintf};
{literal}
function SaveVal(f) {
	if ($.trim($("#TxtMoney").val()).length == 0) {
		mbox("请输入提现金额!");
		return false;
	}
	if ($.trim($("#cardnumber").val()).length == 0) {
		mbox("请输入银行账号!");
		return false;
	}

	if ($.trim($("#cardname").val()).length == 0) {
		mbox("请输入银行开户名!");
		return false;
	}

	if ($.trim($("#provcity").val()).length == 0) {
		mbox("请输入开户行所在地!");
		return false;
	}
	var money = parseFloat($("#TxtMoney").val());
	if (money < 50){
		mbox("提现金额均以50元起提!");
		return false;
	}

	if(money % 10 > 0){
		mbox("提现金额必须为10的倍数!");
		return false;
	}

	if(money > hasMoney){
		mbox("提现金额超出您的可用余额！");
		if (hasMoney >= 50) {
			$("#TxtMoney").val(parseFloat(hasMoney - (hasMoney % 10)));
		} else {
			$("#TxtMoney").val(0.00);
		}
		return false;
	}
	var tax = money * 0.05;
    var str = "开户银行：" + f.cardtype.value + "\r开户账号：" + f.cardnumber.value + "\r开户名称：" + f.cardname.value + "\r申请金额：" + money + "元\r手续费：" + tax + "元\r是否确认？";
    if (confirm(str)) {
    	$("#submitbutton").hide();
    	return true;
    }
    return false;
}
{/literal}
</script>



</head>

<body class="white">
<header class="top"> 
	<div class="text-center">提现申请</div>
	<div class="action"><a href="javascript:window.history.back();" class="pull-left"><i class="am-icon-chevron-left"></i></a></div>
</header>
<section class="center">
	<p class="lheight"></p>
	<div class="sq_box">
	<form name="f" action="index.php?module=Cash" method='post' onsubmit="return SaveVal(this);">
		<input type="hidden" name="cfnumber" value="{$cfnumber}"/>
		<h3>可提金额：<strong class="red">￥{$User->j_money|sprintf}元</strong></h3>
		<p>提现说明：提现金额均以50元起提。</p>
		<h3>申请提现金额：</h3>
		<p class="money"><input name="amount" type="text"  id="TxtMoney" class="how" placeholder="必填项" onkeypress="if ((event.keyCode < 48 || event.keyCode > 57) &amp;&amp; (event.keyCode != 46)) event.returnValue = false;"><span>元</span></p>
		<h3>开户银行：</h3>
		<p class="money">
		<select name="cardtype"  id="cardtype" class="how" >
			<option value="中国农业银行" {if $User->card_type=='中国农业银行'}selected{/if} >中国农业银行</option>
			<option value="中国建设银行" {if $User->card_type=='中国建设银行'}selected{/if} >中国建设银行</option>
		</select>
		</p>
		<h3>银行帐号：</h3>
		<p class="money"><input name="cardnumber" id="cardnumber" value="{$User->card_number}" type="text" placeholder="必填项" class="how"></p>
		<h3>姓名：</h3>
		<p class="money"><input name="cardname" id="cardname" value="{$User->card_name}" type="text" placeholder="必填项" class="how"></p>
		<h3>开户行所在地：</h3>
		<p class="money"><input name="provcity" id="provcity" value="{$User->provcity}" type="text" placeholder="必填项" class="how"></p>
		<input id="submitbutton" type="submit" value="提交申请"  class="sub">
	</form>
	</div>
	<p class="lheight"></p>
</section>
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  
</body>
</html>
