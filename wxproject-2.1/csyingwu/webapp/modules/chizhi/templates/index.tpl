<html>
<head>
    <title>充值中心 </title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="modpub/js/check.js" > </script>
    {literal}
        <script type="text/javascript">
            function check(f){
                if(Trim(f.userid.value) == ''){
                    alert("请填写您要充值的账号号！");
                    return false;
                }
                if(!/^\-?\d+$/.test(Trim(f.amount.value))){
                    alert("充值金额必须为数字！");
                    f.amount.value = '';
                    return false;
                }
                if(Trim(f.password.value) == ''){
                    alert("请填写您的二级密码！");
                    return false;
                }
                if(confirm("系统提示：\n你确定要给账号 " +
                        f.userid.value + " 充值 ￥" + f.amount.value + " 吗？")){
                    var es = document.form1.elements;
                    for(var i=0;i<es.length;i++){
                        if(es[i].type == 'submit'){
                            es[i].disabled = true;
                        }
                    }
                    return true;
                }
                return false;
            }
        </script>
    {/literal}
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
</head>

<body scroll="yes">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[财务管理]</a></li>
        <li><a href="#">充值币充值</a></li>
    </ul>
</div>

<div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
    <table style="width: 100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td class="line_leftright_borderclor">
                <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                     id="Div_Content">
                    <div id="ctl00_ContentPlaceHolder1_UpdatePanel1" style="width:100%;text-align:center;">

                        <br /><br /><br /><br />
                        <div  class="YFT_huobichongzhi_bg" style="padding-top:110px;padding-left:120px;">

                            <form name="form1" action="index.php?module=chizhi"
                                  method="post" onsubmit="return check(this);">
                                <input type="hidden" name="type" value="user">
                                <table width="90%" align="center"  border="0" cellpadding="0" cellspacing="0" >
                                    <tr><td>
                                            <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

                                                <tr bgcolor="">
                                                    <td width="30%" height="30" bgcolor="" align="right">要充值的账号：</td>
                                                    <td width="70%" bgcolor="">
                                                        <input name="userid" class="button1"></td></tr>
                                                <tr bgcolor="">
                                                    <td height="30" bgcolor="" align="right">要充值的金额：</td>
                                                    <td bgcolor="">
                                                        <input name="amount" class="button1"></td></tr>
                                                <tr bgcolor="">
                                                    <td height="30" bgcolor="" align="right">二级密码：</td>
                                                    <td bgcolor="">
                                                        <input type="password" name="password" class="button1"></td></tr>
                                                <tr bgcolor="">
                                                    <td colspan=2 style="padding-left:70px;" >
                                                        <font color="red">{$error}</font> <br/>
                                                        <input class="scbtn" type="submit" value="提 交"> &nbsp;&nbsp;
                                                        <input class="scbtn" type="reset" ></td></tr>
                                            </table>
                                        </td></tr>
                                </table>
                            </form>
                        </div> </div> </div>
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


