
<html>
<head>
<title>
代理区域
</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />
</head>
     {literal}
<script language="JavaScript" >
function ShowMenu(img,MenuID) 
{ 

if(document.getElementById(MenuID).style.display=="none") 
{ 
document.getElementById(MenuID).style.display=""; 
img.src="/new_style/images/expand.gif"; 
document.getElementById("1"+MenuID).src="/new_style/images/foldopen_1.gif"; 
} 
else 
{ 
document.getElementById(MenuID).style.display="none"; 
img.src="/new_style/images/collspand.gif"; 
document.getElementById("1"+MenuID).src="/new_style/images/foldclose.gif"; 
} 
} 

 function xNowMove(xName)
 {
    if (xName!="")
    {
       
            window.returnVal = xName+"||";
            window.parent.hidePopWin(true);
           
    }
 }

</script> 
{/literal}
<body  scroll="yes" bgcolor="#ffffff"><br />
<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="98%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3"> 
     <td width="20px" align="center">序</td>
     <td width=""><div align="center"><font color="#FFFFFF">产品编号</font></div></td>

      <td width=""><div align="center"><font color="#FFFFFF">产品名称</font></div></td>
       <td width=""><div align="center"><font color="#FFFFFF">规格</font></div></td>
  
    
	        <td width="10%"><div align="center"><font color="#FFFFFF">单位</font></div></td>

      <td width="13%"><div align="center"><font color="#FFFFFF">操作</font></div></td>
    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr class="td4" onmouseover="this.style.background='#D7EEFF'" onmouseout="this.style.background='#fff';"> 
    <td align="center">{$smarty.foreach.f1.iteration}</td>
     <td> 
        <div align="center">{$item->sNo}</div></td>

      <td> 
        <div align="center">{$item->pname}</div></td>
	  <td> 
        <div align="center">{$item->guige}</div></td>
      
  
	
      <td >
        <div align="center">{$item->danwei}</div></td>
      <td>
        <div align="center">
          <a href="#" onclick="xNowMove('{$item->sNo}');">选中</a> 
        </div></td>
    </tr>
    {/foreach}
  </table>
</td></tr></table>
<br/>
<table align="center"><tr><td>
	{$pagehtml}
</td></tr></table>
</body>
</html>
