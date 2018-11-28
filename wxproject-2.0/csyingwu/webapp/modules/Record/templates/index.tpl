<html>
<head>
<meta http-equiv=Content-Type content="text/html;charset=utf-8">
<link rel="stylesheet" href="./modpub/css/base.css" type="text/css">
<script language="javascript" src="modpub/js/calendar.js"> </script>
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
                                &nbsp;<span class="Font_red Font_addbold">[会员管理]</span> >> 会员财务记录

                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br />


<form method="get" action="index.php?module=Record" name="form1">
<input type="hidden" name="module" value="Record" />

      
   <table  border=0 cellpadding=3 cellspacing=1 width=95% align="center" bgcolor="#F7F8F8" style="border:solid 1px #CDD7DC">
  <tr><td valign=top align=center height=100% width=90%>  
    <table width="100%"  border="0" cellpadding="0" cellspacing="0" >
      <tr><td></td></tr>
      <tr><td height="20" width="100%" valign=top>        
        <table cellspacing=0 cellpadding=0 width="100%" border=0 height=30>
          
          <tr>
           
            <td height=5>
            
 

              

	    账户类型 <select id="choose" name="choose">
    <option value='0' {if $choose=="0"}selected{/if}  >全部类型</option>
<option value='1' {if $choose=="1"}selected{/if} >注册报单</option>
<option value='2' {if $choose=="2"}selected{/if} >现金充值</option>


<option value='4'{if $choose=="4"}selected{/if}  >货币提现</option>

</select>     &nbsp;&nbsp;账号
      <input name="userid" value="{$userid}" size="7"  class="button1" />产生日期
      <input name="startdate" value="{$startdate}" size="7" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
      至
      <input name="enddate" value="{$enddate}" size="7" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
      &nbsp;&nbsp;<input type="submit" value="查 询" class="b02">

            </td>
	    <td align="right"> 
        金额总计：￥<font color=red>{$recordemoneys}</font> 
        本页总计：￥<font color=red>{$pageemoneys}</font> </td>
          </tr>
        </table>
      </td></tr>
      <tr><td align="center">
        <table border="0" cellpadding=5 cellspacing=0 width=100%>
          <tr><td colspan=9 bgcolor=#5B7C8F height=1></td></tr>
          <tr bgcolor=#5B7C8F>
            <td width=5% align="center"><span style="color: #ffffff"> 序</span></td>
	       <td width=8% align="center"><span style="color: #ffffff">账号</span></td>
            <td width=13% align="center"><span style="color: #ffffff">产生日期</span></td>
            <td width=10% align="center"><span style="color: #ffffff">账户类型</span></td>
            <td width=10% align="center" ><span style="color: #ffffff">金额</span></td>
            <td width=40% align="center"><span style="color: #ffffff">备注</span></td>
              <td width=10% align="center"><span style="color: #ffffff">状态</span></td>
          </tr>
          <tr><td colspan=9 bgcolor=#666666 height=1></td></tr>
          {foreach from=$list item=item name=f1}
	  {if $item.type==1 &&  $item.accepter==$userid}{else}
          <tr>
            <td align="center" height="30">{$smarty.foreach.f1.iteration}</td>
	      <td align="center">{$item.operation}</td>
            <td align="center">{$item.add_date}</td>
            <td align="center"> {if $item.type == '1'}注册报单{/if}
	                          {if $item.type == '2'}现金充值{/if}
				
				    {if $item.type == '4'}货币提现{/if}
				    
			
            <td align="center" >{$item.amount}￥</td>
            <td>{$item.remark}{$item.rdesc}</td>
           <td align="center">{if $item.status==0}<font color="red">处理中</font>{elseif $item.status==1}<font color="green">完成{else}拒付{/if}</font></td>
          </tr>
	  {/if}
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
