<html>
<head>
<title>用户奖金</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="modpub/css/base.css">
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
                                &nbsp;<span class="Font_red Font_addbold">[会员工作平台]</span> >> 我的工资情况
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content">   <div style="border:solid 1px #dedede;padding:10px;background:#EDF1F8;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<table width="95%" border=0 align="center">
  <tr><td>
   
      当前账号：{$userid} &nbsp;&nbsp;&nbsp; 推荐奖:￥{$amounts|default:"0"}.00&nbsp;&nbsp;&nbsp;
      发展奖：￥{$kaituo_amounts|default:"0"}.00&nbsp;&nbsp;&nbsp;
      培育奖：￥{$fenhong_amounts|default:"0"}.00&nbsp;&nbsp;&nbsp;
      重复消费金：￥{$jintie_amounts|default:"0"}.00&nbsp;&nbsp;&nbsp;
      扣税：￥{$koushui_amounts|default:"0"}.00&nbsp;&nbsp;&nbsp;
      奖金总计：￥{$amounts1|default:"0"}.00
  </td></tr>
</table>
</div>
			    <br />


<table  border=0 cellpadding=3 cellspacing=1 width=95% align="center" bgcolor="#F7F8F8" style="border:solid 1px #CDD7DC">
  <tr><td valign=top align=center height=100% width=90%>  
    <table width="100%"  border="0" cellpadding="0" cellspacing="0" >
      <tr><td></td></tr>
      <tr><td height="20" width="100%" valign=top>        

      </td></tr>
      <tr><td align="center">
        <table border="0" cellpadding=5 cellspacing=0 width=100%>
          <tr><td colspan=9 bgcolor=#5B7C8F height=1></td></tr>
          <tr bgcolor=#5B7C8F>
 <td width="9%"><div align="center"><font color="#FFFFFF">期数</font></div></td>

	     <td width="9%"><div align="center"><font color="#FFFFFF">推荐奖</font></div></td>
	      <td width="9%"><div align="center"><font color="#FFFFFF">发展奖</font></div></td>
	       <td width="9%"><div align="center"><font color="#FFFFFF">培养奖</font></div></td>
	        <td width="10%"><div align="center"><font color="#FFFFFF">扣重复消费金</font></div></td>
		 <td width="7%"><div align="center"><font color="#FFFFFF">扣税</font></div></td>
   <td width="10%"><div align="center"><font color="#FFFFFF">应发</font></div></td>
      <td width="11%"><div align="center"><font color="#FFFFFF">结算日期</font></div></td>
      
      
      <td width="8%"><div align="center"><font color="#FFFFFF">状态</font></div></td>
      </tr>
      {foreach from=$list item=item name=f1}
      <tr bgColor=#ffffff>
       <td align="center">{$item->sNo}期</td>
	<td> <div align="center">{$item->t_money} </div></td>
      <td>  <div align="center">{$item->f_money}</div></td>
        <td><div align="center">{$item->p_money}&nbsp;</div></td>
	<td><div align="center">{$item->c_money}&nbsp;</div></td>




	<td><div align="center">{$item->k_moeny}</div></td>
        <td><div align="center">
{$item->y_money}
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
