<html>
<head>
<title>复消浏览</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="modpub/css/base.css">
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
    <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
   <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />

         {literal}
<script language="JavaScript" >
function AlertMessageBox()
    {

	        
	         
    }
        function Showopen(userid)
        {
	
            showPopWin('查看会员信息',"index.php?module=CertifiedUserList&action=view&userid="+userid, 600, 320, AlertMessageBox,true,true)
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
                                &nbsp;<span class="Font_red Font_addbold">[复消专区]</span> >> 复消浏览 
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">

<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="fuxiao" />
<table width=95% border=0 align="center" >
  <tr><td>
   年份
      <input type='text' name='tyear' size='10' value="{$tyear}" class="button1"/>
       <input type="submit" value="查 询" class="b02">
   
  </td></tr>
</table>
</form></div>
<br />

<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%">
  <tr><td>
<table width=100% class="tableclass" cellpadding="5" cellspacing="1" border="0">
  <tr class="td3">
    <td width="3%" align="center">序</td>
      <td width="9%" align="center">用户ID</td>
    <td width="9%" align="center">店铺名称</td>
      <td width="9%" align="center">pv值</td>
    <td width="9%" align="center">复消月份</td>
    <td width="10%" align="center">增加时间</td>

    <!--<td width="10%" align="center">操作</td>
  --></tr>
  {foreach from=$fuxiaolist item=item name=f1}
  <tr bgColor=#FFFFFF>
    <td align="center">{$smarty.foreach.f1.iteration}</td>
    <td align="center">&nbsp;{$item->userid}</td>
    <td align="center">&nbsp;{$item->dianpu}</td>
    <td align="center">&nbsp;{$item->pv}pv</td>
    <td align="center">&nbsp;{$item->fuxiaodate}</td>
    <td align="center">&nbsp;{$item->adddate|date_format:'%Y-%m-%d'}</td>
   
    <!--<td align="center"><a href="index.php?module=CertifiedUserList&action=modify&id={$item->user_id}" >修改</a> | <a href="#" onclick="Showopen('{$item->user_id}');">查看</a></td>
  --></tr>
  {/foreach}
</table>
</td></tr>
</table>
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