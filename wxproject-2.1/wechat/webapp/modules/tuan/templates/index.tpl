<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>
{literal}
<script type='text/javascript'>
function check(f){
  if(Trim(f.amount.value) == ''){
    alert("请输入人数！");
    return false;
  }
  
  if(!IsInt(Trim(f.amount.value))){
    alert("请输入正确格式的数字！");
    f.amount.value = '';
    return false;
  }
   
  if(Trim(f.name.value) == ''){
    alert("请输入团队名称！");
    return false;
  }


  var str = "系统提示：\n\n" +
            "你将创建：" + f.amount.value + "制团队，名称为：" + f.name.value +
            "，您确定吗？";
            
  if(confirm(str)){
    return true;
  }
  return false;
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
                                &nbsp;<span class="Font_red Font_addbold">[商务中心]</span> >> 抱团申请
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible;"
                            id="Div_Content">     <div id="ctl00_ContentPlaceHolder1_UpdatePanel1" style="width:100%;text-align:center;">
	
       <br /><br /><br />
        <div  class="YFT_shenqing_bg" style="padding-top:60px;">
<form name="f" action="index.php?module=tuan" method='post' onsubmit="return check(this);">
<input type="hidden" name="cfnumber" value="{$cfnumber}" />
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"   style=""  >
  <tr><td width="100%" align="center">        
    <table width="100%" border="0" cellspacing="1" cellpadding="1" style="table-layout:fixed;word-break:break-all;word-wrap:break-word;">

      <tr><td align="right">
        凭证号：<font color='red'><strong>{$cfnumber}</strong></font><br/>&nbsp;</td></tr>
      <tr><td style="font-size:14px;line-height:35px;">
       
          尊敬的 <strong><u>&nbsp;{$username}&nbsp;</u></strong>
          ,
   {if $type==1}您已经加入<strong><u>&nbsp;{$tuan}&nbsp;</u></strong>人制团队，团队名称为<strong><u>&nbsp;{$tuanname}&nbsp;</u></strong>。{/if} 
   {if $type==2}您可以申请
 <input name='amount' size=5 maxlength=6 style="text-align:center;background-color:transparent;ime-mode:disabled;border-width:0;border-bottom:1px #878787 solid;" />  
   人制团队，团队名称为<input name='name' size=10 maxlength=10 style="text-align:center;background-color:transparent;ime-mode:disabled;border-width:0;border-bottom:1px #878787 solid;" />  。{/if}       
   {if $type==3}您的团队还未满足条件，不可申请6人制团队，还需<strong><u>&nbsp;{$cn}&nbsp;</u></strong>人方可申请！{/if}        
        {if $error}<p style="color:red;text-align:center;padding-top:10px;">{$error}</p>{/if}</td></tr>
      <tr><td>
        </td></tr>
      <tr><td align="center"><br/><br/>
      {if $type==2}
        <input class="b02" type="submit"  
          value=" 提交申请 " style="font-size:14px;" />
      {/if}   
        </td></tr>
    </table>
  </td></tr>
</table>

  </div></div></div>
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
