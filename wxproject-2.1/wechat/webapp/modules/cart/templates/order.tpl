<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<script type="text/javascript" src="modpub/js/check.js"> </script>
<title>订单处理</title>
<link href="style/dialog/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="style/dialog/js/jquery.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/dialog.js" type="text/javascript"></script> 


<script type="text/javascript">
var totalmoney = {$totalmoney};
{literal}
function SaveVal(obj){
	if ($("user_name").val() == "") {
		alert('联系人未填!');
		return false;
	}
	if ($("mobile").val() == "") {
		alert('联系电话未填!');
		return false;
	}
	if ($("address").val() == "") {
		alert('邮寄地址未填!');
		return false;
	}
}
</script>
{/literal}
</head>

<body class="white">
<header class="top"> 
<div class="text-center">订单处理</div>
<div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
 </header>
<section class="center">
 <p class="lheight"></p>
 
<div class="new_add">
	<form class="am-form"  action="index.php?module=cart&action=order" method='post' onsubmit="return SaveVal(this);">
		<fieldset>
			<div class="am-form-group">
				<label>联系人姓名：</label>
				<input id="user_name" type="text" name="user_name" value="{$userinfo->user_name}"  placeholder="" required />
			</div>
			<div class="am-form-group">
				<label>联系人电话：</label>
				<input id="mobile" type="text" name="mobile" value="{$userinfo->mobile}" placeholder="" required/>
			</div>
			<div class="am-form-group">
				<label>邮寄地址：</label>
				<textarea id="address" name="address">{$userinfo->address}</textarea>
			</div>
			<div class="am-form-group">总计货款：￥<b style="color:#d9534f;font-size:18px;">{$totalmoney}</b>元。</div>
			<div class="am-form-group" style="font-size: 16px;">
				<label style="padding-bottom: 5px;">支付方式：</label>
				<div style="padding-top: 5px; padding-bottom: 5px">
					<input onclick="pay()" type="radio" id="yue" name="payment" value="money" checked/><label for="yue">&nbsp;积分支付(余额:{$userinfo->j_money}元)</label>
				</div>
				<!--
				<div style="padding-top: 5px; padding-bottom: 5px">
					<input onclick="pay()" type="radio" id="wpy" name="payment" value="wxzhifu"/><label for="wpy">&nbsp;微信在线支付</label>
				</div>
				-->
			</div>
			<input type="submit" class="am-btn am-btn-success am-btn-block" value="提交"/>
	  	</fieldset>
	</form>
</div>
<p class="lheight"></p>
</section>
</body>
</html>
