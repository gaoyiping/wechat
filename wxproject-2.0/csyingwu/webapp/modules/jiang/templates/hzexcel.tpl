<html>
<head>
<title>userlist</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body> 
<table border="1px">
  <tr>
  	<td align="center">期数</td>
    <td align="center">店铺编号</td>
    <td align="center">店铺名称</td>
    <td align="center">联系人</td>
    <td align="center">电话</td>
    <td align="center">银行开户名</td>
    <td align="center">银行开户账号</td>
    <td align="center">分红</td>
    <td align="center">扣税</td>
    <td align="center">应发</td>
  </tr>
  {foreach from=$rpros item=item name=f1}
  <tr>
  	<td align="center">{$item->sNo}期</td>
    <td align="center">{$item->userid}</td>
    <td align="center">{$item->user_name}</td>
    <td align="center">{$item->e_mail}</td>
    <td align="center">{$item->mobile}</td>
    <td align="center">{$item->card_type}</td>
    <td align="center">'{$item->card_number}</td>
    <td align="center">{$item->kaituo_money}</td>
    <td align="center">{$item->tax_money}</td>
    <td align="center">{$item->s_money}</td>
  </tr>
  {/foreach}
</table>
</body>
</html>