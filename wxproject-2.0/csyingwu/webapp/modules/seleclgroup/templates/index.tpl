
<html>
<head>
<title>
代理区域
</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
</head>
     {literal}
<script language="JavaScript" >
function ShowMenu(img,MenuID,GroupID,width,fuID,funame) 
{ 

if(document.getElementById(MenuID).style.display=="none") 
{ 
document.getElementById(MenuID).style.display=""; 
img.src="/new_style/images/expand.gif"; 
document.getElementById("1"+MenuID).src="/new_style/images/foldopen_1.gif"; 

 var url = "index.php?module=seleclgroup&action=ajax&GroupID="+GroupID+"&width="+width+"&fuID="+fuID+"&funame="+funame;
  ajax(url,function(text){
    arr=text.split("|");
   
    document.getElementById(MenuID).innerHTML=arr[0];
    });

} 
else 
{ 
document.getElementById(MenuID).style.display="none"; 
img.src="/new_style/images/collspand.gif"; 
document.getElementById("1"+MenuID).src="/new_style/images/foldclose.gif"; 
} 
} 


 function xNowMove(xName,xId,yID,yname,sname)
 {
    if (xId!="")
    {
        if (confirm("选择地区【"+ yname+"-"+xName +"】 ?\n\n确定吗？"))
        {
            window.returnVal = yname+"-"+xName+"||"+xId+"||"+yID+"||"+sname+"||";
            window.parent.hidePopWin(true);
            //window.close();
        }      
    }
 }

</script> 
{/literal}
<body  scroll="yes" bgcolor="#ffffff">
{$userlist_str}
</body>
</html>
