<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>产品分类管理</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>
</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[管理中心]</a></li>
        <li><a href="#">产品分类管理</a></li>
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
                        <th>产品分类名称</th>
                        <th>类型</th>
                        <th>排序号</th>
                        <th>订购背景色</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$rpros item=item name=f1}
                        <tr class="td4">
                            <td align="center">{$smarty.foreach.f1.iteration}</td>
                            <td>
                                <div align="center">{$item->tname}</div></td>
                            <td>
                                <div align="center">{if $item->ttype==1}注册/零售{/if}
                                    {if $item->ttype==2}VIP升级{/if}
                                    {if $item->ttype==3}重复消费{/if}</div></td>
                            <td>
                                <div align="center">{$item->torder}</div></td>
                            <td >
                                <div align="center"><input type="text" style="border:solid 0px #fff;height:14px;width:50px;background-color:#{$item->bgcolor}" /></div></td>
                            <td >
                                <div align="center">{$item->tpubdate}</div></td>
                            <td>
                                <div align="center">
                                    <a class="tablelink" href="index.php?module=ProductType&action=edit&id={$item->tID}">修改</a>  |
                                    {if $item->tistrue=='1'}
                                        <font style="color:red;">已删除</font>
                                    {else}
                                        <a class="tablelink" href="index.php?module=ProductType&action=del&id={$item->tID}" onclick="return confirm('确定要删除此分类吗?')">删除</a>
                                    {/if}
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
    <br />
    <table border="0" align="center" width="95%" cellpadding="0" cellspacing="0"><tr><td>
                <input type="button" class="scbtn" value="添加新分类" onclick="location.href='index.php?module=ProductType&action=add';" />
            </td></tr></table>
</div>

<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>

<script language="javascript" src="../new_style/css/webjs.js"> </script>
</body>

</html>
