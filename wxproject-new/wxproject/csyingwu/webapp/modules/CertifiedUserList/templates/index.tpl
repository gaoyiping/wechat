<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>会员列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>

    <script type='text/javascript' src='modpub/js/calendar.js'> </script>
    <script type="text/javascript" src="/FineMessBox/js/common.js"></script>
    <script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
    <script type="text/javascript" src="modpub/js/ajax.js"> </script>

    <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
    {literal}
        <script language="JavaScript" >
            function AlertMessageBox() {
            }
            function Showopen(userid) {
                showPopWin('查看会员信息',"index.php?module=CertifiedUserList&action=view&userid="+userid, 600, 400, AlertMessageBox,true,true)
            }
        </script>
    {/literal}
</head>


<body scroll="yes">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[店铺管理]</a></li>
        <li><a href="#">会员/店铺列表</a></li>
    </ul>
</div>

    <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
         id="Div_Content">
        <div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:72px; border-left:solid 1px #fff;border-right:solid 1px #fff; ">
{*<div style="border:solid 1px #dedede;width:100%;height:80px;border-left:solid 0px;border-right:solid 0px;">*}
    <form name="form1" action="index.php" method="get">
        <input type="hidden" name="module" value="CertifiedUserList" />
        <table width=99% border=0 align="center" >
            <tr><td>
                聘位
                <select name="uplevel" style="height:24px;">
                    <option value="" >全部</option>
                    <option value="0">见习小二</option>
                    <option value="1">店小二</option>
                    <option value="6">伙计</option>
                    <option value="7">管家</option>
                    <option value="2">掌柜</option>
                    <option value="3">东家</option>
                    <option value="4">富豪</option>
                    <option value="5">大富豪</option>
                </select>

                编号/姓名
                    <input type='text' name='keyword' size='8' value="{$keyword}" class="scinput_s"/>
                推荐编号
                <input type='text' name='p_node' size='8' value="{$p_node}" class="scinput_s"/>
                联系电话
                <input type='text' name='phone' size='8' value="{$phone}" class="scinput_s" />
                注册日期
                <input name="startdate" value="{$startdate}" size="8" readonly class="scinput_s" />
                <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
                至
                <input name="enddate" value="{$enddate}" size="8" readonly  class="scinput_s"/>
                <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
                <br />   <br />
                <input type="submit" value="查 询" class="scbtn">
                <input type="button" value="导出EXCEL" class="scbtn" onclick="location.href=location.href+'&pageto=all';">
            </td></tr>
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
                        <th>店铺编号</th>
                        <th>微信名称</th>
                        <th>会员名称</th>
                        <th>类型</th>
                        <th>推荐编号</th>
                        <th>联系电话</th>
                        <th>所在区域</th>
                        <th>注册时间</th>
                        <th>报单中心</th>
                        <th>操作</th>
                    </tr>
                </thead>
            <tbody>
        {foreach from=$userlist item=item name=f1}
            <tr bgColor=#FFFFFF>
                <td><input type="checkbox" name="ids[]" value="{$item->id}" onclick="ccolor(this);"/></td>
                <td align="center">{$item->noid}</td>
                <td align="center">{$item->user_id}</td>
                 <td align="center">{$item->wxname}</td>
                <td align="center">{$item->user_name}</td>
                <td align="center">
                    <font color="#116600">{if $item->level==0} 见习小二{/if}</font>
                    <font color="#1166FF">{if  $item->level==1} 店小二{/if}</font>
                    <font color="#33AAFF">{if  $item->level==6} 伙计{/if}</font>
                    <font color="#116600">{if  $item->level==7} 管家{/if}</font>
                    <font color="#966F12">{if $item->level==2} 掌柜{/if}</font>
                    <font color="#C40D74">{if  $item->level==3} 东家{/if}</font>
                    <font color="#C40D74">{if  $item->level==4} 富豪{/if}</font>
                    <font color="#C40D74">{if  $item->level==5} 大富豪{/if}</font>
                </td>
                <td align="center">{$item->tuijian}</td>
                <td align="center">&nbsp;{$item->mobile}</td>
                <td align="center">{$item->s1}{$item->s2}{$item->s3}</td>
                <td align="center">&nbsp;{$item->add_date|date_format:'%Y-%m-%d'}</td>
                <td align="center">
                    {if $item->tui1==1}是{else}否{/if}
                </td>
                <td align="center">
                    <a href="index.php?module=CertifiedUserList&action=modify&id={$item->user_id}" class="tablelink" >修改</a> |
                    <a href="#" onclick="Showopen('{$item->user_id}');" class="tablelink">查看</a></td>
            </tr>
        {/foreach}
        </tbody>
    </table>
    </td></tr>
            <tr height="40" bgColor="white" ><td valign="middle">
                    <a href="javascript:e('a');">全选</a> | <a href="javascript:e('o');">反选</a>
                    <input type="submit" class="scbtn" name="lock" value="设置报单中心" onclick="return confirm('设置报单中心？');"/>
                    <input type="submit" class="scbtn" name="lock" value="取消报单中心" onclick="return confirm('取消报单中心？');"/>
                    </font>
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
