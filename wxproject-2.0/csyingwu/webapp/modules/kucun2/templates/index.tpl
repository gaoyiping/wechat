<html>
<head>
<title>零售商品</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
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
                                &nbsp;<span class="Font_red Font_addbold">[进销存管理]</span> >> 库存管理
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="HandleOrder" />
<table width="95%" border=0 align="center">
  <tr><td>
   <a href="index.php?module=kucun2"><b>库存管理</b></a> | <a href="index.php?module=xiaoshou" >销售明细</a> | <a href="index.php?module=kucun" >入库明细</a> | <a href="index.php?module=kucun1" >出库明细</a> | <a href="index.php?module=zengpin" >赠品明细</a>  
  </td><td align="right">
<p align="right">
<input type="button" class="b02" value="产品入库" onclick="location.href='index.php?module=kucun&action=add';" />
<input type="button" class="b02" value="产品出库" onclick="location.href='index.php?module=kucun1&action=add';" />
  <input type="button" value="导出本页" class="b02"  >
   <input type="button" value="导出全部页" class="b02"  >

</p>
  </td></tr>
</table>
</form></div>
<br />
<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3"> 
     <td width="3%"  align="center">序</td>
        <td width="15%"><div align="center"><font color="#FFFFFF">产品名称</font></div></td>
      <td width="10%"><div align="center"><font color="#FFFFFF">产品编号</font></div></td>

         <td width="7%"><div align="center"><font color="#FFFFFF">单位</font></div></td>
  
       <td width="8%"><div align="center"><font color="#FFFFFF">入库数量</font></div></td>
        <td width="8%"><div align="center"><font color="#FFFFFF">销售数量</font></div></td>
	<td width="8%"><div align="center"><font color="#FFFFFF">其他出库</font></div></td>
	<td width="8%"><div align="center"><font color="#FFFFFF">赠品数量</font></div></td>
	 <td width="8%"><div align="center"><font color="#FFFFFF">库存数量</font></div></td>
      <td width="22%"><div align="center"><font color="#FFFFFF">操作</font></div></td>
    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr class="td4"> 
            <td align="center">{$smarty.foreach.f1.iteration}</td>
     <td>
        <div align="center">{$item->rname}</div></td>
      <td> 
        <div align="center">{$item->rsNo}</div></td>

  
	 <td>
        <div align="center">{$item->rdanwei}</div></td>
    
	
	<td >
        <div align="center">{if $item->ruku==""}0{/if}
	                    {if $item->ruku!=""}{$item->ruku}{/if}</div></td>
	<td>
        <div align="center">{if $item->xiaoshou==""}0{/if}
	                    {if $item->xiaoshou!=""}{$item->xiaoshou}{/if}</div></td>
	<td>
        <div align="center">{if $item->chuku==""}0{/if}
	                    {if $item->chuku!=""}{$item->chuku}{/if}</div></td>

			    <td>
        <div align="center">{if $item->zengpin==""}0{/if}
	                    {if $item->zengpin!=""}{$item->zengpin}{/if}</div></td>
      <td>
      <div align="center">{$item->ruku-$item->chuku-$item->xiaoshou-$item->zengpin}</div></td>
      <td>
        <div align="center">
          <a href="index.php?module=kucun&keyword={$item->rsNo}">入库</a>  |
       
          <a href="index.php?module=xiaoshou&keyword={$item->rsNo}">销售</a> |
       
          <a href="index.php?module=kucun1&keyword={$item->rsNo}">出库</a>
	  |
       
          <a href="index.php?module=zengpin&keyword={$item->rsNo}">赠品</a>
                 
        </div></td>
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
