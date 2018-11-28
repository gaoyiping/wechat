<html>
<head>
<title>零售订单</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="modpub/css/base.css">

    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
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
	
            showPopWin('查看订单详细信息',"index.php?module=weitongguo&action=view&sNo="+sNo, 640, 400, AlertMessageBox,true,true)
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
                                &nbsp;<span class="Font_red Font_addbold">[进销存管理]</span> >> 未通过预订单
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible;"
                            id="Div_Content">
<div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="HandleOrder" />
<input type="hidden" name="ok" value="1" />
<table width="98%" border=0 align="center"> 
  <tr><td>
    <a href="index.php?module=HandleOrder">我的订单</a><font color="#1C0ED5">({$num->num1})</font> 
 
    | <a href="index.php?module=weitongguo" ><b>未通过订单</b></a><font color="#1C0ED5">({$num->num5})</font>&nbsp;&nbsp;订货日期
      <input name="startdate" value="{$startdate}" size="8" readonly class="button1"/>
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
      至
      <input name="enddate" value="{$enddate}" size="8" readonly class="button1"/>
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
   <input type="submit" value="查询" class="b02"/>
  </td><td align="right">
<p align="right">

</p>
  </td></tr>
</table>
</form>
</div> <br />
<table align="center"  border="0" cellpadding="0" cellspacing="0" width="98%" bgcolor="#dedede" >
	<tr><td>
		<table align=center border="0" cellpadding="4" cellspacing="1" width="100%" >
			<tr class="td3">
 
        <td width="20px" align="center">序</td>
	<td align="center">订单号</td>
	<td width="80px" align="center">店铺账号</td>
	<td width="80px" align="center">订货人</td>
	<td width="80px" align="center">联系电话</td>
				<td width="80px" align="center">订货日期</td>
				<td align="center">未通过原因</td>
				
				
			        <td  align="center">操作</td>
			</tr>
			{foreach from=$list item=item1 name=f1}
			<tr bgcolor="white">

        <td align="center">{$smarty.foreach.f1.iteration}</td>
	<td align="center">{$item1->sNo}</td>
		<td align="center">{$item1->user_id}</td>
	<td align="center">{$item1->post_name}</td>
	<td align="center">{$item1->post_tel}</td>
				<td align="center">{$item1->add_date|date_format:'%Y-%m-%d'}</td>
				
				<td align="center">{$item1->yuanyin}</td>
		
				
	
			      <td align="center"> <a href="#" onclick="Showopen('{$item1->sNo}');">查看详细</a></td>
			</tr>
      {/foreach}
		</table>
	</td></tr>
 
</table>
<br />
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