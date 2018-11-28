<html>
<head>
<title>userlist</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body> 
<table border="1px">
  <tr>
    <td align="center">店铺编号</td>
    <td align="center">店铺名称</td>
    <td align="center">联系人</td>
    <td align="center">聘位</td>
    <td align="center">手机号码</td>
    <td align="center">注册时间</td>
  </tr>
  {foreach from=$userlist item=item name=f1}
  <tr>
    <td align="center">{$item->user_id}</td>
    <td align="center">{$item->user_name}</td>
     <td align="center">{$item->e_mail}</td>
    <td align="center">
	<font color="#116600">{if $item->level==0} 会员{/if}</font>
	<font color="#1166FF">{if  $item->level==1} 主管{/if}</font>
	<font color="#966F12">{if $item->level==2} 经理{/if}</font>
	<font color="#C40D74">{if  $item->level>=3} 总监{/if}</font>
	</td>
    <td align="right">{$item->mobile}</td>
    <td align="center">{$item->add_date}</td>
  </tr>
  {/foreach}
</table>
</body>
</html>