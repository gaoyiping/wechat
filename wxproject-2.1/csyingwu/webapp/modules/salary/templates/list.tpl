<html>
<head>
<title>会员奖金列表</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>

    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="/new_style/js/jquery.js"></script>
    <script type='text/javascript' src='modpub/js/calendar.js'> </script>
    <script type="text/javascript" src="/FineMessBox/js/common.js"></script>
    <script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>

    {literal}
        <script type="text/javascript">
            function AlertMessageBox()
            {

            }
            function Showopen(sNo)
            {

                showPopWin('查看发放流程',"index.php?module=dailijin&action=view&sNo="+sNo, 640, 300, AlertMessageBox,true,true)
            }

            function modifyMoney(id){
                var money=document.getElementById("money"+id).value;
                var fx_money=document.getElementById("fx_money"+id).value;
                window.location.href="index.php?module=salary&action=modify&money="+money+"&id="+id+"&fx_money="+fx_money;
            }
        </script>
    {/literal}


</head>
<body scroll="yes">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[会员管理]</a></li>
        <li><a href="#">工资表</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    {literal}
        <script type="text/javascript">
            function ccolor(c){
                if(c.checked){
                    c.parentNode.parentNode.bgColor = 'green';
                } else {
                    c.parentNode.parentNode.bgColor = 'white';
                }
            }
            function e(t){
                var es = document.form2.elements;
                for(var i=0;i<es.length;i++){
                    if(es[i].type == 'checkbox' ){
                        if(t == 'a'){
                            es[i].checked = true; ccolor(es[i]);
                        }
                        if(t == 'o'){
                            es[i].checked = !es[i].checked; ccolor(es[i]);
                        }
                    }
                }
            }
        </script>
    {/literal}

            <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
            <tr><td>
                    <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                        <thead>
                        <tr>
                            <th>累计分销提成</th>
                            <th>累计绩效奖</th>
                            <th>累计分红奖</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="td4">
                            <td align="center"><b>{$cj|sprintf}</b></td>
                            <td align="center"><b>{$jdj|sprintf}</b></td>
                            <td align="center"><b>{$fxj|sprintf}</b></td>
                            
                        </tr>
                        </tbody>
                    </table>
                </td></tr>
        </table>
   

    <div>
        <form name="form1" action="index.php" method="get">
            <input type="hidden" name="module" value="salary" />
            <input type="hidden" name="action" value="list" />
            <table width=95% border=0 align="center" >
                <tr><td>
                        奖项
                        <select name="type" style="height:24px;">
                            <option value=""   >全部</option>
                            <option value="-1" {if $type==-1}selected{/if} >分销提成</option>
                            <option value="1" {if $type==1}selected{/if} >绩效奖</option>
                            <option value="2" {if $type==2}selected{/if} >分红奖</option>
                        </select>
                        会员编号<input name="user_id" value="{$user_id}" class="scinput_s" />
                        结算日期
                        <input name="startdate" value="{$startdate}" size="8" readonly class="scinput_s" />
                        <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
                        至
                        <input name="enddate" value="{$enddate}" size="8" readonly  class="scinput_s"/>
                        <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
                        <input type="submit" value="查 询" class="scbtn">

                    </td>
                    <td align="right">累计:￥ {$m|sprintf}</td>
                </tr>
            </table>
        </form>
    </div>

    <form name="form2" method="post" action="index.php?module=CertifiedUserList&action=okall" >
        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
            <tr><td>
                    <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                        <thead>
                        <tr>
                            <th>选</th>
                            <th>序</th>
                            <th>日期</th>
                            <th>会员编号</th>
                            <th>会员名称</th>
                            <th>等级</th>
                            <th>奖项</th>
                            <th>应发</th>
                            <th>购物币扣除</th>
                            <th>梦想币扣除</th>
                            <th>实发</th>
                            <th>来自谁</th>
                            <th>状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        {if $total==0}
                            <tr class="td4"><td colspan="12">暂无工资</td></tr>
                        {/if}
                        {foreach from=$rpros item=item name=f1}

                            <tr  class="td4"  onmouseover="this.style.background='#CDE6EB'" onmouseout="this.style.background='#fff';">
                                <td><input type="checkbox" name="ids[]" value="{$item->id}" onclick="ccolor(this);"/></td>
                                {*<td>{if $item->isf==0}<input type="checkbox" name="ids[]" value="{$item->id}" onclick="ccolor(this);"/>{/if}</td>*}
                                <td align="center">{$item->noid}</td>
                                <td align="center">{$item->add_date}</td>
                                <td align="center">{$item->userid}</td>
                                <td align="center">{$item->wxname}</td>
                                <td align="center">

                                    <font color="#116600">{if $item->uplevel==0} 见习小二{/if}</font>
                                    <font color="#1166FF">{if  $item->uplevel==1} 店小二{/if}</font>
                                    <font color="#966F12">{if $item->uplevel==6} 伙计{/if}</font>
                                    <font color="#966F12">{if $item->uplevel==2} 掌柜{/if}</font>
                                    <font color="#C40D74">{if  $item->uplevel==3} 东家{/if}</font>
                                    <font color="#C40D74">{if  $item->uplevel==4} 富豪{/if}</font>
                                     <font color="#C40D74">{if  $item->uplevel==5} 大富豪{/if}</font>
                                     <font color="#966F12">{if $item->uplevel==7} 董事{/if}</font>

                                </td>
                                <td align="center">
                                    {if $item->type==0}培育奖{/if}
                                    {if $item->type==1}绩效奖{/if}
                                    {if $item->type==2}分红奖{/if}
                                </td>
                                <td align="center" ><input style="width:100px" type="text" id="money{$item->id}" value="{$item->money|sprintf}" /><input  type="hidden" id="fx_money{$item->id}" value="{$item->fx_money|sprintf}" /></td>
                                 <td align="left" style="color:red">{$item->fx_money|sprintf}</td>
                                 <td align="left" style="color:red">{$item->tax_money|sprintf}</td>
                                <td align="right" style="color:blue">{$item->s_money|sprintf}</td>
                                <td align="center">{$item->fromuser}</td>
                                <td align="center">
                                    {if $item->isf==0}<a href="javascript:modifyMoney('{$item->id}');">修改</a> {/if}
                                    {if $item->isf==0}未发放{else}<font color="red">已发放</font>{/if}
                                </td>
                            </tr>

                        {/foreach}
                        </tbody>
                    </table>
                </td></tr>
            <tr height="35" bgColor="white" ><td valign="middle">
                    <a href="javascript:e('a');">全选</a> | <a href="javascript:e('o');">反选</a>
                    <input type="submit" class="scbtn" value="发放奖金" onclick="return confirm('确定要发放奖金吗？');"/>
                    </font>
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
    </form>


</div>

    <script language="javascript" src="/new_style/css/webjs.js"> </script>


<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
</body>
</html>
