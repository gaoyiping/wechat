<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>管理员列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[系统管理]</a></li>
        <li><a href="#">管理员列表</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">


    <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
        <tr><td>
                <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                    <thead>
                    <tr>
                        <th>序</th>
                        <th>管理员名称</th>
                        <th>管理员类型</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    {foreach from=$admin_list item=item name=f1}
                        <tr class="td4">
                            <td align="center">
                                {$smarty.foreach.f1.iteration}</td>
                            <td>
                                <div align="center">{$item->admin_id}</div></td>
                            <td >
                                <div align="center">{if $item->role == 1}<span style="color:red">超级管理员</span>{else}普通管理员{/if}</div></td>
                            <td >
                                <div align="center">{$item->add_date}</div></td>
                            <td>
                                <div align="center">
                                    <a href="index.php?module=addadmin&action=edit&id={$item->id}" class="tablelink">修改</a>  |
                                    <a class="tablelink" href="index.php?module=addadmin&action=del&id={$item->id}" onclick="return confirm('确定要删除该管理员吗？')">删除</a>
                                </div></td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </td></tr>
    </table>
    <br />
    <table align="center">
        <tr>
            <td>
                <div class="pages">
                    {$pagehtml}
                </div>
            </td>
        </tr>
    </table>

    <table border="0" align="center" width="95%" cellpadding="0" cellspacing="0"><tr><td>
                <input type="button" class="scbtn" value="添加管理员" onclick="location.href='index.php?module=addadmin&action=add';" />
            </td></tr></table>

</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>

</html>
