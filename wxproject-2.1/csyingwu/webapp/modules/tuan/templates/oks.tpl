<html>
<head>
<title>用户提现</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="modpub/css/base.css">
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
 <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
        <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
<script>
{literal}
    function AlertMessageBox()
    {

	        location.href='index.php?module=TiXiandanbao';
	         
    }
        function Showopen(id)
        {
	
            showPopWin("不同意原因","index.php?module=TiXiandanbao&action=del&id="+id, 460, 280, AlertMessageBox,true,true)
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
                                &nbsp;<span class="Font_red Font_addbold">[财务管理]</span> >> 未处理的店铺提现申请
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br />

<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="tuan" />
<table width=95% align="center" border=0>
  <tr><td>
      <a href="index.php?module=tuan">未处理申请</a> | <a href="index.php?module=tuan&ok=1" ><b>已处理申请</b></a> &nbsp;&nbsp;
    申请日期
      <input name="startdate" value="{$startdate}" size="8" readonly class="button1"/>
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
      至
      <input name="enddate" value="{$enddate}" size="8" readonly class="button1"/>
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
      <input type="submit" value="查 询" class="b02"> </td><td align="right">
   
    总计：<font color="red">{$total}</font>条    
   
  </td></tr>
</table>
</form>

<form name="form2" method="post" action="index.php?module=tuan&action=okall" >
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
<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%">
	<tr><td>
		<table width=100% align=center border="0" cellpadding="5" cellspacing="1">
			<tr class="td3">
        <td width="2%"><div align="center"><font color="#FFFFFF">序</font></div></td>
				<td width="12%"><div align="center">申请时间</div></td>
				<td width="10%"><div align="center">帐号</div></td>
				<td width="15%"><div align="center">名称</div></td>
				<td width="8%"><div align="center">几人制</div></td>
				<td width="15%"><div align="center">团队名称</div></td>
				<td width="11%"><div align="center">手机</div></td>
				<td width="11%"><div align="center"><font color="#FFFFFF">审核时间</font></div></td>
			</tr>
			{foreach from=$list item=item name=f1}
			<tr align=middle bgColor="white">
        <td>{$smarty.foreach.f1.iteration}</td>
		<td>{$item->add_date}</font></td>
				<td align="center">{$item->operation}</td>
				<td align="center">{$item->e_mail}</td>
				<td align="center">{$item->amount}人制</td>
				<td align="center">{$item->name}</td>
        		<td>{$item->mobile}</td>
				<td>{$item->replay_date}</td>
			</tr>
      {/foreach}
		</table>
	</td></tr>
  
</table>
</form>
<br/>
<p align="center">{$pagehtml}</p> 

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
