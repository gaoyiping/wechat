<html>
<head>
<title>userlist</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body> 
<table border="1" >
    <tr> 
      
         <td align="center">序</td>
	   <td><div align="center">店铺账号</div></td>
	    <td><div align="center">店主姓名</div></td>
	     <td><div align="center">本店店补</div></td>
	      <td><div align="center">归属店店补</div></td>
	      
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
        <div align="center">{$item->bname}</div></td>
        <td><div align="right">{$item->b_money|sprintf}&nbsp;</div></td>
	<td><div align="right">{$item->j_money|sprintf}&nbsp;</div></td>
	
        <td><div align="right" style='color:#120DD2;'>
{$item->y_money|sprintf}&nbsp;
</div></td>
      <td><div align="center">
	{$item->byhname}</div></td>
<td><div align="center">
	{$item->byinhang}</div></td>
	
      

	
     
      <td><div align="center">
	{$item->byhsNo}</div></td>
	
     
      <td><div align="center">
	{$item->byinhangdiqu}</div></td>
	
     
      <td><div align="center">
	{$item->btel}</div></td>
	

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