<html>
<head>
<title>确认并支付订单</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<script type="text/javascript" src="modpub/js/check.js"> </script>
{literal}<script type="text/javascript">
function check(f)
{
  var emoneys = parseInt(f.emoneys.value);
  var e_money = parseInt(f.e_money.value);
  var card_name = f.card_name.value;
  var address = f.address.value; 
  var mobile = f.mobile.value;
  var ok = document.getElementById("btn_ok");
  if (e_money < emoneys) {
    alert("电子货币不足，无法下单！");
    ok.value = "电子货币不足"; ok.disabled = true; return false;
  }
  if (card_name == '' || address == '' || mobile == '') {
    alert("收货人信息不完整，请在 ^信息修改^ 页面补充完整，再下单！");
    ok.value = "收货人信息不完整"; ok.disabled = true; return false; 
  }
  return confirm("确定下单支付吗？");
}
</script>{/literal}
</head>
<body>
<br/><div class="fontTop">确认并支付订单</div><hr/><br/>

<p style="margin: 0;padding: 0 10px;">
  <input class="b02" type="button" 
    onclick="location.href='index.php?module=RProduct&action=cartView';" value="返回购物车"/></p>
<div style="border: 1px solid #B0D1EE;padding: 10px;margin: 10px;">
<p><font color="red">*</font><strong>本次购买清单</strong>
  </p> </br>
<table width="90%" align="center" border="0" bgcolor="#B0D1EE" border="0" cellpadding="0" cellspacing="0">
<tr><td>
  <table width="100%" border="0" cellpadding="5" cellspacing="2">
    <tr class="td3" height="25px">
      <td align="center"><strong>商品名称</strong></td>
      <td align="center"><strong>单价</strong></td>
      <td align="center" width="100px"><strong>数量</strong></td>
      <td align="center"><strong>支付金额</strong></td>
    </tr>
{foreach from=$cart->rpros item=item}
    <tr bgcolor="#FFFFFF" height="35px">
      <td align="center">{$item->pname}</td>
      <td align="center">{$item->cost}</td>
      <td align="center">{$item->count}</td>
      <td align="center">{$item->money}</td>
    </tr>
{/foreach}
  </table>
</td></tr></table>
<br/>

<p><font color="red">*</font><strong>本次购物总计</strong> &nbsp; 
  总件数：<font color="red">{$cart->base.counts}</font> 
  总金额：<font color="red">￥{$cart->base.moneys}</font> 
</p>
<br/>
<br/>
<br/>

<p><font color="red">*</font><strong>收货人信息</strong>【<font color="red">系统默认的收货姓名为银行开户名, 如果下面所提示的资料有误, 请在‘信息修改’中修改后再进行提交！</font>】</p><br />
<table width="90%" align="center" border="0" bgcolor="#B0D1EE" border="0" cellpadding="0" cellspacing="0"><tr><td>
  <table width="100%" border="0" cellpadding="5" cellspacing="2">
    <tr>
      <td bgcolor="EBF4FB" align="right" width="20%"><strong>电子货币余额：</strong></td>
      <td bgcolor="#FFFFFF">{$express->e_money}</td></tr>
    <tr>
      <td bgcolor="EBF4FB" align="right"><strong>收货人姓名：</strong></td>
      <td bgcolor="#FFFFFF">{$express->card_name}</td></tr>
    <tr>
      <td bgcolor="EBF4FB" align="right"><strong>收货地址：</strong></td>
      <td bgcolor="#FFFFFF">{$express->address}</td></tr>
    <tr>
      <td bgcolor="EBF4FB" align="right"><strong>联系方式：</strong></td>
      <td bgcolor="#FFFFFF">{$express->mobile}</td></tr>
  </table>
</td></tr></table>
<br/>

<form name="form1" action="index.php?module=Order" method="post" onsubmit="return check(this);">
  <input type="hidden" name="emoneys" value="{$cart->base.emoneys}" />
  <input type="hidden" name="e_money" value="{$express->e_money}" />
  <input type="hidden" name="card_name" value="{$express->card_name}" />
  <input type="hidden" name="address" value="{$express->address}" />
  <input type="hidden" name="mobile" value="{$express->mobile}" />  
  <div style="width:90%;text-align:center;">
  <input style="background-color:red;color:white;" type="submit" id="btn_ok" value="确定支付" />
  </div>
</form>
<br/>

</div>

</body>
</html>
