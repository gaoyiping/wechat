<html>
<head>
<title>零售商品</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
    <script type='text/javascript' src='modpub/js/calendar.js'> </script>
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
                                &nbsp;<span class="Font_red Font_addbold">[综合办公]</span> >> 汇款充值审核
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;"></div>
<br />
<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3">  
    <td width="3%"><div align="center"><font color="#FFFFFF">序</font></div></td>
        <td width="15%"><div align="center"><font color="#FFFFFF">用户编号</font></div></td>
	
      <td width="12%"><div align="center"><font color="#FFFFFF">用户汇款户名</font></div></td>
        <td width="9%"><div align="center"><font color="#FFFFFF">汇款金额</font></div></td>

        <td width="12%"><div align="center"><font color="#FFFFFF">汇款银行</font></div></td>
        <td width="12%"><div align="center"><font color="#FFFFFF">汇款日期</font></div></td>
  
         <td width="16%"><div align="center"><font color="#FFFFFF">申请日期</font></div></td>
      <td width="12%"><div align="center"><font color="#FFFFFF">操作</font></div></td>
 
    </tr>
    {foreach from=$logs item=item name=f1}
    <tr class="td4"> 
       <td align="center">{$item->id}</td><td>
        <div align="center">{$item->userid}</div></td>
      <td> 
        <div align="center">{$item->username}</div></td>
	 <td> 
        <div align="center">{$item->money}</div></td>
	
   
    <td> 
        <div align="center">{$item->bankname}</div></td>
      
   <td>
        <div align="center">{$item->pay_date}</div></td>
    
	
	 <td>
        <div align="center">{$item->add_date|date_format:'%Y-%m-%d'}</div></td>
    
	<td >
        <div align="center"><a style="color:red" href="index.php?module=paycheckout&action=check&id={$item->id}&userid={$item->userid}&money={$item->money}">审核</a></div></td>
	
    </tr>
    {/foreach}
  </table>
</td></tr></table>

<br/>
<table align="center"><tr><td>
<div class="pages">
  {$pagehtml}
  </div>
</td></tr></table>




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
