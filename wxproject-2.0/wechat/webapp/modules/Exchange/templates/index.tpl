<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
 <script type='text/javascript' src='modpub/js/calendar.js'> </script>
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
{literal}
<script type="text/javascript">
    function AlertMessageBox()
    {

	        location.href='index.php?module=Exchange';
	         
    }
        function Showopen()
        {
	
            showPopWin('电子货币转账',"index.php?module=Exchange&action=add", 560, 300, AlertMessageBox,true,true)
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
                                &nbsp;<span class="Font_red Font_addbold">[财务管理]</span> >> 电子货币转账
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible;"
                            id="Div_Content">
			    <div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="Exchange" />
<table width="95%" border=0 align="center">
  <tr><td>
  


 转账日期
      <input name="startdate" value="{$startdate}" size="7" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
      至
      <input name="enddate" value="{$enddate}" size="7" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
   <input type="submit" value=" 查 询 " class="b02"  >
   &nbsp; <input type="button" value=" 转 账 " onclick="Showopen();" class="b02"  >
  </td></tr>
</table>
</form></div>
			  <br />
<table width="95%" align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0">
  <tr><td>
    <table width=100% align=center border="0" cellpadding="5" cellspacing="1">
      <tr class="td3">
       <td width="5%" align="center"><font color="#FFFFFF">序</font></td>
        <td width="10%" align="center"><font color="#FFFFFF">转账账号</font></td>
        <td width="10%" align="center"><font color="#FFFFFF">接收账号</font></td> 
        <td width="10%" align="center"><font color="#FFFFFF">转账金额</font></td>
        <td width="10%" align="center"><font color="#FFFFFF">接收金额</font></td>
	<td width="35%" align="center"><font color="#FFFFFF">备注</font></td>
        <td width="15%" align="center"><font color="#FFFFFF">转账日期</font></td>
      </tr>
      {foreach from=$list item=item name=f1}
      <tr bgColor=#ffffff>
           <td> 
        <div align="center">{$smarty.foreach.f1.iteration}</div></td>
    
<td>
  {$item->operation}
</td>
        <td>
	 {$item->accepter}
	
	</td>
        <td align="center">￥{$item->amount}</td>
	     <td align="center">￥{$item->amount}</td>
	      <td align="center">{$item->cfnumber}</td>
	          <td align="center">{$item->add_date}</td>
      </tr>
      {/foreach}
    </table>
  </td></tr>
  
</table>

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
