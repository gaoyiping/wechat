<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="modpub/css/base.css"/>
   <link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />

{literal}
<script type="text/javascript">

</script>
{/literal}
</head>
<body  scroll="yes">

  <div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        <script>
                                     
                        </script>

                        <div style="margin-top: -1px; height: 30px; overflow: hidden" id="ctl00_Div_right_top"
                            class="YFTmainright_r1_c2_gj">
                            <div style="position: relative; line-height: 30px; width: 100%">
                                &nbsp;<span class="">[商务中心]</span> >> 信息统计
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content">
			    <br /><br /><br /><br /><br />
 <div id="ctl00_ContentPlaceHolder1_UpdatePanel1" style="width:100%;text-align:center;">


 <div  class="YFT_up_tongji_bg" style="text-align:left;padding-left:60px; ">
<p style="padding-top:60px;">
  </p>
<table   border='0' cellpadding=4 cellspacing=1 style="">

   <tr>
    <td  align="right">账号：</td>
    <td><font color="#A63821">{$userinfo->user_id}</td>
  </tr>
 <tr>
    <td align="right">类型：</td>
    <td> 
	<font color="#116600">{if $userinfo->uplevel==0} 会员{/if}</font>
	<font color="#1166FF">{if  $userinfo->uplevel==1} 主管{/if}</font>
	<font color="#966F12">{if $userinfo->uplevel==2} 经理{/if}</font>
	<font color="#C40D74">{if  $userinfo->uplevel>=3} 总监{/if}</font>
	</td>
  </tr>
  <tr>
    <td  align="right">聘位：</td>
    <td><font color="#A63821">{$userinfo->user_id}</td>
  </tr>
   <tr>
    <td  align="right">累计pv：</td>
    <td><font color="#A63821">{$userinfo->user_id}</td>
  </tr>
    <tr>
    <td  align="right">部门业绩：</td>
    <td><font color="#A63821">{$userinfo->user_id}</td>
  </tr>
  
  </table>
  </div>
     </div>

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
