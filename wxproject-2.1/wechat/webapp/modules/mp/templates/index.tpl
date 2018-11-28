<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
  
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/skin.css" />
    <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
<script type="text/javascript">
{literal}
 function AlertMessageBox(file_name)
 {
 }
      function ShowDepartID(id)
        {
            showPopWin("查看新闻通过","index.php?module=Notice&action=view&id="+id, 650, 400, AlertMessageBox,true,true)
        }
    function cuxiao(id)
        {
	
            showPopWin("查看系统消息","index.php?module=cuxiao&action=detail&id="+id, 650, 400, AlertMessageBox,true,true)
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
                                &nbsp;<span class="Font_red Font_addbold">[系统首页]</span> 
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible;"
                            id="Div_Content">     <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="2" valign="top">
                            
                       
                       </td>
                        <td>
                            </td>
                        <td valign="top">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" valign="top">
                            
                            <span class="left_txt">
                                <div style="padding:20px;text-align:left;line-height:23px;">
<font style="font-size:14px;"><b><font color="red" >{$user_name}</font>,欢迎您登录店铺办公平台</b></font><br />
特别提示：<br />
1、为了保障您的个人账户安全，请不要在网吧及公共场合登陆系统。 <br />
2、请您在没有在电脑旁时请退出系统，已防止他人进入系统恶意操作。 <br />
3、请将您的登陆密码设置为10-16位，并用字符和字母及数字组合。 <br />

4、如系统有任何的操作异常，请截图保存并及时的联系管理员。 <br />
</div>
                                    </span>
                        </td>
                        <td width="3%">
                            </td>
                        <td width="40%" valign="top">
                            <table width="100%" height="144" border="0" cellpadding="0" cellspacing="0" class="line_table">
                                <tr>
                                    
                                    <td width="94%"   background="/new_style/images/bt_bg.gif">
                                        <span style='float:right;'>&nbsp;<a href='index.php?module=Notice'>全部</a></span>&nbsp;&nbsp;<b>新闻通告</b></td>
                                </tr>
                                <tr>
                                    <td height="102" valign="top"  colspan="2">
                                       {$str_tonggao}</td>
                                </tr>
                                <tr>
                                    <td height="5" colspan="2">
                                        &nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                   
                    <tr>
                        <td colspan="2" valign="top">
			<table >
			<tr>
			 <td><img src="/new_style/images/pe_bg.jpg" /></td>
			 <td> <div style="padding-left:0px;font-size:12px;">
			 	<!--<li style="float:left;list-sytle:none;width:200px;">电子货币余额：<font color="#C17821" style='font-size:16px;'>￥ {$user->e_money}.00</font></li>
			  <li style="float:left;list-sytle:none;width:200px;">注册货币余额：<font color="#C17821" style='font-size:16px;'>￥ {$user->z_money}.00</font></li></div>
			  -->
			  <div style="padding-top:20px;padding-left:0px;font-size:12px;">
			  <li style="float:left;list-sytle:none;width:200px;">能量币余额：<font color="#C17821" style='font-size:16px;'>￥ {$amounts|sprintf}</font></li>
			 <!-- <li style="float:left;list-sytle:none;width:200px;">累计提现金额：<font color="#C17821" style='font-size:16px;'>￥ {$tixianjin}.00</font></li></div></td>-->
			</tr>
			</table>
                         
                        </td>
                        <td>
                            &nbsp;</td>
                        <td valign="top">
                            <table width="100%" height="144" border="0" cellpadding="0" cellspacing="0" class="line_table">
                                <tr>
                                  
                                    <td width=100%"  style="" background="/new_style/images/bt_bg.gif">
                                        <span style='float:right;'>&nbsp;<a href='index.php?module=Message&action=geted'>全部</a></span>
					&nbsp;<b>系统消息</b></td>
                                </tr>
                                <tr>
                               
                                    <td height="102" valign="top">
                                       {$str_cuxiao}
                                    </td>
                                </tr>
                                <tr>
                                    <td height="5" colspan="2">
                                        &nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="40" colspan="4">
                            <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                                <tr>
                                    <td>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        
                        <td  class="left_txt" colspan="4">
                            </td>
               
                        <td>
                            &nbsp;</td>
                        <td>
                            &nbsp;</td>
                    </tr>
                </table>
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
