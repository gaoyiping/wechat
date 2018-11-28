<html>
<head>
<title>订单查看</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
</head>
<body>
<br/><div class="fontTop">查看支付结果</div><hr/><br/>

<div style="border: 1px solid #B0D1EE;padding: 10px;margin: 10px;">
<p style="color: green;font-size: 18px;">订单已成功支付</p>
<table width="90%" align="center" border="0" bgcolor="#B0D1EE" border="0" cellpadding="0" cellspacing="0"><tr><td>
  <table width="100%" border="0" cellpadding="5" cellspacing="2">
    <tr bgcolor="#EBF4FB" height="25px">
      <td align="center"><strong>商品名称</strong></td>
      <td align="center"><strong>单件商品价格</strong></td>
      <td align="center" width="100px"><strong>购买数量</strong></td>
      <td align="center"><strong>支付价格</strong></td>
      <td align="center"><strong>提供资料</strong></td>
    </tr>
{foreach from=$orderdetail item=item}
    <tr bgcolor="#FFFFFF" height="35px">
      <td align="left">{$item->pname}</td>
      <td align="right">{$item->cost}</td>
      <td align="center">{$item->count}</td>
      <td align="right">{$item->money}</td>
      <td align="center">{if $item->is_withinfo=='1'}是{else}否{/if}</td>
    </tr>
{/foreach}
  </table>
</td></tr></table>
<br/>

<p>本次购物，
  支付电子货币：￥<strong style="font-size:18px;color:red;">{$order->emoneys}</strong>，
  剩余电子货币：￥<strong style="font-size:18px;color:red;">{$order->e_money}</strong>。</p>
<br/>

<p><input class="button1" type="button" style="cursor: pointer;" 
  onclick="location.href='index.php?module=RProduct';" value="返回商品列表" /></p>
<br/>

</div>

</body>
</html>
