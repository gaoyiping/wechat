<html>
<head>
<title>零售商品</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
    <script type='text/javascript' src='modpub/js/calendar.js'> </script>
</head>
<body scroll="yes">
<div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;"><form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="dianpuxiaoshou" />
<table width="95%" border=0 align="center">
  <tr><td>
  
  

&nbsp;&nbsp;产品关键字 
      <input name="keyword" value="{$keyword}" size="8" class="button1" />
    订购日期
      <input name="startdate" value="{$startdate}" size="8" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
      至
      <input name="enddate" value="{$enddate}" size="8" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
  <input type="submit" value=" 查 询 " class="b02">

  </td></tr>
</table>
</form></div>
<br />
<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="98%"><tr><td>
  <table border="0" cellpadding="2" cellspacing="1" width="100%">
    <tr class="td3"> <td width="5%"  align="center">序</td> 
      <td width="17%"><div align="center"><font color="#FFFFFF">订单号</font></div></td>
        <td width="10%"><div align="center"><font color="#FFFFFF">产品编号</font></div></td>
        <td width="19%"><div align="center"><font color="#FFFFFF">产品名称</font></div></td>
  
      
  
         <td width="7%"><div align="center"><font color="#FFFFFF">单位</font></div></td>
      <td width="7%"><div align="center"><font color="#FFFFFF">数量</font></div></td>
       <td width="9%"><div align="center"><font color="#FFFFFF">订购价格</font></div></td>
       <td width="9%"><div align="center"><font color="#FFFFFF">小计</font></div></td>
        <td width="11%"><div align="center"><font color="#FFFFFF">订购日期</font></div></td>
     
    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr class="td4">  <td align="center">{$smarty.foreach.f1.iteration}</td>
             
    <td> 
        <div align="center">{$item->rliushui}</div></td>
	  <td> 
        <div align="center">{$item->rsNo}</div></td>
     <td>
        <div align="center">{$item->rname}</div></td>

      

      
   
	 <td>
        <div align="center">{$item->rdanwei}</div></td>
    
	<td>
        <div align="center">{$item->rnum}</div></td>
	<td>
        <div align="center">￥{$item->shoujia}</div></td>
	    <td>
        <div align="center">￥{$item->shoujia*$item->rnum}</div></td>
	<td>
        <div align="center">{$item->rdate|date_format:'%Y-%m-%d'}</div></td>

    </tr>
    {/foreach}
  </table>
</td></tr></table>
<br/>
<table align="center"><tr><td>
	{$pagehtml}
</td></tr></table>


</body>
</html>
