<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>会员列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>
    <script type="text/javascript" src="/FineMessBox/js/common.js"></script>
    <script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
    <script type="text/javascript" src="modpub/js/ajax.js"> </script>


    {literal}
        <script language="JavaScript" >
            function AlertMessageBox()
            {



            }
            function Showopen(userid)
            {

                showPopWin('查看会员信息',"index.php?module=CertifiedUserList&action=view&userid="+userid, 600, 400, AlertMessageBox,true,true)
            }


        </script>
    {/literal}


</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[微信配置]</a></li>
        <li><a href="#">关键词自动回复</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <div style="border:solid 1px #dedede;width:100%;height:80px;border-left:solid 0px;border-right:solid 0px;">
        <form name="form1" action="index.php" method="get">
            <input type="hidden" name="module" value="weixin">
            <input type="hidden" name="action" value="keywords">
            <div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:56px; border-left:solid 1px #fff;border-right:solid 1px #fff; ">

                <td >规则名称:<input name="name" value="{$name}" class='scinput_s'> <input type="submit" value="查 询" class="scbtn">
                    <input type="button" onclick="window.location.href='index.php?module=weixin&action=addkeyword'" value="添加新规则" class="scbtn"></td>
            </div>
        </form>

    </div>



        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
            <tr><td>
                    <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                        <thead>
                        <tr>
                            <th>序</th>
                            <th>规则名称</th>
                            <th>关键词(KEY值)</th>
                            <th>消息类型</th>
                            <th>推送量</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach from=$list item=item name=f1}
                            <tr class="td4">
                                <td>
                                    <div align="center">{$smarty.foreach.f1.iteration}</div>
                                </td>
                                <td>
                                    <div align="center">{$item->name}</div>
                                </td>
                                <td>
                                    <div align="center">{$item->keyword}</div>
                                </td>
                                <td>
                                    <div align="center">{if $item->type==1}文字{else}图文{/if}</div>
                                </td>
                                <td>
                                    <div align="center">{$item->count}</div>
                                </td>

                                <td>
                                    <div align="center">{if $item->status==1}yes{else}no{/if}</div>
                                </td>

                                <td>
                                    <div align="center">
                                        <a class="tablelink" href="index.php?module=weixin&action=editkeyword&id={$item->id}" >修改</a> |
                                        <a class="tablelink" href="index.php?module=weixin&action=delete&id={$item->id}" onclick="return confirm('你确定要删除吗?')">删除</a>
                                    </div>
                                </td>

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
