<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>新闻列表管理</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[新闻管理]</a></li>
        <li><a href="#">新闻列表管理</a></li>
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
                        <th>分类名称</th>
                        <th>新闻标题</th>
                        <th>排序号</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    {foreach from=$list item=item name=f1}
                        <tr class="td4">
                            <td align="center">
                                {$smarty.foreach.f1.iteration}</td>
                            <td >
                                <div align="center">{$item->name_class}</div></td>
                            <td>
                                <div align="center">{$item->news_title}</div></td>
                            <td >
                                <div align="center">{$item->sort}</div></td>
                            <td >
                                <div align="center">{$item->add_date}</div></td>
                            <td>
                                <div align="center">
                                    {*<a class="tablelink" href="index.php?module=newslist&action=detail&id={$item->id}" >查看详情</a>  |*}
                                    <a class="tablelink" href="index.php?module=newslist&action=edit&id={$item->id}" >修改</a>  |
                                    <a class="tablelink" href="index.php?module=newslist&action=del&id={$item->id}" onclick="return confirm('确定要删除此条新闻吗？')">删除</a>
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
                <input type="button" class="scbtn" value="发布新闻" onclick="location.href='index.php?module=newslist&action=add';" />
            </td></tr></table>

</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>

</html>
