<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="modpub/css/base.css"/>
        <link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
 <script type='text/javascript' src='modpub/js/calendar.js'> </script>
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
{literal}
<script type="text/javascript">
    function AlertMessageBox()
    {

	        
	         
    }
        function Showopen(userid)
        {
	
            showPopWin('查看会员信息',"index.php?module=RegMember&action=view&userid="+userid, 600, 320, AlertMessageBox,true,true)
        }
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
                                &nbsp;<span class="Font_red Font_addbold">[会员办公平台]</span> >> 我注册的会员 >> 会员列表
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="RegMember" />
<input type="hidden" name="action" value="list" />

<table width="95%" border=0 align="center">
  <tr><td>
  
 账号 <input type="text" name="keyword" id="keyword" class="button1"  style="width:70px;"/>
 &nbsp;昵称 <input type="text" name="keyword" id="keyword" class="button1"  style="width:70px;"/>

 &nbsp;注册日期
      <input name="startdate" value="{$startdate}" size="7" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.startdate);" />
      至
      <input name="enddate" value="{$enddate}" size="7" readonly class="button1" />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.enddate);" />
   <input type="submit" value=" 查 询 " class="b02"  >
  </td></tr>
</table>
</form></div>
<br />

<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3"> 
      <td width="5%"><div align="center"><font color="#FFFFFF">序号</font></div></td>
      <td width="12%"><div align="center"><font color="#FFFFFF">会员账号</font></div></td>
       <td width="12%"><div align="center"><font color="#FFFFFF">会员昵称</font></div></td>
        <td width="12%"><div align="center"><font color="#FFFFFF">安置账号</font></div></td>
	  <td width="12%"><div align="center"><font color="#FFFFFF">推荐账号</font></div></td>
	 <td width="12%"><div align="center"><font color="#FFFFFF">会员类型</font></div></td>
	  <td width="20%"><div align="center"><font color="#FFFFFF">注册日期</font></div></td>
      <td width="10%"><div align="center"><font color="#FFFFFF">审核状态</font></div></td>
      <td width="10%"><div align="center"><font color="#FFFFFF">操作</font></div></td>
    </tr>
    {foreach from=$list item=item name=f1}
    <tr class="td4"> 
      <td> 
        <div align="center">{$smarty.foreach.f1.iteration}</div></td>
      <td> 
        <div align="center"><font color="#FF0000">{$item->user_id}</font></div></td>
	 <td> 
        <div align="center"><font color="">{$item->user_name}</font></div></td>
	 <td> 
        <div align="center"><font color="">{$item->anzhi}</font></div></td>
	 <td> 
        <div align="center"><font color="">{$item->tuijian}</font></div></td>
		 <td> 
        <div align="center">
	<font color="#116600">{if $item->level==1} 普卡会员{/if}</font>
	<font color="#1166FF">{if  $item->level==2} 金卡会员{/if}</font>

	</div></td>
	 <td> 
        <div align="center"><font color="">{$item->add_date|date_format:'%Y-%m-%d'}</font></div></td>
      <td>
        <div align="center">通过</div></td>
      <td>
        <div align="center"><a href="#" onclick="Showopen('{$item->user_id}');">查看</a></div></td>
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