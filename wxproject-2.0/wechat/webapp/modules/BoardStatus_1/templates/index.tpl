<html>
<head>
<title>茶馆安置关系图</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="modpub/css/base.css" />

   <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
{literal}
<script type="text/javascript">
function fenxi(no){
  if (document.getElementById('fenxi')) {
    var url = 'index.php?module=BoardStatus&action=back&boardno='+no;
    ajax(url,function(text){
      document.getElementById('fenxi').style.display = 'none';
      document.getElementById('showFenXi').innerHTML = text;
    });
    document.getElementById('fenxi').innerHTML = 'Loading...';  
  }
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
                                &nbsp;<span class="Font_red Font_addbold">[商务中心]</span> >> 销售部门浏览
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br/>
  <form name="form1" action="index.php" method="get">
			    <input type="hidden" name="module" value="BoardStatus" />
<table align="center"  border="0" cellpadding="0" cellspacing="0" width="98%"><tr><td>

 <input type="text" style="width:20px; height:20px;background-color:#116600" /> 会员  
 <input type="text" style="width:20px; height:20px;background-color:#1166FF" /> 主管
 <input type="text" style="width:20px; height:20px;background-color:#966F12" /> 经理
 <input type="text" style="width:20px; height:20px;background-color:#C40D74" /> 总监
 <!--<input type="text" style="width:20px; height:20px;background-color:#171617" />  VIP卡-->
  
</td></tr></table>

<div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:10px;border-top:solid 1px #dedede; border-left:solid 1px #fff;border-right:solid 1px #fff; ">
会员账号：<input type="text" name="userid" class='button1' value="{$userid}" style="width:100px;" />      
<input class="b02"  type="submit" value="查 询"   />&nbsp;&nbsp;<a {$link} style='color:red;'>点击查看上一级</a></div>
</form>
<br />

<table width="385" cellpadding="1" cellspacing="0"  bgcolor="#375A6E" align="center">
    <tr>
     <td  align="center" style="padding:5px;color:#fff;">
            销售一部
        </td>
        <td  align="center" valign="top">
            {$board2}
        </td>
	<td  align="center" valign="top">
            {$board5}
        </td>
	<td  align="center" valign="top">
            {$board6}
        </td>
	<td  align="center" valign="top">
            {$board7}
        </td>
    </tr>
     <tr>
      <td  align="center" style="padding:5px;color:#fff;">
            销售二部
        </td>
        <td  align="center" valign="top">
            {$board3}
        </td>
	<td  align="center" valign="top">
            {$board8}
        </td>
	<td  align="center" valign="top">
            {$board9}
        </td>
	<td  align="center" valign="top">
            {$board10}
        </td>
    </tr>
     <tr>
      <td  align="center" style="padding:5px;color:#fff;" >
            销售三部
        </td>
        <td  align="center" valign="top">
            {$board4}
        </td>
	<td  align="center" valign="top">
            {$board11}
        </td>
	<td  align="center" valign="top">
            {$board12}
        </td>
	<td  align="center" valign="top">
            {$board13}
        </td>
    </tr>
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