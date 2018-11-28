<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>微优品店铺管理系统-移动版</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;">
<link href="/phone/modpub/css/css.css" type="text/css" rel="stylesheet">
<link href="/phone/modpub/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="/phone/modpub/js/jquery.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/dialog.js" type="text/javascript"></script> 


<link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<script type="text/javascript" src="/new_style/css/common.js"></script>
<script type="text/javascript" src="/new_style/css/GridViewText.js"></script>
<script type="text/javascript" src="/new_style/css/HashTable.js"></script>
<script type="text/javascript" src="/new_style/css/ShowColumn.js"></script>
<script type="text/javascript" src="/new_style/css/Popup.js"></script>
    
    
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
	
	
{literal}
<script type="text/javascript">
           
      function check(){
	  
	var money=parseInt(document.getElementById("ctl00_ContentPlaceHolder1_lbtotalmoney").innerHTML);
	  
	if((money)>(parseInt(f.spemoney.value)))
	{
	   alert("您的电子币不足!");
       return false;
	}

	var boo= confirm("系统将扣除您 ￥"+(money)+"电子币, 确定支付吗？");
    return boo;
 
}


function AlertMessageBox()
    {

	        
	         
    }
    
    function Showopen(id)
        {
	
            showPopWin('查看商品详细',"index.php?module=fxshowping&action=ok&id="+id, 250, 123, AlertMessageBox,true,true)
    }
        
    </script>
{/literal}	
</head>
<body>
<form name="f" action="index.php?module=fxshowping&action=Index" method="post" onsubmit="return check(this);">

  
  <div>
    <div class="manage_tit">
    <a id="ContentPlaceHolder1_LbtnExit" class="exit" href="index.php">[安全退出]</a>
    <a href="javascript:history.go(-1)" class="return"></a> <span class="linel"></span> <strong>复消录入</strong> </div>
    <div class="content">
      <div class="paw_change">
        <form name="f" action="index.php?module=fxshowping&action=Index" method="post" onsubmit="return check(this);">
                                        <table class="table" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td class="YFTTopNavigtion" colspan="2">
                                                        <div style="margin-top: 5px; display: inline; float: left">
                                                        </div>
                                                        <div style="display: inline; float: left">
                                                            <table id="ctl00_ContentPlaceHolder1_RadioList_PayMode" border="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                        </td>
                                                                        <td>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div style="margin-top: 2px; display: inline; float: left">
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="font-family: 微软雅黑; font-weight: bold">
                                                                            您好，{$spusername}！ 您的电子注册币余额还有:
                                                                        </td>
                                                                        <td valign="center">
                                                                            <span id="spusername" class="Font_red">{$spemoney|sprintf}
                                                                                <input type="text" style="display: none;" value="{$spemoney}" name="spemoney" /></span>
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="prd_border" valign="top" width="30%" style="border:2px solid red">
                                                        <table style="width: 100%" id="tb_product">
                                                            <tbody>
                                                                <tr class="YFTProductListBg">
                                                                    <td>
                                                                        <div style="margin-top: 5px; display: inline; float: left" class="YFTProductListImg ML5">
                                                                            &nbsp;</div>
                                                                        <div style="display: inline; float: left" class="YFTProductListFont ">
                                                                            &nbsp;产品列表</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 160px;">
                                                                        <div style="width: 100%" id="ctl00_ContentPlaceHolder1_ProductList1_palShowProduct">
                                                                            {$strMenu}
                                                                        </div>
                                                                        <div style="z-index: 100; position: absolute; background-color: #000000; display: none;
                                                                            color: #ffffff" id="PopupDiv">
                                                                        </div>
                                                                        
                                </div>
                    </td>
                </tr>
            </tbody>
        </table>
        </td>
		</tr>
		<tr>
        <td valign="top">
            
            <div class="titl_bg" style="text-align:center">
                &nbsp;&nbsp;<span style="font-family: 微软雅黑; font-weight: bold">商品订单列表（请红框内勾选对应商品）</span>
            </div>
            <div class="MT10">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            
                            <td>
                                <div id="ctl00_ContentPlaceHolder1_UpdatePanel2">
                                    <div style="width: 100%; overflow: hidden" class="prd_border">
                                        <div style="line-height: 25px; width: 100%" class="AligntoLeft Height25 prd_title_bg">
                                            <div class="AligntoLeft">
                                                &nbsp;</div>
                                            <div class="AligntoLeft Width40">
                                                <span class="Font_white">序号</span>
                                            </div>
                                            <div style="overflow: hidden" class="AligntoLeft Width200">
                                                <span class="Font_white">产品名称</span>
                                            </div>
                                            <div class="AligntoLeft Width100">
                                                <span class="Font_white">产品价格</span>
                                            </div>
                                            <div class="AligntoLeft Width100" >
                                                <span class="Font_white">原值</span>
                                            </div>
                                            <div class="AligntoLeft Width60">
                                                <span class="Font_white">数量</span>
                                            </div>
                                            <div class="AligntoLeft Width60">
                                                <span class="Font_white">单位</span>
                                            </div>
                                            <div class="AligntoLeft Width50">
                                                <span class="Font_white">操作</span>
                                            </div>
                                        </div>
                                        <div style="border-bottom: #cccccc 1px solid; overflow-x: hidden; overflow-y: scroll;
                                            width: 100%; height: 200px; word-break: break-all" class="Width_per100 AlgintoLeft">
                                            <div id="ctl00_ContentPlaceHolder1_PanelProductList">
                                  
                                                <table width="613" border="0" cellpadding="0" cellspacing="1" id="SignFrame">
                                                </table>
                                            </div>
                                        </div>
                                        <div style="float: right;font-size:14px;color:#385B6F;">
                                           <b> 共(<span id="ctl00_ContentPlaceHolder1_lbtypeprd" class="Font_red">0</span>)种产品,&nbsp;
                                            产品订购总金额：<span id="ctl00_ContentPlaceHolder1_lbtotalmoney" class="Font_red">0.00</span>
                                            <div style="display:none">产品累计PV值：<span id="ctl00_ContentPlaceHolder1_lbtotalpv" class="Font_red">0.00</span></div></b>
                                        </div>
                                    </div>
                                  <input name='txtTRLastIndex' type='hidden' id='txtTRLastIndex' value="1" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </td>
        </tr> </tbody> </table> </form>
      </div>
	  
	  <div class="paw_icon">
		 <input type="submit" value=""  class="sub">
		  
      </div>
	  
    </div>
  </div>
  <div class="menu_footer">
    <ul>
      <li class="wid20"><a href="index.php?module=index" class="xxgl">首页</a></li>
      <li class="wid20"><a href="index.php?module=tuijian" class="cwgl">网络部门</a></li>
      <li class="wid20"><a href="index.php?module=swzx" class="hygl">商务中心</a></li>
      <li class="wid20"><a href="index.php?module=cwzx" class="dzhb">财务中心</a></li>
      <li class="bac_no wid20"><a href="index.php?module=grzx" class="xtgl">个人中心</a></li>
    </ul>
  </div>

</form>
</body>
</html>
