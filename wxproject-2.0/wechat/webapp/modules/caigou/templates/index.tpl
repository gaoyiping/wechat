<html>
<head>
<title>产品订购</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
        <script type="text/javascript" src="/new_style/css/caigou.js"></script>

{literal}<script type="text/javascript">

function check(f,zongji){
  var jine=0;

  for(i=1;i<=zongji;i++){
               
                jine=parseInt(jine)+ parseInt(document.getElementById("xiaoji"+i).value);
 }
if(parseInt(jine)==0)
{
    alert("您没有选择产品!");
  return false;
}
if(parseInt(jine)>parseInt(document.getElementById("zhongjine").value))
{
 alert("您的电子货款不够支付您选购的产品,请调整你要购买的产品数量！");
  return false;
}
     
 var aaa = document.getElementById('next');

       aaa.disabled=true; 


 window.setTimeout("update()", 5000);   
 
    return confirm("您确认要提交预订单吗？");
  }

function update() {   
  
   document.getElementById('next').disabled=false;   
	   
}   


</script>{/literal}
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
                                &nbsp;<span class="Font_red Font_addbold">[进销存管理]</span> >> 产品订购 >> 第一步 <font color="red">（选购产品）
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="caigou" />
<table width="95%" border=0 align="center">
  <tr><td>
   您的电子货币余额：<font style="font-size:14px;color:red;">￥{$spemoney}.00</font>
  
   &nbsp;&nbsp;&nbsp;当前产品订购合计：<font style="font-size:14px;color:red;">￥<span id="hejimoney">.00</span></font>
  </td><td align="right">
<p align="right">
 产品关键字 <input type="text" name="keyword" id="keyword" class="button1"  style="width:100px;"/>
   <input type="submit" value=" 查 询 " class="b02"  >

</p>
  </td></tr>
</table>
</form></div>
<br />
 <form action="index.php?module=caigou&action=Index" method="post" onsubmit="return check(this,{$zongji});" >
  <input type="text" name="tzongji" id="tzongji" value="{$zongji}" style="display:none;" />
  <input type="text" name="zhongjine" id="zhongjine" value="{$spemoney}"  style="display:none;"/>
<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr class="td3"> 
     <td width="10"  align="center">序</td>
     <td width="100"><div align="center"><font color="#FFFFFF">产品类别</font></div></td>
     <td width="100"><div align="center"><font color="#FFFFFF">产品编号</font></div></td>
        <td  ><div align="center"><font color="#FFFFFF">产品名称</font></div></td>
     <td ><div align="center"><font color="#FFFFFF">规格</font></div></td>
     <td width="55"><div align="center"><font color="#FFFFFF">装箱数量</font></div></td>
        <td width="40"><div align="center"><font color="#FFFFFF">单价</font></div></td>
  
         <td width="35"><div align="center"><font color="#FFFFFF">单位</font></div></td>
  

	 <td width="55"><div align="center"><font color="#FFFFFF">剩余数量</font></div></td>
	
      <td width="60"><div align="center"><font color="#FFFFFF">订购数</font></div></td>
       <td width="70"><div align="center"><font color="#FFFFFF">小计</font></div></td>
    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr class="td4" onmouseover="this.style.background='{$item->bgcolor}'" onmouseout="this.style.background='#fff';"> 
            <td align="center"  bgcolor="{$item->bgcolor}">{$smarty.foreach.f1.iteration}</td>
     <td  bgcolor="{$item->bgcolor}">
        <div align="center">{$item->tname}</div></td>
      <td> 
        <div align="center">{$item->sNo}
	 <input type="text" name="tid{$smarty.foreach.f1.iteration}" style="display:none;" id="tid{$smarty.foreach.f1.iteration}" value="{$item->id}" />
	  <input type="text" name="pname{$smarty.foreach.f1.iteration}" style="display:none;" id="pname{$smarty.foreach.f1.iteration}" value="{$item->pname}" />
	  <input type="text" name="tiaoma{$smarty.foreach.f1.iteration}" style="display:none;" id="tiaoma{$smarty.foreach.f1.iteration}" value="{$item->tiaoma}" />
	   <input type="text" name="tsNo{$smarty.foreach.f1.iteration}" style="display:none;" id="TsNo{$smarty.foreach.f1.iteration}" value="{$item->sNo}" />
	    <input type="text" name="tdanwei{$smarty.foreach.f1.iteration}" style="display:none;" id="tdanwei{$smarty.foreach.f1.iteration}" value="{$item->danwei}" />
	     <input type="text" name="trliushui{$smarty.foreach.f1.iteration}" style="display:none;" id="trliushui{$smarty.foreach.f1.iteration}" value="{$item->rliushui}" />

	</div></td>
       <td>
        <div align="center">{$item->pname}</div></td>
   <td> 
        <div align="center">{$item->guige}</div></td>
	 <td> 
        <div align="center">{$item->zhuangxiangshu}</div></td>
    <td> 
        <div align="center">{$item->zhuanmaijia} <input type="text" name="jiage{$smarty.foreach.f1.iteration}" style="display:none;" id="jiage{$smarty.foreach.f1.iteration}" value="{$item->zhuanmaijia}" /></div></td>
      
   
	 <td height="20">
        <div align="center">{$item->danwei}</div></td>
    
	
	
      <td>
      <div align="center">{$item->ruku-$item->chuku}</div></td>
      <td>
        <div align="center">
          <input type="text" name="tnum{$smarty.foreach.f1.iteration}" id="tnum{$smarty.foreach.f1.iteration}" onblur="updateNum(this,{$smarty.foreach.f1.iteration},{$item->ruku-$item->chuku},{$zongji},{$spemoney},{$item->qidingnum},1);" 
 onkeyup="updateNum(this,{$smarty.foreach.f1.iteration},{$item->ruku-$item->chuku},{$zongji},{$spemoney},{$item->qidingnum},2);" value="0" style="height:19px;width:40px;text-align:right;"/>
        </div></td>
	<td>
        <div align="center">
          ￥<input type="text" name="xiaoji{$smarty.foreach.f1.iteration}" id="xiaoji{$smarty.foreach.f1.iteration}"   value="0" style="height:19px;border:solid 0px #fff;width:60px;"/>
        </div></td>
    </tr>
    {/foreach}
  </table>
 
</td></tr></table>
<br/>
<div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">

<table width="95%" border=0 align="center">
  <tr><td>
   您的可用货款：<font style="font-size:14px;color:red;">￥{$spemoney}.00</font>
  
   &nbsp;&nbsp;&nbsp;当前产品订购合计：<font style="font-size:14px;color:red;">￥<span id="hejimoney1">.00</span></font>
  </td><td align="right">

  </td></tr>
</table>
</div>
 <div style="text-align:center;">
 <input type="submit" value=" 下一步 " class="b02"  name="next" id="next">
 </div>
<br />
 </form>	

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
