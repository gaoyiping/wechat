<html>
<head>
<title>零售订单</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />



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
<body scroll="yes"  >
<form name="form1" method="post">

 
                      	<table width="620" align="center" ><tr bgcolor="">
       
        <td align="center" colspan=6 style="height:30px;font-size:18px;">
	 <b>产品订购单</b>
	</td>
	</tr></table>
		<table width="618" align="center"  border="0" cellpadding="0" cellspacing="0" >
		
	<tr >
        {foreach from=$list item=item12 name=f2} {/foreach}
        <td align="left"  style="height:32px;font-size:14px;">
	 &nbsp;订单号:{$pinfo->sNo}
	</td>
	 <td align="right"  style="height:32px;font-size:14px;">
	 &nbsp;订货日期:{$pinfo->add_date}&nbsp;
	</td>
	
	</tr>
		<tr bgcolor="white">
       
        <td align="left" colspan=2 style="padding:15px; {if $num<19}height:300px;{/if}{if $num>18}height:600px;{/if}border:solid 1px #dedede;font-size:14px;" valign="top">
	产品订购明细：<br />&nbsp;
	  <table border="0" cellpadding="3" cellspacing="0" width="98%" style="border-collapse: collapse;">
	     <tr>
           
              <td align="left" style="padding-left:20px;font-size:14px;">
	      <div>
	  {foreach from=$list item=item2 name=f1}
	
       
           <li style="float:left;width:275px;height:27px;">[{$item2->rsNo}] {$item2->rname} {$item2->rnum}{$item2->rdanwei} </li>
   	 

	  {/foreach}
	  </div>
	   </td>
          
            </tr>
          </table>
	
	</tr>
	
	</tr>
		<tr bgcolor="white">
       
        <td align="left"  style="height:32px;font-size:14px;width:420px;">
	 &nbsp;收货人:{$pinfo->post_name}
	</td>
	  <td   style="height:32px;font-size:14px;padding-left:40px;">
	 联系电话:{$pinfo->post_tel}
	</td>
	</tr>
	<tr bgcolor="white">
       
        <td align="left"  style="height:27px;font-size:14px;">
	&nbsp;物流地址:{$pinfo->post_address}
	</td>
	<td style="height:27px;font-size:14px;padding-left:40px;" >
	总计金额:￥{$pinfo->emoneys}
	</td>
	
	
	
	</tr>

			  </table>
                   
</form>
  
</body>
</html>