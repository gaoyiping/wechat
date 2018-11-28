<html>
<head>
<title>不同意提现</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="modpub/css/base.css">

</head>
<body scroll="yes">
<form name="form1" action="index.php?module=TiXianmember&action=del" method="post" onsubmit="return check(this)">
<input type="hidden" name="id" value="{$info->id}" />
<input type="hidden" name="userid" value="{$info->operation}" />
<input type="hidden" name="money" value="{$info->amount}" />
<div style='font-size:14px; padding:10px;'>
提现账号：{$info->operation} 提现金额： ￥{$info->amount} 元
</div>
<div style='font-size:14px; padding:10px;'>

<textarea name="content" 
              cols="50" rows="8" id="content" >提现申请失败,返回您￥{$info->amount}元 !</textarea> 
	       <div style='text-align:center;'> <input type="submit" name="Submit" value="提 交" class="b02"> </div>
</div>
</form>
</body>
</html>
