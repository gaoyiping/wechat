<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>修改管理员</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script language="javascript"  src="modpub/js/check.js"> </script>

    {literal}
        <script type="text/javascript">

            function check(f){

                if(Trim(f.admin_id.value) == ''){
                    alert("请输入管理员名称！");
                    f.admin_id.focus();
                    return false;
                }
                if(!/.{6,}/.test(f.admin_id.value)){
                    alert("管理员名称长度至少为6位！");
                    f.admin_id.focus();
                    return false;
                }

                if(Trim(f.first_pwd.value) == ''){
                    alert("请输入管理员密码！");
                    f.first_pwd.focus();
                    return false;
                }

                if(!/.{6,}/.test(f.first_pwd.value)){
                    alert("密码长至少为6位！");
                    f.first_pwd.focus();
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
        <li><a href="#">管理员列表</a></li>
        <li><a href="#">修改管理员</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <form action="index.php?module=addadmin&action=edit" name="form1" method="post" onsubmit="return check(this);"  enctype="multipart/form-data">
        <input type="hidden" name="id" value="{$info->id}" />
        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="40%">
            <tr><td>
                    <table width=100% class="tablelist_s" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                        <tr>
                            <th>修改管理员</th>
                        </tr>

                        <tr>
                            <td height="56" valign="top">
                                <table align="center" bgcolor="#DDDDDD" width="100%" border="0" cellpadding="5" cellspacing="1" >

                                    <tr class="td4">
                                        <td width="98" align="right">管理员名称：</td>
                                        <td><input name='admin_id' type="text" value="{$info->admin_id}" style="width:200px;" class="dfinput" >

                                            <span id='span_pwd1'></span></td>
                                    </tr>

                                    <tr class="td4">
                                        <td width="98" align="right">管理员密码：</td>
                                        <td><input name='first_pwd' style="width:200px;" type="password" class="dfinput" >

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
