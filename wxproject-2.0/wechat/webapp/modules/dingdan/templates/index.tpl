<html>
<head>
<title>零售商品</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />

    <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
<script>
{literal}
    function AlertMessageBox()
    {

	        
	         
    }
        function Showopen(sNo)
        {
	
            showPopWin('查看订单详细信息',"index.php?module=dingdan&action=view&sNo="+sNo, 620, 440, AlertMessageBox,true,true)
        }
</script>
{/literal}
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
                                &nbsp;<span class="Font_red Font_addbold">[进销存管理]</span> >> 销售管理
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="dingdan" />
<table width="95%" border=0 align="center">
  <tr><td>
   销售单号 
      <input name="sNo" value="" size="8" class="button1" />
      &nbsp;顾客姓名 
      <input name="name" value="" size="8" class="button1" />
      &nbsp;顾客电话 
      <input name="tel" value="" size="8" class="button1" />
    &nbsp;销售日期
      <input name="startdate" value="{$startdate}" size="8" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
      至
      <input name="enddate" value="{$enddate}" size="8" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
  <input type="submit" value=" 查 询 " class="b02">
  </td><td align="right">
<p align="right">



</p>
  </td></tr>
</table>
</form></div>
<br />
<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3"> 
     <td width="5%"  align="center">序</td>
        <td width="20%"><div align="center"><font color="#FFFFFF">销售单号</font></div></td>
      <td width="20%"><div align="center"><font color="#FFFFFF">顾客名称</font></div></td>
        <td width="10%"><div align="center"><font color="#FFFFFF">联系电话</font></div></td>
  
        
  
       <td width="5%"><div align="center"><font color="#FFFFFF">销售金额</font></div></td>
        <td width="8%"><div align="center"><font color="#FFFFFF">销售时间</font></div></td>

      <td width="10%"><div align="center"><font color="#FFFFFF">操作</font></div></td>
    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr class="td4"> 
            <td align="center">{$smarty.foreach.f1.iteration}</td>
     <td>
        <div align="center">{$item->sNo}</div></td>
      <td> 
        <div align="center">{$item->gname}</div></td>
      
   
    <td> 
        <div align="center">{$item->rtel}</div></td>
      
   
	

    
	
	
	<td >
        <div align="center">￥{$item->zongji}</div></td>
      <td>
      <div align="center">{$item->pubdate}</div></td>
      <td>
        <div align="center">
          <a href="#" onclick="Showopen('{$item->sNo}');">查看详细</a> 
                 
        </div></td>
    </tr>
    {/foreach}
  </table>
</td></tr></table>
<br/>
<table align="center"><tr><td>
	{$pagehtml}
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
