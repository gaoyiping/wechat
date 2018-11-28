<html>
<head>
<title>物流详细单</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link type="text/css" rel="stylesheet" href="modpub/css/base.css"/>

{literal}
<SCRIPT language=javascript>
function printpr() //预览函数
{
document.all("qingkongyema").click();//打印之前去掉页眉，页脚
document.all("dayinDiv").style.display="none"; //打印之前先隐藏不想打印输出的元素（此例中隐藏“打印”和“打印预览”两个按钮）
var OLECMDID = 7;
var PROMPT = 1;
var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
WebBrowser1.ExecWB(OLECMDID, PROMPT);
WebBrowser1.outerHTML = "";
document.all("dayinDiv").style.display="";//打印之后将该元素显示出来（显示出“打印”和“打印预览”两个按钮，方便别人下次打印）
}

function printTure() //打印函数
{
 document.all('qingkongyema').click();//同上
 document.all("dayinDiv").style.display="none";//同上
 window.print();
 document.all("dayinDiv").style.display="";
}
function doPage()
{
 layLoading.style.display = "none";//同上
}

</SCRIPT>

<script language="VBScript">
dim hkey_root,hkey_path,hkey_key
hkey_root="HKEY_CURRENT_USER"
hkey_path="\Software\Microsoft\Internet Explorer\PageSetup"
'//设置网页打印的页眉页脚为空
function pagesetup_null()  
on error resume next  
Set RegWsh = CreateObject("WScript.Shell")  
hkey_key="\header"  
RegWsh.RegWrite hkey_root+hkey_path+hkey_key,""  
hkey_key="\footer"  
RegWsh.RegWrite hkey_root+hkey_path+hkey_key,""  
end function  

'//设置网页打印的页眉页脚为默认值
function pagesetup_default()  
on error resume next  
Set RegWsh = CreateObject("WScript.Shell")  
hkey_key="\header"  
RegWsh.RegWrite hkey_root+hkey_path+hkey_key,"&w&b页码，&p/&P"  
hkey_key="\footer"  
RegWsh.RegWrite hkey_root+hkey_path+hkey_key,"&u&b&d"  
end function
</script>

{/literal}
</head>
<body background="#ffffff">


<form name="form1" method="post">
  

 		
		<table width="600" align="center"><tr bgcolor="">
       
        <td align="center" colspan=6 style="height:30px;font-size:18px;">
	 <b>顾客快速销售单</b>
	</td>
	</tr></table>
		<table width="598" align="center"  style="border:solid 1px #dedede;" border="0" cellpadding="0" cellspacing="0" >
		
	<tr >
        {foreach from=$list item=item12 name=f2} {/foreach}
        <td align="left"  style="height:32px;font-size:14px;width:400px;">
	 &nbsp;<b>订单号:{$dingdaninfo->sNo}</b>
	</td>
	 <td align="right"  style="height:32px;font-size:14px;">
	 &nbsp;<b>订单日期:{$dingdaninfo->pubdate}</b>&nbsp;
	</td>
	
	</tr>
			<tr bgcolor="white">
       
        <td align="left"  style="height:32px;border-top:solid 1px #dedede;font-size:14px;">
	 &nbsp;<b>顾客姓名:{$dingdaninfo->gname}<b>
	</td>
	  <td   style="height:32px;border-top:solid 1px #dedede;font-size:14px;padding-left:7px;">
	 <b>联系电话:{$dingdaninfo->rtel}<b>
	</td>
	</tr>
	<tr bgcolor="white">
       
        <td align="left"  style="height:27px;font-size:14px;">
	&nbsp;<b>顾客地址:{$dingdaninfo->dizhi}<b>
	</td>
	<td style="height:27px;font-size:14px;padding-left:7px;" >
	<b>总计金额:{$dingdaninfo->zongji}￥<b>
	</td>
	
	</tr>
		<tr bgcolor="white">
       
        <td align="left" colspan=2 style="padding:15px; height:220px;border-top:solid 1px #dedede;font-size:14px;" valign="top">
	<b>产品信息：</b><br />&nbsp;
	 	  <table border="0" cellpadding="3" cellspacing="0" width="98%" style="border-collapse: collapse;">
	     <tr>
           
              <td align="left" style="padding-left:20px;font-size:14px;">
	      <div>
	  {foreach from=$list item=item2 name=f1}
	
        
           <li style="float:left;width:265px;height:28px;">[{$item2->rsNo}] {$item2->rname} {$item2->rnum}{$item2->rdanwei} ￥{$item2->rnum*$item2->shoujia} </li>
        
          
	 
	  {/foreach}
	  </div>
	   </td>
          
            </tr>
          </table>
	
	</tr>
	
	<tr >
       
        <td  colspan=4  style="padding:15px;font-size:14px;height:28px;">
	{$userinfo->dianpuname} 地址：{$userinfo->dianpudizhi} 联系电话：{$userinfo->dianputel}
	</td>
	  
	</tr>


			  </table>
			  <br />
      
   



</form>
<DIV align="center" id="dayinDiv" name="dayinDiv"><input type="button" class="b02" value=" 打 印 " onclick="printTure();">&nbsp;&nbsp;
<input type="button"class="b02" value="打印预览" onclick="printpr();">
<input type="hidden" name="qingkongyema" id="qingkongyema" class="b02" value="清空页码" onclick="pagesetup_null()">&nbsp;&nbsp;
<input type="hidden" class="tab" value="恢复页码" onclick="pagesetup_default()">
</DIV>
</body>
</html>
