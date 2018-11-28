<html>
<head>
<title>交易记录</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="modpub/css/base.css">

    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
<script type='text/javascript' src='modpub/js/calendar.js'> </script>

<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
<script>
{literal}
    function AlertMessageBox()
    {         
    }
        function Showopen(sNo)
        {
	
            showPopWin('查看订单详细信息',"index.php?module=HandleOrder&action=view&sNo="+sNo, 640, 500, AlertMessageBox,true,true)
        }
</script>
{/literal}
</head>
<body scroll="yes">

  <div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        <script>
                                     
                        </script>

                        <div style="margin-top: -1px; height: 30px;  overflow: hidden" id="ctl00_Div_right_top"
                            class="YFTmainright_r1_c2_gj">
                            <div style="position: relative; line-height: 30px; width: 100%">
                                &nbsp;<span class="Font_red Font_addbold">[进销存管理]</span> >> 未审核的预订单
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible;"
                            id="Div_Content">
<div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="HandleOrder" />
<table width="98%" border=0 align="center">
  <tr><td>
   
      <a href="index.php?module=yudingdan&ok=3"><b>未审核预订单</b></a> 
      | <a href="index.php?module=weitongguo" >未通过预订单</a> 
      | <a href="index.php?module=yudingdan" >已审核预订单</a> &nbsp;&nbsp;
    订货日期
      <input name="startdate" value="{$startdate}" size="8" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
      至
      <input name="enddate" value="{$enddate}" size="8" readonly class="button1"/>
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
   <input type="submit" value="查询"  class="b02" />
  </td><td align="right">
<p align="right">
 
</p>
  </td></tr>
</table>
</form>
</div>
<br />
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
<table align="center"  border="0" cellpadding="0" cellspacing="0" width="98%" bgcolor="#dedede" >
	<tr><td>
		<table align=center border="0" cellpadding="4" cellspacing="1" width="100%" >
			<tr class="td3">
 
        <td width="20px" align="center">序</td>
	<td align="center">订单号</td>
	<td width="80px" align="center">店铺账号</td>
	<td width="80px" align="center">订货人</td>
	<td width="80px" align="center">联系电话</td>
				<td width="80px" align="center">订货日期</td>
				<td align="center">件数</td>
				<td align="center">订单总额</td>
			
				
				
				
			        <td  align="center">操作</td>
			</tr>
			{foreach from=$list item=item1 name=f1}
			<tr bgcolor="white">

        <td align="center">{$smarty.foreach.f1.iteration}</td>
	<td align="center">{$item1->sNo}</td>
	<td align="center">{$item1->user_id}</td>
	<td align="center">{$item1->post_name}</td>
	<td align="center">{$item1->post_tel}</td>
				<td align="center">{$item1->add_date|date_format:'%Y-%m-%d'}</td>
				
				<td align="center">{$item1->counts}</td>
		
				
	<td align="center">￥{$item1->emoneys}</td>
				
				
			      
			      <td align="center"><a href="index.php?module=yudingdan&action=deit&sNo={$item1->sNo}" >
<font color="red">审核订单</font></a> | <a href="#" onclick="Showopen('{$item1->sNo}');">查看详细</a></td>
			</tr>
      {/foreach}
		</table>
	</td></tr>
	
 
</table>
</form>
<br />
<table align="center"><tr><td>
<div class="pages">
  {$pagehtml}
  </div>
</td></tr></table>
 </div>
                    </td>
                </tr>
                <tr>
                    <td class="YFTmainright_r3_c2_gj" height="1">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>
</html>

