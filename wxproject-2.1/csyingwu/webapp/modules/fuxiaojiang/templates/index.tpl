<html>
<head>
<title>结算奖金</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">{literal}
function ok()
{
 
  var isSure=  confirm('确定要结算吗？');


  if(isSure==true)
  {
    document.getElementById("dd1").style.display="none";
    document.getElementById("dd2").style.display="none";
     document.getElementById("span1").innerHTML="<img src='/new_style/images/loading_circle.gif' /> 结算中请稍候...";
  }
  return isSure;
}
{/literal}</script>
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
</head>
<body scroll="yes">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[奖金管理]</a></li>
        <li><a href="#">分红奖结算</a></li>
    </ul>
</div>

<div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        <script>
                                     
                        </script>

                        
                        <div style="min-height: 446px; width: 100%;padding:5px; height: auto !important; overflow: visible"
                            id="Div_Content">
<div id="ctl00_ContentPlaceHolder1_UpdatePanel1" style="width:100%;text-align:center;">
	
         <br /><br /><br /><br />
        <div  class="YFT_fenhongjiang_bg" style="padding-top:45px;" name="div1" id="div1">

<br/>
<form method="post" action="" name="form1" >
	<input type="hidden" name="per_money" value="0" />
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0" name="table1"   id="table1">
    <tr>
        <td align="center">
            <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0" >
                <tr>
                    <td height="25" style="padding-top: 50px; padding-left: 230px;" >
                     <span id="dd1">   上期期数：{if $info->sNo==""}无 &nbsp;&nbsp;&nbsp;结算日期：无{else}{$info->sNo} 期 &nbsp;&nbsp;&nbsp;结束日期：{$info->add_date}{/if}</span>
                    <span id="span1"></span>
		    </td>
                </tr>
                <tr>
                    <td height="25" style="padding-top: 20px; padding-left: 230px;" >
                        <input type="text" name="sNo" style="display: none;" value="{if $info->sNo==""}1{else}{$info->sNo+1}{/if}" />
                        <span id="dd2"><input type="submit" value="本期奖金结算" onclick="return ok();" class="b02" /></span>
                    </td>
                </tr>
                <tr>
                    <td height="25" style="padding-top: 20px; padding-left: 230px;">
                    </td>
                </tr>
                <tr id="user_list_tr" style="display: none;">
                    <td>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0" class="hengcss"
                style="margin-left: 2px;">
                <tr>
                    <td align="center">
                        <br />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table align="center" width="100%" height="60" border="0" cellpadding="0" cellspacing="0"
                class="dicss" style="margin-left: 3px;">
                <tr>
                    <td>
                        &nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br />
</form>
 </div>
 

 </div> </DIV>
   
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