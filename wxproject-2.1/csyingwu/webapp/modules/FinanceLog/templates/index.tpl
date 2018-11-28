<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>会员列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="modpub/js/calendar.js"> </script>
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[财务中心]</a></li>
        <li><a href="#">财务记录</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <form method="get" action="index.php" name="form1">
        <input type="hidden" name="module" value="FinanceLog" />
        <div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:38px; border-left:solid 1px #fff;border-right:solid 1px #fff; ">


            账户类型
                <select id="choose"  style="height:24px;" name="choose">
                <option value='0' {if $choose=="0"}selected{/if}  >全部类型</option>
                <option value='1' {if $choose=="1"}selected{/if} >注册消费</option>
                <option value='2' {if $choose=="2"}selected{/if} >在线充值</option>
                <option value='3' {if $choose=="3"}selected{/if} >奖金币转帐</option>
                <option value='4'{if $choose=="4"}selected{/if}  >奖金提现</option>
               
                <option value='8'{if $choose=="8"}selected{/if}  >购物币转账</option>
                <option value='9'{if $choose=="9"}selected{/if}  >充值币转帐</option>

            </select>

            产生日期
            <input name="startdate" value="{$startdate}" size="8" readonly class="scinput_s" />
            <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
            至
            <input name="enddate" value="{$enddate}" size="8" readonly class="scinput_s" />
            <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />

            转出者：<input name="userid" value="{$userid}" class="scinput_s">
            接受者：<input name="touserid" value="{$touserid}" class="scinput_s">

            
            &nbsp;&nbsp;<input type="submit" value="查 询" class="scbtn">
        </div>
    </form>



        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
            <tr><td>
                    <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                        <thead>
                        <tr>
                            <th>序</th>
                            <th>操作账号</th>
                             <th>接收账号</th>
                            <th>产生日期</th>
                            <th>账户类型</th>
                            <th>金额</th>
                            <th>备注</th>
                            <th>状态</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach from=$list item=item name=f1}

                            <tr class="td4">
                                <td align="center" height="30">{$smarty.foreach.f1.iteration}</td>
                                <td align="center">{$item.operation}</td>
                                <td align="center">{$item.accepter}</td>
                                <td align="center">{$item.add_date}</td>
                                <td align="center"> {if $item.type == '1'}注册消费{/if}
                                    {if $item.type == '2'}在线充值{/if}
                                    {if $item.type == '3'}电子币转帐{/if}
                                    {if $item.type == '4'}货币提现{/if}
                                    {if $item.type == '5'}零售消费{/if}
                                    {if $item.type == '7'}重复消费{/if}

                                    {if $item.type == '8'}购物币转帐{/if}
                                    {if $item.type == '9'}充值币转帐{/if}

                                <td align="center" >￥{$item.amount}</td>
                                <td>{$item.remark}{$item.rdesc}</td>
                                <td align="center">{if $item.status==0}<font color="red">处理中</font>{elseif $item.status==1}<font color="green">完成{else}拒付{/if}</font></td>
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

</body>

</html>
