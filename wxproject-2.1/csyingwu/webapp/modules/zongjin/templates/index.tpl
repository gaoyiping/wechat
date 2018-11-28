<html>
<head>
<title>会员奖金列表</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
      <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
    {literal}
<script type="text/javascript">
    function AlertMessageBox()
    {

	        
	         
    }
        function Showopen(sNo)
        {
	
            showPopWin('查看发放流程',"index.php?module=dailijin&action=view&sNo="+sNo, 640, 300, AlertMessageBox,true,true)
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
                                &nbsp;<span class="Font_red Font_addbold">[会员管理]</span> >> 会员奖金列表

                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">

<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="zongjin" />

<table width=96% border=0 align="center">
  <tr><td>
&nbsp;&nbsp;账号 <input name="user_id" value="{$user_id}" size="8"   class="button1" />
&nbsp;&nbsp;从<input name="startdate" value="{$startdate}" size="8" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
      至
      <input name="enddate" value="{$enddate}" size="8" readonly class="button1"/>
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
     
     <input type="submit" value="查 询" class="b02">
<td align="right"></td>
  </td></tr>
</table>
</form></div><br />
<form name="form2" method="post" action="index.php?module=dailijin&action=okall" >
  {literal}
<script type="text/javascript">
function ccolor(c){
  if(c.checked){
    c.parentNode.parentNode.bgColor = 'green';
  } else {
    c.parentNode.parentNode.bgColor = 'white';
  }
}
function e(t){
  var es = document.form2.elements;
  for(var i=0;i<es.length;i++){
    if(es[i].type == 'checkbox' ){
      if(t == 'a'){
        es[i].checked = true; ccolor(es[i]);
      }
      if(t == 'o'){
        es[i].checked = !es[i].checked; ccolor(es[i]);
      }
    }
  }
}
</script>
{/literal}

<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="96%"><tr><td>
  <table border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr class="td3"> 

         <td width="4%" align="center">序</td>
	   <td width="9%"><div align="center"><font color="#FFFFFF">会员账号</font></div></td>
	    <td width="9%"><div align="center"><font color="#FFFFFF">会员昵称</font></div></td>
	     <td width="9%"><div align="center"><font color="#FFFFFF">会员类型</font></div></td>
	      <td width="9%"><div align="center"><font color="#FFFFFF">奖金合计</font></div></td>
	       <td width="9%"><div align="center"><font color="#FFFFFF">业绩总计</font></div></td>
	       
      

    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr class="td4"  onmouseover="this.style.background='#CDE6EB'" onmouseout="this.style.background='#fff';"> 
    
        <td align="center">{$smarty.foreach.f1.iteration}</td>
	 <td> 
        <div align="center">{$item->userid} </div>

	</td>
      <td> 
        <div align="center">{$item->user_name}</div></td>
        <td><div align="center"><font color="#116600">{if $item->usertype==1} 普卡会员{/if}</font>
	<font color="#1166FF">{if  $item->usertype==2} 金卡会员{/if}</font></div></td>
	<td><div align="right">{$item->y_money|sprintf}&nbsp;</div></td>
	<td><div align="right">{$item->p_money|sprintf}&nbsp;</div></td>

	
    </tr>
    {/foreach}
  </table>
</td></tr></table></form>
<br/>
<table align="center"><tr><td>
<div class="pages">
  {$pagehtml}
  </div>
</td></tr></table><br />



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
