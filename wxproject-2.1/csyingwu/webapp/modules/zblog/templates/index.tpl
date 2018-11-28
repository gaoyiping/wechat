<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>公告</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="modpub/js/calendar.js"> </script>
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>

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
        <li><a href="#">[综合中心]</a></li>
        <li><a href="#">转币日志</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <form method="get" action="index.php" name="form1">
        <input type="hidden" name="module" value="zblog">
        <div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:38px; border-left:solid 1px #fff;border-right:solid 1px #fff; ">
            店铺编号<input name="userid" value="{$userid}" class="scinput_s">
            <input type="submit" value="查 询" class="scbtn">
        </div>
    </form>

    <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
        <tr><td>
                <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                    <thead>
                    <tr>
                        <th>序</th>
                        <th>店铺编号</th>
                        <th>金额</th>
                        <th>事件</th>
                        <th>操作时间</th>
                    </tr>
                    </thead>
                    <tbody>

                    {foreach from=$logs item=item name=f1}
                        <tr class="td4">
                            <td>
                                <div align="center">{$smarty.foreach.f1.iteration}</div>
                            </td>
                            <td>
                                <div align="center"><font color="#FF0000"><a href="javascript:Showopen('{$item->userid}');">{$item->userid}</a></font></div>
                            </td>
                            <td>
                                <div align="center"><font color="#FF0000">{$item->money}</font></div>
                            </td>
                            <td>
                                <div align="left">{$item->event}</div>
                            </td>

                            <td>
                                <div align="center">{$item->add_date}</div>
                            </td>

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

</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>

</html>
