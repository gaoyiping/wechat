<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>我的人气</title>
    {php}include BASE_PATH."/modules/Top/templates/index.tpl";{/php}  
    
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>

{literal}
<script language="JavaScript" >
function AlertMessageBox()
    {

	        
	         
    }
        function Showopen(userid)
        {
	
            showPopWin('查看会员信息',"index.php?module=RegMember&action=view&userid="+userid, 320, 320, AlertMessageBox,true,true)
        }


function ShowMenu(img,MenuID,width) 
{ 

if(document.getElementById("Menu"+MenuID).style.display=="none") 
{ 
document.getElementById("Menu"+MenuID).style.display=""; 
img.src="/new_style/images/expand.gif"; 
document.getElementById("1Menu"+MenuID).src="/new_style/images/foldopen_1.gif"; 
 document.getElementById("Menu"+MenuID).innerHTML="&nbsp;&nbsp;&nbsp;正在加载!";
 var url = "index.php?module=tuijian&action=ajax&GroupID="+MenuID+"&width="+width;

  ajax(url,function(text){
    arr=text.split("[@]");
   
    document.getElementById("Menu"+MenuID).innerHTML=arr[0];
    });

} 
else 
{ 
document.getElementById("Menu"+MenuID).style.display="none"; 
img.src="/new_style/images/collspand.gif"; 
document.getElementById("1Menu"+MenuID).src="/new_style/images/foldclose.gif"; 
} 
} 





</script> 
{/literal}
    </head>
    <body>
	<div class="header_03">
      <div class="back"> <a href="index.php?module=index" class="arrow"></a> </div>
      <div style="" class="tit">
    <h3>我的人气</h3>
  </div>
      {php}include BASE_PATH."/modules/Menu/templates/index.tpl";{/php}
</div>
<section style="width:100%;margin:45px auto 0;overflow:hidden;">
      <div class="user" style="padding-top:20px"> 
    *点击加号显示下层会员
     		{$userlist_str}
     
  		</div>
</section>
﻿
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  


</body>
</html>