<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>修改新闻分类</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script language="javascript"  src="modpub/js/check.js"> </script>

    {literal}
        <script type="text/javascript">
            function check(f){
                if(Trim(f.name_class.value)==""){
                    alert("分类名称不能为空！");
                    f.name_class.value = '';
                    return false;
                }
                if(Trim(f.sort.value)==""){
                    alert("分类排序号不能为空！");
                    f.sort.value = '';
                    return false;
                }
                f.sort.value = Trim(f.sort.value);
                if(!/^(([1-9][0-9]*)|0)(\.[0-9]{1,2})?$/.test(f.sort.value)){
                    alert("排序号必须为数字，且格式为 ####.## ！");
                    f.sort.value = '';
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
        <li><a href="#">[新闻管理]</a></li>
        <li><a href="#">新闻分类管理</a></li>
        <li><a href="#">修改新闻分类</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <form action="index.php?module=newsclass&action=edit" name="form1" method="post" onsubmit="return check(this);"  enctype="multipart/form-data">
        <input type="hidden" name="id" value="{$id}" />
        <input type="hidden" name="editable" value="true" />
        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="40%">
            <tr><td>
                    <table width=100% class="tablelist_s" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                        <tr>
                            <th>修改新闻分类</th>
                        </tr>

                        <tr>
                            <td height="56" valign="top">
                                <table align="center" bgcolor="#DDDDDD" width="100%" border="0" cellpadding="5" cellspacing="1" >

                                    <tr class="td4">
                                        <td width="98" align="right">分类名称：</td>
                                        <td><input name='name_class' type="text" value="{$name_class}" style="width:200px;" class="dfinput" >
                                    </tr>

                                    <tr class="td4">
                                        <td width="98" align="right">排序号：</td>
                                        <td><input name='sort' style="width:200px;" type="text" value="{$sort}" class="dfinput" >
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
