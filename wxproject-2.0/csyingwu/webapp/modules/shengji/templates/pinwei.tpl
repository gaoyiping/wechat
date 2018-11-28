<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="modpub/css/base.css"/>
        <link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
 <script type='text/javascript' src='modpub/js/calendar.js'> </script>

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

                        <div style="margin-top: -1px; height: 30px;  overflow: hidden" id="ctl00_Div_right_top"
                            class="YFTmainright_r1_c2_gj">
                            <div style="position: relative; line-height: 30px; width: 100%">
                                &nbsp;<span class="">[商务中心]</span>  >> 聘位升级浏览
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="shengjishowping" />
<input type="hidden" name="action" value="list" />


<br />

<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3"> 
      <td width="5%"><div align="center"><font color="#FFFFFF">序号</font></div></td>
      <td width="12%"><div align="center"><font color="#FFFFFF">账号</font></div></td>
       <td width="12%"><div align="center"><font color="#FFFFFF">姓名</font></div></td>
        <td width="12%"><div align="center"><font color="#FFFFFF">原始聘位</font></div></td>
	 	<td width="12%"><div align="center"><font color="#FFFFFF">升级聘位</font></div></td>
	  <td width="20%"><div align="center"><font color="#FFFFFF">升级日期</font></div></td>

     
    </tr>
    {foreach from=$list item=item name=f1}
    <tr class="td4"> 
      <td> 
        <div align="center">{$smarty.foreach.f1.iteration}</div></td>
      <td> 
        <div align="center"><font color="#FF0000">{$item->uid}</font></div></td>
	 <td> 
        <div align="center"><font color="">{$item->user_name}</font></div></td>
	 <td> 
        <div align="center">
        
		
		<font color="#116600">{if $item->ylevel==0} 会员{/if}</font>
	<font color="#1166FF">{if  $item->ylevel==1} 主管{/if}</font>
	<font color="#966F12">{if $item->ylevel==2} 经理{/if}</font>
	<font color="#C40D74">{if  $item->ylevel>=3} 总监{/if}</font>
		
	</div></td>
	
		 <td> 
        <div align="center">
		
        <font color="#116600">{if $item->level==0} 会员{/if}</font>
	<font color="#1166FF">{if  $item->level==1} 主管{/if}</font>
	<font color="#966F12">{if $item->level==2} 经理{/if}</font>
	<font color="#C40D74">{if  $item->level>=3} 总监{/if}</font>
		
	</div></td>
	 <td> 	
        <div align="center"><font color="">{$item->zdate|date_format:'%Y-%m-%d'}</font></div></td>
      
   
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