<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>交易记录</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>

    <script type="text/javascript" src="/FineMessBox/js/common.js"></script>
    <script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
    <script type='text/javascript' src='modpub/js/calendar.js'> </script>

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

            showPopWin('查看订单详细信息',"index.php?module=HandleOrder&action=view&sNo="+sNo, 640, 550, AlertMessageBox,true,true)
        }
    </script>
    {/literal}
</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[进销存管理]</a></li>
        <li><a href="#">未发货订单</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">

    <form name="form1" action="index.php" method="get">
        <input type="hidden" name="module" value="HandleOrder" />
        <table width=95% align="center" border=0>
            <tr><td>
                    <div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:38px; border-left:solid 1px #fff;border-right:solid 1px #fff; ">

                        <a href="index.php?module=HandleOrder"><b>未发货订单</b></a> | <a href="index.php?module=HandleOrder&ok=1" >未签收订单</a> | <a href="index.php?module=HandleOrder&ok=2" >已完成的订单</a> &nbsp;&nbsp;
                        会员编号 <input name="userid" value="{$userid}" size="8"  class="scinput_s" />
                        订货日期
                        <input name="startdate" value="{$startdate}" size="8" readonly class="scinput_s" />
                        <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
                        至
                        <input name="enddate" value="{$enddate}" size="8" readonly class="scinput_s"/>
                        <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
                        <input type="submit" value="查询"  class="scbtn" /> <input type="button" value="导出EXCEL" class="b02" onclick="location.href=location.href+'&pageto=all';"> 
                </td><td align="right">
                    </div>
            </td></tr>
</table>
</form>


<form name="form2" method="post" action="index.php?module=HandleOrder&action=confirmall" >
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
                        <td width="3%"><div align="center"><font color="#FFFFFF">选</font></div></td>
                        <th>序</th>
                        <th>订单号</th>
                        <th>店铺账号</th>
                        <th>订货人</th>
                        <th>联系电话</th>
                        <th>订货日期</th>
                        <th>件数</th>
                        <th>订单总额</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$list item=item1 name=f1}
                        <tr bgcolor="white">
 <td><input type="checkbox" name="ids[]" value="{$item1->id}" onclick="ccolor(this);"/></td>
                            <td align="center">{$smarty.foreach.f1.iteration}</td>
                            <td align="center">{$item1->sNo}</td>
                            <td align="center">{$item1->user_id}</td>
                            <td align="center">{$item1->post_name}</td>
                            <td align="center">{$item1->post_tel}</td>
                            <td align="center">{$item1->add_date}</td>

                            <td align="center">{$item1->counts}</td>

                            <td align="center">￥{$item1->moneys}</td>

                            <td align="center"><a  href="index.php?module=HandleOrder&action=confirm&id={$item1->id}"
                                                  onclick="return confirm('确定要审核吗？');">
                                    <font color="red">审核发货</font></a> | <a class="tablelink" href="#" onclick="Showopen('{$item1->sNo}');">查看订单</a></td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </td></tr>
        <tr height="40" bgColor="white" ><td valign="middle">
                <a href="javascript:e('a');">全选</a> | <a href="javascript:e('o');">反选</a>
                <input type="submit" class="scbtn" value="审核选定项" onclick="return confirm('确定要同意选定项吗？');"/>
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

    <tr>
        <td
            class="YFTmainright_r3_c2_gj" height="1">
        </td>
    </tr>

</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>

</html>
