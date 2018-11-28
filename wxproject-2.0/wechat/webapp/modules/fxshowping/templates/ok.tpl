<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />

</head>
<body scroll="yes">
    <div id="divShowExplain_26_116" class="YFT_float_subclass" style="background-color: rgb(207, 207, 207);">
    <table id="tbShowExplain_26_116" style="BORDER-COLLAPSE: collapse;width:auto!important; min-width:250px;  overflow:visible; line-height:20px;background-color:#FFF;" bordercolor="#CFCFCF" cellspacing="0" border="1" width="100%" align="center"><tbody><tr><td rowspan="5" class="Width100" align="center">
    {if $pingzheng->imgURL}
    <img src="/upfile/{$pingzheng->imgURL}" style="width:110px;height:85px;">
    {else}
     <img src="/new_style/images/nopic.jpg" style="width:110px;height:85px;">
    {/if}
    </td>
    <td align="right" style="width:45px;">名称:</td>
    <td align="left" class="Font_green" width="120">{$pingzheng->pname}</td>
    </tr>
    
    <tr>
    <td align="right">采购价:</td>
    <td align="left">{$pingzheng->zhekou} RMB</td>
    </tr>
    
    <tr>
    <td align="right">市场价:</td>
    <td align="left">{$pingzheng->zhuanmaijia} RMB</td>
    </tr>
    
    <tr>
    <td align="right">规格:</td>
    <td align="left">{$pingzheng->guige}</td>
    </tr>
    
    <tr>
    <td align="right">装箱数:</td>
    <td align="left">{$pingzheng->zhuangxiangshu}</td>
    </tr>
    
    </tbody></table></div>
    
    
    <DIV align="center" id="dayinDiv" name="dayinDiv"><input type="button" class="b02" value=" 关闭 " onclick="window.parent.hidePopWin(true);" />
</DIV>

</body>
</html>
