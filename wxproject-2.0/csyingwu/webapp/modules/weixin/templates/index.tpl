<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>系统消息</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script language="javascript"  src="modpub/js/check.js"> </script>


    {literal}
        <script language="javascript">
            function check(theForm){
                if(Trim(theForm.title.value)==""){
                    alert("消息标题不能为空!");
                    return false;
                } else if(Trim(theForm.content.value)==""){
                    alert("消息内容不能为空！");
                    return false;
                } else {
                    var s = theForm.choose;
                    var c = s.options[s.selectedIndex].value;
                    if(c == '2' && Trim(theForm.toid.value) == '') {
                        alert("接收人不能为空！");
                        return false;
                    }
                }
                var inputs = theForm.getElementsByTagName("INPUT");
                for(var i=0;i<inputs.length;i++){
                    if(inputs[i].type=='submit'){
                        inputs[i].disabled = true; break;
                    }
                }
                return true;
            }

            function choose_change(s){
                var c = s.options[s.selectedIndex].value;
                if(c == '1'){
                    document.getElementById('choose_1').style.display = '';
                    document.getElementById('choose_2').style.display = 'none';
                }
                if(c == '2'){
                    document.getElementById('choose_2').style.display = '';
                    document.getElementById('choose_1').style.display = 'none';
                }
            }
        </script>
    {/literal}
</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[微信配置]</a></li>
        <li><a href="#">微信接口设置</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">




    <form name="form1" action="index.php?module=weixin"  method="post" >
        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="80%">
            <tr><td>
                    <table width=100% class="tablelist_s" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                        <tr>
                            <th>微信接口设置</th>
                        </tr>

                        <tr>
                            <td height="56" valign="top">
                                <table align="center" bgcolor="#DDDDDD" width="100%" border="0" cellpadding="5" cellspacing="1" >


                                    <tr bgcolor="#FFFFFF">
                                        <td width="168" align="right">URL (微信公共号绑定填入)：</td>
                                        <td>
                                            <font color="red">http://你的网址/wechat/weixin.php</font>
                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">Token(微信公共号绑定填入)：</td>
                                        <td>
                                            <input name="token" value="{$system->token}" class="dfinput" type="text" style='width:500px;' />
                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">AppId：</td>
                                        <td>
                                            <input name="appid" value="{$system->appid}" class="dfinput" type="text" style='width:500px;' />
                                        </td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">AppSecret：</td>
                                        <td>
                                            <input name="appsecret" value="{$system->appsecret}" class="dfinput" type="text" style='width:500px;' />
                                        </td>
                                    </tr>

                                    <tr align="center" bgcolor="#FFFFFF">
                                        <td height="45" colspan="2">
                                            <input type="submit" name="Submit" value="提 交" class="scbtn">
                                            <input type="reset" name="reset" value="重 写"  class="scbtn">
                                        </td>
                                    </tr>
                        </thead>
                    </table>
                </td></tr>
            <tr>
                <td bgColor="#F2F2F2" height="1"></td>
            </tr>
        </table>
    </form>

</div>
<script language="javascript" src="/new_style/css/webjs.js"> </script>

</body>

</html>
