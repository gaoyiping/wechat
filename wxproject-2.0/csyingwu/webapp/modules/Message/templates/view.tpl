<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>产品分类管理</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[综合办公]</a></li>
        <li><a href="#">系统消息</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <div>
        &nbsp;&nbsp;<span style="font-family: 微软雅黑; float:left; line-height:30px; padding-left:7px; padding-right:12px;  font-weight: bold"> <a href="index.php?module=Message">发送消息</a> | <a href="index.php?module=Message&action=geted">已发送列表</a></span>&nbsp;&nbsp;
    </div>&nbsp;

    <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
        <tr><td>
                <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                    <thead>
                    <tr>
                        <th>序</th>
                        <th>接收账号</th>
                        <th>消息内容</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$list item=item name=f1}
                        <tr class="td4">
                            <td>
                                <div align="center">{$smarty.foreach.f1.iteration}</div></td>
                            <td>
                                <div align="center"><font color="#FF0000">{$item->r_user_id}</font></div></td>

                            <td>
                                <div >{$item->content}</div></td>
                            <td>
                                <div align="center">{$item->add_date}</div></td>
                            <td >
                                <div align="center">
                                    <a class="tablelink" href="index.php?module=Message&action=del&id={$item->id}" onclick="return confirm('确定要删除此条消息吗?')">删除</a>
                                </div></td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </td></tr>
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

</div>

<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>

<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>

</html>
