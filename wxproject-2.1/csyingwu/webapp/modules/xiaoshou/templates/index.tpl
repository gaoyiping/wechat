<html>
<head>
<title>零售商品</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
    <script type='text/javascript' src='modpub/js/calendar.js'> </script>
</head>
<body scroll="yes">
<div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        <script>
                                     
                        </script>

                        <div style="margin-top: -1px; height: 30px;  overflow: hidden" id="ctl00_Div_right_top"
                            class="YFTmainright_r1_c2_gj">
                            <div style="position: relative; line-height: 30px; width: 100%">
                                &nbsp;<span class="Font_red Font_addbold">[进销存管理]</span> >> 销售明细
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;"><form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="xiaoshou" />
<table width="95%" border=0 align="center">
  <tr><td>
   <a href="index.php?module=kucun2">库存管理</a> | <a href="index.php?module=xiaoshou" ><b>销售明细</b></a> | <a href="index.php?module=kucun" >入库明细</a>  | <a href="index.php?module=kucun1" >出库明细</a> | <a href="index.php?module=zengpin" >赠品明细</a>  &nbsp;&nbsp;产品关键字
      <input name="keyword" value="{$keyword}" size="7" class="button1" />
    销售日期
      <input name="startdate" value="{$startdate}" size="7" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
      至
      <input name="enddate" value="{$enddate}" size="7" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
  <input type="submit" value=" 查 询 " class="b02">
  </td></tr>
</table>
</form></div>
<br />
<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3">  
    <td width="3%"><div align="center"><font color="#FFFFFF">序</font></div></td>
        <td width="15%"><div align="center"><font color="#FFFFFF">商品名称</font></div></td>
	
      <td width="12%"><div align="center"><font color="#FFFFFF">商品编号</font></div></td>
        <td width="9%"><div align="center"><font color="#FFFFFF">订货帐号</font></div></td>

        <td width="12%"><div align="center"><font color="#FFFFFF">订单号</font></div></td>
  
         <td width="7%"><div align="center"><font color="#FFFFFF">单位</font></div></td>
      <td width="6%"><div align="center"><font color="#FFFFFF">数量</font></div></td>
 
        <td width="15%"><div align="center"><font color="#FFFFFF">销售日期</font></div></td>
      
    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr class="td4"> 
       <td align="center">{$smarty.foreach.f1.iteration}</td><td>
        <div align="center">{$item->rname}</div></td>
      <td> 
        <div align="center">{$item->rsNo}</div></td>
	 <td> 
        <div align="center">{$item->user_id}</div></td>
	
   
    <td> 
        <div align="center">{$item->rliushui}</div></td>
      
   
	 <td>
        <div align="center">{$item->rdanwei}</div></td>
    
	<td >
        <div align="center">{$item->rnum}</div></td>
	
	<td >
        <div align="center">{$item->rdate|date_format:'%Y-%m-%d'}</div></td>
     
    </tr>
    {/foreach}
  </table>
</td></tr></table>
<br/>
<table align="center"><tr><td>
<div class="pages">
  {$pagehtml}
  </div>
</td></tr></table>




 </div>
                    </td>
                </tr>
                <tr>
                    <td class="YFTmainright_r3_c2_gj" height="1">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>
</html>
