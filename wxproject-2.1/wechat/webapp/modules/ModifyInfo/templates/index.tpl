<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<script type="text/javascript" src="modpub/js/check.js"> </script>
<title></title>
<link href="style/dialog/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="style/dialog/js/jquery.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/dialog.js" type="text/javascript"></script> 
</head>
<body class="white">
<header class="top"> 
<div class="text-center">收货地址管理</div>
<div class="action"><a href="javascript:window.history.back();" class="pull-left"><i class="am-icon-chevron-left"></i></a></div>
</header>
<section class="center">
	<p class="lheight"></p>
	<div class="new_add">
    <form name="f"  class="am-form" action="index.php?module=ModifyInfo" method='post' onsubmit="return SaveVal(this);">
    	<fieldset>
    		<div class="am-form-group">
    			<label for="doc-vld-name-2">联系人姓名：</label>
    			<input type="text" id="doc-vld-name-2" name="user_name" value="{$userinfo->user_name}"  placeholder="" required />
    		</div>
    		<div class="am-form-group">
    			<label for="doc-vld-email-2">联系人电话：</label>
    			<input type="text" name="mobile" value="{$userinfo->mobile}"  id="doc-vld-email-2" placeholder="" required/>
    		</div>
    		<div class="am-form-group">
    			<label for="doc-vld-ta-2">详细地址：</label>
    			<textarea id="doc-vld-ta-2" name="address">{$userinfo->address}</textarea>
    		</div>
    		<input type="submit" value="保存地址" class="am-btn am-btn-success am-btn-block" />
    	</fieldset>
    </form>
</div>
<p class="lheight"></p>
</section>
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  
</body>
</html>
