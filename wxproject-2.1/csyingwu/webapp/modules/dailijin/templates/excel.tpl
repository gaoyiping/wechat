<html>
<head>
<title>userlist</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body> 
<table border="1" >
    <tr> 
      
         <td align="center">序</td>
	   <td><div align="center">账号</div></td>
	    <td><div align="center">姓名</div></td>
	     <td><div align="center">推荐奖</div></td>
	      <td><div align="center">发展奖</div></td>
	       <td><div align="center">培养奖</div></td>
	        <td><div align="center">扣重复消费金</div></td>
		 <td><div align="center">扣税</div></td>
   <td><div align="center">应发</div></td>
    <td><div align="center">开户名</div></td>
     <td><div align="center">开户银行</div></td>
      <td width="200"><div align="center">银行账号</div></td>
       <td><div align="center">银行地址</div></td>
        <td><div align="center">联系电话</div></td>
      <td><div align="center">结算日期</div></td>
      
      
      <td><div align="center">状态</div></td>
    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr> 
  
        <td align="center">{$smarty.foreach.f1.iteration}</td>
	 <td> 
        <div align="center">{$item->userid} </div>

	</td>
      <td> 
        <div align="center">{$item->user_name}</div></td>
        <td><div align="right">{$item->t_money|sprintf}&nbsp;</div></td>
	<td><div align="right">{$item->f_money|sprintf}&nbsp;</div></td>
	<td><div align="right">{$item->p_money|sprintf}&nbsp;</div></td>
	<td><div align="right">{$item->c_money|sprintf}&nbsp;</div>


	</td>
	<td><div align="right">
	
{$item->k_moeny|sprintf}</div></td>
        <td><div align="right" style='color:#120DD2;'>
{$item->y_money|sprintf}&nbsp;
</div></td>
<td><div align="center">
	{$item->card_type}</div></td>
	
      
      <td><div align="center">
	{$item->card_name}</div></td>
	
     
      <td style="vnd.ms-excel.numberformat:@">{$item->card_number}</td>
	
     
      <td><div align="center">
	{$item->provcity}</div></td>
	
     
      <td><div align="center">
	{$item->mobile}</div></td>
	

	<td><div align="center">
	{$item->add_date|date_format:'%Y-%m-%d'}</div></td>
	
      <td>
        <div align="center">
	
        {if $item->isf==0}未发放{else}<font color="red">已发放</font>{/if}  
        </div></td>
    </tr>
    {/foreach}
  </table>
</body>
</html>