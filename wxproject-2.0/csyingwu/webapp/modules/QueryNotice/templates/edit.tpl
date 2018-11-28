<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>修改公告</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="modpub/js/check.js" > </script>


    {literal}
        <script type="text/javascript">
            function check(f){
                if(Trim(f.title.value)==""){
                    alert("公告标题不能为空!");
                    f.title.value = '';
                    return false;
                }
                return true;
            }
        </script>
    {/literal}

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[综合管理]</a></li>
        <li><a href="#">公告管理</a></li>
        <li><a href="#">修改公告</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content"><br /><br/>


    <form action="index.php?module=QueryNotice&action=edit" method="post" onsubmit="return check(this)">
        <input type="hidden" name="id" value="{$id}" />
        <table align="center"  border="0" cellpadding="0" cellspacing="0" width="90%">
            <tr><td>

                <td align="left">
                    <table cellspacing="1" cellpadding="1" width="100%">
                        <tr class="tdTitle" >
                            <td height="25" align="center" colspan=2>
                                <font color="#141414" > 修改公告 </font></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                            <td  class="table_body">标 题：</td> <td class="table_none"> <input name="title"  class="button1" value="{$title}" type="text" id="title" style="width:260px; height:24px;" /></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                            <td  class="table_body">内 容：</td> <td class="table_none">
                                {php}
                                    $fckroot = './fckeditor/';
                                    include($fckroot . 'fckeditor.php');
                                    $fck = new FCKeditor('content') ;
                                    $fck->BasePath = $fckroot;
                                    $fck->ToolbarSet = 'Default';
                                    $fck->Height='350px';
                                    $fck->Value=$this->_tpl_vars['content'];
                                    $fck->Create();
                                {/php}
                            </td></tr>

                        </td>
                        </tr>

                    </table> <p align="center">
                        <input type="submit" name="Submit" value="修 改 " class="scbtn">
                        &nbsp;&nbsp;&nbsp;
                        <input type="button" name="Submit2" value="返 回" class="scbtn" onclick="window.location.href='index.php?module=QueryNotice';">
                    </p>
                </td></tr></table>
    </form>
</div>

</body>

</html>
