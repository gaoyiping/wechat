<html>
<head>
<title>tixianlist</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body> 
<table border="1px">
  <tr>
    <td align="center">申请时间</td>
    <td align="center">审核时间</td>
    <td align="center">金额</td>
    <td align="center">开户行</td>
    <td align="center">所在地</td>
    <td align="center">户名</td>
    <td align="center">银行卡号</td>
    <td align="center">ID号</td>
    <td align="center">手机</td>
    <td align="center">审核</td>
  </tr>
  {foreach from=$list item=item name=f1}
  <tr>
    <td>{$item->add_date}</td>
    <td>{$item->replay_date}</td>
    <td align=right><font color="red">{$item->amount}</font></td>
    <td>{$item->byinhang}</td>
    <td>{$item->byinhangdiqu}</td>
    <td>{$item->byhname}</td>
    <td align=left>'{$item->byhsNo}</td>
    <td>{$item->operation}</td>
    <td>{$item->btel}</td>
    <td align=center>{if $item->status==0}<font color=red>未</font>{/if}
      {if $item->status==1}<font color=green>已</font>{/if}</td>
  </tr>
  {/foreach}
</table>
</body>
</html>