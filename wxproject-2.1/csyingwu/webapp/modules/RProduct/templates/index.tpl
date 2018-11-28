<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>产品管理</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[进销存管理]</a></li>
        <li><a href="#">产品管理</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <div style="border:solid 1px #dedede;width:100%;height:80px;border-left:solid 0px;border-right:solid 0px;">
        <form name="form1" action="index.php" method="get">
            <input type="hidden" name="module" value="RProduct" />
            <div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:56px; border-left:solid 1px #fff;border-right:solid 1px #fff; ">

                <td>
     产品分类
       <select id="type" style="height:24px;" name="type"  class="scinput_s">
                        <option value='' {if $type==""}selected{/if}  >全部</option>
                       {foreach from=$types item=item name=f1}
                       <option value='{$item->tID}' {if $type==$item->tID}selected{/if}  >{$item->tname}</option>
                        {/foreach}
                    </select>         
                产品关键字
                <input type='text' name='keyword' size='10' value="{$keyword}" class="scinput_s" />

                    &nbsp;&nbsp;启用状态<select id="isdelete" style="height:24px;" name="isdelete">
                        <option value='' {if $isdelete==""}selected{/if}  >全部</option>
                        <option value='0' {if $isdelete=="0"}selected{/if} >启用</option>
                        <option value='1' {if $isdelete=="1"}selected{/if} >禁用</option>

                    </select>
                    <input type="submit" value="查 询" class="scbtn">  <input type="button" class="scbtn" value="添加新产品" onclick="location.href='index.php?module=RProduct&action=add';" />
            </div>
        </form>

    </div>



    <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
        <tr><td>
                <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                    <thead>
                    <tr>
                        <th>序</th>
                        <th>产品编号</th>
                        <th>产品名称</th>
                        <th>原价</th>
                        <th>起订数</th>
                        <th>会员价</th>
                        <th>PV</th>
                        <th>利润</th>
                        <th>状态</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    {foreach from=$rpros item=item name=f1}
                        <tr class="td4">
                            <td align="center">{$smarty.foreach.f1.iteration}</td>
                            <td>
                                <div align="center">{$item->sNo}</div></td>

                            <td>
                                <div align="center">{$item->pname}</div></td>
                            <td>
                                <div align="center">{$item->guige}</div></td>

                            <td>
                                <div align="center">{$item->qidingnum}</div></td>
                            <td>
                                <div align="right">￥{$item->zhuanmaijia}</div></td>

                            <td>
                                <div align="right">￥{$item->jifen}</div></td>
                            <td>
                                <div align="right">￥{$item->lirun}</div></td>

                            <td>
                                <div align="center">{ if $item->isdelete==1 }<font color="red">禁用</font>{else}启用{/if}</div></td>
                            <td >
                                <div align="center">{$item->add_date|date_format:'%Y-%m-%d'}</div></td>
                            <td>
                                <div align="center">
                                    <a class="tablelink" href="index.php?module=RProduct&action=edit&id={$item->id}">修改</a>  |
                                    {if $item->is_del=='1'}
                                        <span style="color:red;">已删</span>
                                    {else}
                                        <a class="tablelink" href="index.php?module=RProduct&action=del&id={$item->id}" onclick="return confirm('确定要删除此零售产品吗?')">删除</a>
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
</div>

<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>

<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>

</html>
