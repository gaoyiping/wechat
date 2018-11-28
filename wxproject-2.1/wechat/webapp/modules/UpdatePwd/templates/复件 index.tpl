<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="modpub/css/base.css">
 <link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<script type="text/javascript" src="modpub/js/check.js"> </script>
<script type="text/javascript" src="modpub/js/userinfo_check.js"> </script>
{literal}
<script language="JavaScript" >
function choose(c,size){
  for(var i=0;i<size;i++){
    document.getElementById('div_'+i).style.display = 'none';
  }
  document.getElementById('div_'+c).style.display = '';
}

function check(f){
  if(Trim(f.oldpwd.value) == ''){
    alert("请输入旧密码！");
    f.oldpwd.focus();
    return false;
  }
  if(!/.{6,}/.test(f.pwd1.value)){
    alert("密码长度至少为6位！");
    f.pwd1.focus();
    return false;
  }
  /*
  if(!checkPassValid(f.pwd1.value)){
    alert("您的密码设置过于简单,请重新设置");
    f.pwd1.focus();
    return false;
  }
  */
  if(f.pwd1.value != f.pwd2.value){
    alert("两次输入密码不同，请重新输入！");
    f.pwd1.focus();
    return false;
  }
  return true;
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

                        <div style="margin-top: -1px; height: 30px; overflow: hidden" id="ctl00_Div_right_top"
                            class="YFTmainright_r1_c2_gj">
                            <div style="position: relative; line-height: 30px; width: 100%">
                                &nbsp;<span class="">[个人中心]</span> >> 密码修改
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content">
                            <div id="ctl00_ContentPlaceHolder1_UpdatePanel1" style="width:100%;text-align:center;">
	
         <br /><br /><br /><br />
        <div  class="YFT_up_qita_bg">


  <p style="text-align:left; padding-top:60px;padding-left:50px;">
  </p>
<!-- div_0 -->
<div id="div_0" style="display:none;">
<form name="form0" action="index.php?module=UpdatePwd" 
  method="post" onsubmit="return check(this);">
  <input type="hidden" name="c" value="0" />
  <table align="center" border=0 cellpadding=0 cellspacing=0 width="80%">
    <tr>
      <td colspan=2 height=20>&nbsp;</td></tr>
    <tr>
      <td align="right" height=36 width="130">旧密码：</td>
      <td height=36 width="169"><font color=#ff0000>*</font>
        <input name="oldpwd" type='password' class='button1' /></td>
    </tr>
    <tr>
      <td align="right" height=36 width="130">新密码：</td>
      <td height=36 width="469"><font color=#ff0000>*</font>
        <input name="pwd1" type='password' class='button1' />
        <span>(长度6-9位包含字母和数字)</span></td>
    </tr>
    <tr>
      <td align="right" height=36 width="130">再次确认：</td>
      <td height=36 width="169"><font color=#ff0000>*</font>
        <input name="pwd2" type='password' class='button1' /></td>
    </tr>
    <tr>
      <td colspan=2 align="center">{if $c==0}<font color=red>{$error}</font>{/if}</td></tr>
    <tr>
      <td align="center" colspan=2 height=50>
        <input class="b02" type="submit"value="修 改" /> </td>
    </tr>
  </table>
</form>
</div>

<!-- div_1 -->
<div id="div_1" style="display:none;">
<form name="form1" action="index.php?module=UpdatePwd" 
  method="post" onsubmit="return check(this);">
  <input type="hidden" name="c" value="1" />
  <table align="center" border=0 cellpadding=0 cellspacing=0 width="80%">
    <tr>
      <td colspan=2 height=20>&nbsp;</td></tr>
    <tr>
      <td align="right" height=36 width="130">旧密码：</td>
      <td height=36 width="169"><font color=#ff0000>*</font>
        <input name="oldpwd" type='password' class='button1' /></td>
    </tr>
    <tr>
      <td align="right" height=36 width="130">新密码：</td>
      <td height=36 width="469"><font color=#ff0000>*</font>
        <input name="pwd1" type='password' class='button1' />
        <span>(长度6-9位包含字母和数字)</span></td>
    </tr>
    <tr>
      <td align="right" height=36 width="130">再次确认：</td>
      <td height=36 width="169"><font color=#ff0000>*</font>
        <input name="pwd2" type='password' class='button1' /></td>
    </tr>
    <tr>
      <td colspan=2 align="center">{if $c==1}<font color=red>{$error}</font>{/if}</td></tr>
    <tr>
      <td align="center" colspan=2 height=50>
        <input class="button1" type="submit"value="修 改" /> </td>
    </tr>
  </table>
</form>
</div>
  </div>  </div>  </div>
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
<script type="text/javascript">
var c = {if $c == ''}0{else}{$c}{/if};
choose(c,2);
</script>

</body>
</html>
