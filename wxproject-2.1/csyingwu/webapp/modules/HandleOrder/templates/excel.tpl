<html>
<head>
<title>orderlist</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body> 
<table border="1px">
	<tr>
    <td width="120px" align="center">申请时间</td>
    <td width="120px" align="center">审核时间</td>
    <td align="center">ID号</td>
    <td align="center">收件联系人</td>
    <td width="70px" align="center">收件手机</td>
    <td align="center">省</td>
    <td align="center">市</td>
    <td align="center">区(县)</td>
    <td align="center">地址</td>
    <td align="center">订单详情(序号、商品名、数量、产品代码)</td>
    <td width="50px" align="center">订单总计</td>
    <td width="50px" align="center">订购方式</td>
    <td width="30px" align="center">状态</td>
	</tr>
  {foreach from=$list item=item1 name=f1}
  <tr>
    <td align="center">{$item1->add_date}</td>
    <td align="center">{$item1->replay_date}</td>
    <td align="center">{$item1->user_id}</td>
    <td align="center">{$item1->post_name}</td>
     <td align="center">{$item1->post_tel}</td>
     <td align="center">{$item1->s1}</td>
      <td align="center">{$item1->s2}</td>
       <td align="center">{$item1->s3}</td>
    <td align="left">{$item1->post_address}</td>
   
    <td align="center" style="padding: 0;">
      <table border="0" cellpadding="3" cellspacing="0" width="100%" style="border-collapse: collapse;">
      {foreach from=$item1->details item=item2 name=f2}
        <tr>
          <td align="center" style="border:1px solid black;" width="10px">{$smarty.foreach.f2.iteration}</td>
          <td align="left" style="border:1px solid black;">{$item2.rname}</td>
          <td align="center" style="border:1px solid black;" width="15px">{$item2.rnum}套</td>
          <td align="center" style="border:1px solid black;" width="20px">{if $item2.pID==1}C{/if}{if $item2.pID==3}A{/if}{if $item2.pID==4}B{/if}</td>
        </tr>
      {/foreach}
      </table>
    </td>
    <td align="center">{$item1->moneys}</td>
    <td align="center">{if $item1->way=='1'}单次订购{elseif $item1->way=='2'}自动认购{/if}</td>
    <td align="center">{if $item1->status=='1'}已审核{else}未审核{/if}</td>
  </tr>
  {/foreach}
</table>
</body>
</html>