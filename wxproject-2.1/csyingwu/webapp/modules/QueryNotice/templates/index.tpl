<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>公告</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[综合中心]</a></li>
        <li><a href="#">公告管理</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
        <tr><td>
                <table width=100% class="tablelist" cellpadding="4" cellspacing="1" border="0">
                    <thead>
                    <tr>
                        <th width="10%">序</th>
                        <th width="35%">公告标题</th>
                        <th width="20%">发布时间</th>
                        <th width="20%">操作</th>
                    </tr>
                    </thead>
                    {foreach from=$notices item=item name=f1}
                        <tr class="td4">
                            <td>
                                <div align="center">{$smarty.foreach.f1.iteration}</div></td>
                            <td>
                                <div align="center"><font color="#FF0000">{$item->title}</font></div></td>


                            <td>
                                <div align="center">{$item->add_date}</div></td>
                            <td>
                                <div align="center"><a class="tablelink" href="index.php?module=QueryNotice&action=detail&id={$item->id}">查看</a> |
                                    <a class="tablelink" href="index.php?module=QueryNotice&action=edit&id={$item->id}">修改</a>  |
                                    <a class="tablelink" href="index.php?module=QueryNotice&action=del&id={$item->id}" onclick="return confirm('确定要删除此条公告吗?')">删除</a>
                                </div></td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </td></tr>
        <table align="center"  border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td><input type="button" class="scbtn" value="添加公告" onclick="location.href='index.php?module=Notice';" /></td></tr></table>
    </table>

<table align="center">
    <tr>
        <td>
            <div class="pages">
                {$pagehtml}
            </div>
        </td>
    </tr>

</table>

<tr>
    <td
            class="YFTmainright_r3_c2_gj" height="1">
    </td>
</tr>

</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>

</html>
