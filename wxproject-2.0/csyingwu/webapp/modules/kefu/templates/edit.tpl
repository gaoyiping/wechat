<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>修改在线客服</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script language="javascript"  src="modpub/js/check.js"> </script>

    {literal}
        <script type="text/javascript">
            function check(f){
                if(Trim(f.kefu_name.value)==""){
                    alert("客服名称不能为空！");
                    f.kefu_name.value = '';
                    return false;
                }

                if(Trim(f.kefu_num.value)==""){
                    alert("客服号码不能为空！");
                    f.kefu_num.value = '';
                    return false;
                }

                f.kefu_num.value = Trim(f.kefu_num.value);
                if(!/^(([1-9][0-9]*)|0)(\.[0-9]{1,2})?$/.test(f.kefu_num.value)){
                    alert("客服号码必须为数字 ！");
                    f.kefu_num.value = '';
                    return false;
                }
                return true;
            }
        </script>
    {/literal}

</head>


<body scroll="yes">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[系统管理]</a></li>
        <li><a href="#">在线客服</a></li>
        <li><a href="#">修改在线客服</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">


    <form action="index.php?module=kefu&action=edit" method="post" name="form1" onsubmit="return check(this);" enctype="multipart/form-data">
        <input type="hidden" name="kid" value="{$kid}" />
        <input type="hidden" name="editable" value="true" />
        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="40%">
            <tr><td>
                    <table width=100% class="tablelist_s" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                        <tr>
                            <th>修改在线客服</th>
                        </tr>

                        <tr>
                            <td height="56" valign="top">
                                <table align="center" bgcolor="#DDDDDD" width="100%" border="0" cellpadding="5" cellspacing="1" >

                                    <tr class="td4">
                                        <td width="98" align="right">客服名称：</td>
                                        <td><input name='kefu_name' type="text" value="{$kefu_name}" style="width:200px;" class="dfinput" >

                                            <span id='span_pwd1'></span></td>
                                    </tr>

                                    <tr class="td4">
                                        <td width="98" align="right">客服号码：</td>
                                        <td><input name='kefu_num' style="width:200px;" type="text" value="{$kefu_num}" class="dfinput"  >

                                            <span id='span_repwd1'></span></td>
                                    </tr>

                                    <tr align="center" bgcolor="#FFFFFF">
                                        <td height="30" colspan="2">
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
