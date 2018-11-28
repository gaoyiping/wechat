<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="modpub/js/check.js"> </script>
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
                if(f.pwd1.value != f.pwd2.value){
                    alert("两次输入密码不同，请重新输入！");
                    f.pwd1.focus();
                    return false;
                }
                return true;
            }
        </script>
    {/literal}
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
</head>
<body scroll="yes">
<div class="place">
    <ul class="placeul">
        <li><a href="#">[综合办公]</a></li>
        <li><a href="#">密码修改</a></li>
    </ul>
</div>
    <table style="width: 100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td class="line_leftright_borderclor">

                <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                     id="Div_Content"><div id="ctl00_ContentPlaceHolder1_UpdatePanel1" style="width:100%;text-align:center;">

                        <br /><br /><br /><br />
                        <div  class="YFT_up_qita_bg" style="padding-top:65px; padding-left:10px;">

                            修改的类型：  <label><input id="Radio1" type="radio"  name="radio" onclick="choose(0,2)" checked />登陆密码</label> <label><input id="Radio2" type="radio" onclick="choose(1,2)"  name="radio"/>二级密码</label>
                            <p style="padding-left:20px;">

                            </p>
                            <!-- div_0 -->
                            <div id="div_0" style="display:none;">
                                <form name="form0" action="index.php?module=UpdatePwd"
                                      method="post" onsubmit="return check(this);">
                                    <input type="hidden" name="c" value="0" />
                                    <table align="center" border=0 cellpadding=0 cellspacing=0 width="90%">
                                        <tr>
                                            <td colspan=2 height=20>&nbsp;</td></tr>
                                        <tr>
                                            <td align="right" height=36 width="98">原来的登陆密码：</td>
                                            <td height=36 width="169"><font color=#ff0000>*</font>
                                                <input name="oldpwd" type='password' class='button1' /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" height=36 width="98">新密码：</td>
                                            <td height=36 width="169"><font color=#ff0000>*</font>
                                                <input name="pwd1" type='password' class='button1' /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" height=36 width="98">再次确认：</td>
                                            <td height=36 width="169"><font color=#ff0000>*</font>
                                                <input name="pwd2" type='password' class='button1' /></td>
                                        </tr>
                                        <tr>
                                            <td colspan=2 align="center">{if $c==0}<font color=red>{$error}</font>{/if}</td></tr>
                                        <tr>
                                            <td align="center" colspan=2 height=50>
                                                <input class="scbtn" type="submit"value="修 改" /> </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>

                            <!-- div_1 -->
                            <div id="div_1" style="display:none;">
                                <form name="form1" action="index.php?module=UpdatePwd"
                                      method="post" onsubmit="return check(this);">
                                    <input type="hidden" name="c" value="1" />
                                    <table align="center" border=0 cellpadding=0 cellspacing=0 width="275">
                                        <tr>
                                            <td colspan=2 height=20>&nbsp;</td></tr>
                                        <tr>
                                            <td align="right" height=36 width="98">旧二级密码：</td>
                                            <td height=36 width="169"><font color=#ff0000>*</font>
                                                <input name="oldpwd" type='password' class='button1' /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" height=36 width="98">新密码：</td>
                                            <td height=36 width="169"><font color=#ff0000>*</font>
                                                <input name="pwd1" type='password' class='button1' /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" height=36 width="98">再次确认：</td>
                                            <td height=36 width="169"><font color=#ff0000>*</font>
                                                <input name="pwd2" type='password' class='button1' /></td>
                                        </tr>
                                        <tr>
                                            <td colspan=2 align="center">{if $c==1}<font color=red>{$error}</font>{/if}</td></tr>
                                        <tr>
                                            <td align="center" colspan=2 height=50>
                                                <input class="scbtn" type="submit"value="修 改" /> </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>

                            <!-- div_2 -->
                            <div id="div_2" style="display:none;">
                                <form name="form1" action="index.php?module=UpdatePwd"
                                      method="post" onsubmit="return check(this);">
                                    <input type="hidden" name="c" value="2" />
                                    <table align="center" border=0 cellpadding=0 cellspacing=0 width="275">
                                        <tr>
                                            <td colspan=2 height=20>&nbsp;</td></tr>
                                        <tr>
                                            <td align="right" height=36 width="98">旧三级密码：</td>
                                            <td height=36 width="169"><font color=#ff0000>*</font>
                                                <input name="oldpwd" type='password' class='button1' /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" height=36 width="98">新密码：</td>
                                            <td height=36 width="169"><font color=#ff0000>*</font>
                                                <input name="pwd1" type='password' class='button1' /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" height=36 width="98">再次确认：</td>
                                            <td height=36 width="169"><font color=#ff0000>*</font>
                                                <input name="pwd2" type='password' class='button1' /></td>
                                        </tr>
                                        <tr>
                                            <td colspan=2 align="center">{if $c==2}<font color=red>{$error}</font>{/if}</td></tr>
                                        <tr>
                                            <td align="center" colspan=2 height=50>
                                                <input class="scbtn" type="submit"value="修 改" /> </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>

                            <script type="text/javascript">
                                var c = {if $c == ''}0{else}{$c}{/if};
                                choose(c,3);
                            </script>

                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="YFTmainright_r3_c2_gj" height="1">
            </td>
        </tr>
        </tbody>
    </table>
<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>
</html>