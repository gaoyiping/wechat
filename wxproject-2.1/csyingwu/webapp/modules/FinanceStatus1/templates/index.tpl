<html>
<head>
<title>店铺奖金</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="modpub/css/base.css">
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
    <script type='text/javascript' src='modpub/js/calendar.js'> </script>

</head>
<body scroll="yes">
 <div style="border:solid 1px #dedede;padding:10px;background:#EDF1F8;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<table width="95%" border=0 align="center">
  <tr><td>
   
      当前账号：{$userid} &nbsp;&nbsp;&nbsp; 本店店补:￥{$amounts|default:"0"}.00&nbsp;&nbsp;&nbsp;
      归属店店补：￥{$kaituo_amounts|default:"0"}.00&nbsp;&nbsp;&nbsp;
   
      奖金总计：￥{$amounts1|default:"0"}.00
  </td></tr>
</table>
</div>
			    <br />


<table  border=0 cellpadding=3 cellspacing=1 width=98% align="center" bgcolor="#F7F8F8" style="border:solid 1px #CDD7DC">
  <tr><td valign=top align=center height=100% width=100%>  
    <table width="100%"  border="0" cellpadding="0" cellspacing="0" >
      <tr><td></td></tr>
      <tr><td height="20" width="100%" valign=top>        

      </td></tr>
      <tr><td align="center">
        <table border="0" cellpadding=4 cellspacing=0 width=100%>
          <tr><td colspan=9 bgcolor=#5B7C8F height=1></td></tr>
          <tr bgcolor=#5B7C8F>
 <td width="9%"><div align="center"><font color="#FFFFFF">期数</font></div></td>

	     <td width="15%"><div align="center"><font color="#FFFFFF">本店店补</font></div></td>
	      <td width="15%"><div align="center"><font color="#FFFFFF">归属店店补</font></div></td>
	  
	     
   <td width="10%"><div align="center"><font color="#FFFFFF">应发</font></div></td>
      <td width="11%"><div align="center"><font color="#FFFFFF">结算日期</font></div></td>
      
      
      <td width="8%"><div align="center"><font color="#FFFFFF">状态</font></div></td>
      </tr>
      {foreach from=$list item=item name=f1}
      <tr bgColor=#ffffff>
       <td align="center">{$item->sNo}期</td>
	<td> <div align="center">{$item->b_money|sprintf} </div></td>
      <td>  <div align="center">{$item->j_money|sprintf}</div></td>
     
	
        <td><div align="center">
{$item->y_money|sprintf}
</div></td>
	<td><div align="center">
	{$item->add_date|date_format:'%Y-%m-%d'}</div></td>
	
      <td>
        <div align="center">
	
        {if $item->isf==0}未发放{else}<font color="red">已发放</font>{/if}  
        </div></td>
      </tr>
      {/foreach}
   <tr><td colspan=9 bgcolor=#666666 height='1'></td></tr>
       <td colspan=9 bgcolor=#5B7C8F height='1'></td></tr>
          <tr><td colspan=9 align='center' height=25>
<table align="center"><tr><td>
<div class="pages">
  {$pagehtml}
  </div>
</td></tr></table>
</td></tr>
        </table>      
      </td></tr>
    </table>
  </td></tr>
</table>
</form>

</body>
</html>
