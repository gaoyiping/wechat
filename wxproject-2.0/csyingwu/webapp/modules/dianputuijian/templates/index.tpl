<html>
<head>
<title>推荐店铺</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <script type="text/javascript" src="modpub/js/ajax.js"> </script>
    <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>

     {literal}
<script language="JavaScript" >



function ShowMenu(img,MenuID,width) 
{ 

if(document.getElementById("Menu"+MenuID).style.display=="none") 
{ 
document.getElementById("Menu"+MenuID).style.display=""; 
img.src="/new_style/images/expand.gif"; 
document.getElementById("1Menu"+MenuID).src="/new_style/images/foldopen_1.gif"; 
 document.getElementById("Menu"+MenuID).innerHTML="&nbsp;&nbsp;&nbsp;正在加载!";
 var url = "index.php?module=dianputuijian&action=ajax&GroupID="+MenuID+"&width="+width;

  ajax(url,function(text){
    arr=text.split("|");
   
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
                                &nbsp;<span class="Font_red Font_addbold">[店铺管理]</span> >> 店铺连锁图
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br/>
  <form name="form1" action="index.php" method="get">
			    <input type="hidden" name="module" value="tuijian" />
<table align="center"  border="0" cellpadding="0" cellspacing="0" width="98%"><tr><td>

 <input type="text" style="width:20px; height:20px;background-color:#116600" /> 会员店  
 <input type="text" style="width:20px; height:20px;background-color:#1166FF" /> 加盟店
 <input type="text" style="width:20px; height:20px;background-color:#000000" /> 形象店
  
</td></tr></table>

<div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:10px;border-top:solid 1px #dedede; border-left:solid 1px #fff;border-right:solid 1px #fff; ">
店铺账号：<input type="text" name="userid" class='button1' value="{$userid}" style="width:100px;" />       <input class="b02"  type="submit" value="查 询"   /></div>
</form>
<br />
<div style="padding-left:50px;">
{$userlist_str}
<div id="pid_error"></div>
<div>
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
