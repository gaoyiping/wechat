<html>
<head>
<title>员工信息列表</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="modpub/css/base.css">
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
</head>
   <link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
    <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />

<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
<script type="text/javascript">
{literal}
 function AlertMessageBox(file_name)
 {
 }
      function ShowDepartID(userid)
        {
            showPopWin("查看店铺"+userid+"销售情况","index.php?module=dianpuxiaoshou&userid="+userid, 650, 400, AlertMessageBox,true,true)
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
                                &nbsp;<span class="Font_red Font_addbold">[担保的专卖店]</span> >> 店铺列表 
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">

<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="danbaodianpu" />
<input type="hidden" name="inter_flag" value="{$inter_flag}" />
<table width=95% border=0 align="center">
  <tr><td>
    店铺关键字
      <input type='text' name='keyword' size='10' value="{$keyword}" class="button1" />
    &nbsp;&nbsp;店铺类型<select id="dianputype" name="dianputype">
    <option value='' {if $dianputype==""}selected{/if}  >全部</option>
<option value='1' {if $dianputype=="1"}selected{/if} >专卖店</option>
<option value='2' {if $dianputype=="2"}selected{/if} >旗舰店</option>
<option value='3'{if $dianputype=="3"}selected{/if}  >形象店</option>
<option value='4'{if $dianputype=="4"}selected{/if}  >省代理</option>
<option value='5'{if $dianputype=="5"}selected{/if}  >市代理</option>
</select>

     <input type="submit" value="查 询" class="b02">
   
  </td></tr>
</table>
</form></div>
<br />
<table align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" width="95%">
  <tr><td>
<table width=100% align=center border="0" cellpadding="5" cellspacing="1" bgcolor="#dedede">
  <tr class="td3">
    <td width="4%" align="center">序</td>
    <td width="7%" align="center">店铺帐号</td>
     <td width="14%" align="center">店铺名称</td>
    <td width="10%" align="center">店铺地区</td>
    <td width="7%" align="center">店主姓名</td>
    <td width="6%" align="center">店铺类型</td>
    <td width="6%" align="center">联系电话</td>
    
	
   

  <td width="8%" align="center">合同时间</td>
   <td width="8%" align="center">操作</td>

 
  </tr>
  {foreach from=$userlist item=item name=f1}
  <tr bgColor=#FFFFFF>
    <td align="center">{$smarty.foreach.f1.iteration}</td>
    <td align="center">&nbsp;{$item->user_id}</td>
 <td align="center">&nbsp;{$item->dianpuname}</td>
    	<td align="center">&nbsp;
 	      {foreach from=$countryareas item=countryitem}
	        {if $item->G_ParentID == $countryitem->GroupID}
		{$countryitem->G_CName}
		{/if}
	    	{/foreach}- {$item->G_CName}
		</td>
    <td align="center">&nbsp;{$item->user_name}</td>
    <td align="center"> {if $item->dianputype=="1"}专卖店{/if}
 {if $item->dianputype=="2"}旗舰店{/if}
{if $item->dianputype=="3"}形象店{/if}
{if $item->dianputype=="4"}省代理{/if}
{if $item->dianputype=="5"}市代理{/if}
</td>
        <td align="center">&nbsp;{$item->mobile}</td>

	

   
           
    <td align="center">&nbsp;{$item->kaidiandate|date_format:'%Y-%m-%d'}</td>

    <td align="center"><a href="#" onclick="ShowDepartID('{$item->user_id}');">销售情况</a></td>
  </tr>
  {/foreach}
</table></td></tr>
</table>
<br/>
<p align="center">{$pagehtml}</p>

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
