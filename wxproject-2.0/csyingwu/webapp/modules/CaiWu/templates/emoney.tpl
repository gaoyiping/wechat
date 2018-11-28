<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>会员列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>

    <script language="javascript" src="modpub/js/calendar.js"> </script>
    <script type="text/javascript" src="/FineMessBox/js/common.js"></script>
    <script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>

    <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />

    {literal}
        <script>
            function AlertMessageBox()
            {



            }
            function Showopen(sNo)
            {
                showPopWin("查看"+sNo+"的账户奖金信息","index.php?module=FinanceStatus&user_id="+sNo, 800, 420, AlertMessageBox,true,true)
            }
        </script>
    {/literal}

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[店铺管理]</a></li>
        <li><a href="#">会员账户状况</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <form method="get" action="index.php?" name="form1">
        <input type="hidden" name="module" value="CaiWu" />
        <div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:38px; border-left:solid 1px #fff;border-right:solid 1px #fff; ">
            编号<input type="text" name="userid" class='scinput_s' value="{$userid}" style="width:100px;" />
            日期<input name="startdate" value="{$startdate}" size="8" class="scinput_s" readonly>
            <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);"/>
            至<input name="enddate" value="{$enddate}" size="8" class="scinput_s" readonly>
            <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);"/>
            <input type="submit" value=" 查 询 " class="scbtn"  >
        </div>
    </form>


    
        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
            <tr><td>
                    <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                        <thead>
                        <tr>
                            <th>序</th>
                            <th>店铺/微信名称</th>
                            <th>店铺编号</th>
                            <th>联系电话</th>
                            <th>注册日期</th>
                            <th>充值币余额</th>
                            <th>购物币余额</th>
                            <th>梦想劵余额</th>
                            <th>积分余额</th>
                            <th>累计积分</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach from=$list item=item name=f1}
                        <form action="index.php?module=CaiWu&action=okall" method="post" >
                            <input type="hidden" name="uid" value="{$item.user_id}" />
                            <tr bgColor=#ffffff >
                                <td align="center" >{$smarty.foreach.f1.iteration}</td>
                                <td align="center">{$item.user_name}&nbsp;/&nbsp;{$item.wxname}</td>
                                <td align="center">{$item.user_id}</td>
                                <td align="center">{$item.mobile}&nbsp;</td>
                                <td align="center">{$item.add_date}</td>
                                <td align="right"><input name="c_money" readonly value="{$item.c_money}" size='6' /></td>
                                <td align="right"><input name="z_money" readonly value="{$item.z_money}" size='6' /></td>
                                <td align="right"><input name="f_money" readonly value="{$item.f_money}" size='6' /></td>
                                <td align="right"><input name="j_money" value="{$item.j_money}" size='6' /></td>
                                <td align="right"><input name="e_money" value="{$item.e_money}" size='6'  /></td>
                                <td align="center">
                                    二级密码：<input type="password" name="password" size="3"/>
                                    <input type="submit" value="修改" />

                                </td>

                            </tr>
                        </form>
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

</body>

</html>
