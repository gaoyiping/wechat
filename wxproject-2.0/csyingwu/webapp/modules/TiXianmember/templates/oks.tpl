<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>用户提现</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[财务管理]</a></li>
        <li><a href="#">已处理的店铺提现申请</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <form method="get" action="index.php?" name="form1">
        <input type="hidden" name="module" value="TiXianmember" />
        <table width=95% align="center" border=0>
            <tr><td>
                    <div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:38px; border-left:solid 1px #fff;border-right:solid 1px #fff; ">
                        <a href="index.php?module=TiXianmember"><b>未处理申请</b></a> | <a href="index.php?module=TiXianmember&ok=1" >已处理申请</a> &nbsp;&nbsp;
                        申请日期<input name="startdate" value="{$startdate}" size="8" class="scinput_s" readonly>
                        <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);"/>
                        至<input name="enddate" value="{$enddate}" size="8" class="scinput_s" readonly>
                        <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);"/>
                        <input type="submit" value=" 查 询 " class="scbtn"  ></td>
                <td align="right">
                    总计：<font color="red">{$total}</font>条
                    <input type="button" value="导出本页" class="scbtn"  onclick="location.href=location.href+'&pageto=one';">
                    <input type="button" value="导出全部页" class="scbtn"  onclick="location.href=location.href+'&pageto=all';">
                </td></tr>
</div>
</table>
</form>

<form name="form2" method="post" action="index.php?module=TiXiandanbao&action=okall" >

    <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
        <tr><td>
                <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                    <thead>
                    <tr>
                        <th>选</th>
                        <th>序</th>
                        <th>人民币</th>
                        <th>申请时间</th>
                        <th>开户行</th>
                        <th>所在地</th>
                        <th>户名</th>
                        <th>银行卡号</th>
                        <th>账号</th>
                        <th>手机</th>
                        <th>状态</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$list item=item name=f1}
                        <tr align=middle bgColor=#ffffff>
                            <td></td>
                            <td>{$smarty.foreach.f1.iteration}</td>
                            <td align="right">￥<font style="color:red">{$item->amount}</font></td>
                            <td>{$item->add_date}</td>
                            <td align="center">{$item->byinhang}</td>
                            <td align="left">{$item->byinhangdiqu}</td>
                            <td>{$item->byhname}</td>
                            <td align="center">{$item->byhsNo}</td>
                            <td>{$item->operation}</td>
                            <td>{$item->btel}</td>
                            <td>{$item->replay_date}</td>
                            <td align="center">{if $item->status==1}完成{else}拒付{/if}</td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </td></tr>
        <tr height="40" bgColor="white" ><td valign="middle">

            </td></tr>
    </table>
</form>

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

</body>

</html>
