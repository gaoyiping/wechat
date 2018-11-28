<html>
<head>
<title>消息浏览</title>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<link type="text/css" href="modpub/css/base.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
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
                                &nbsp;<span class="">[个人中心]</span> >> 消息浏览
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content">
        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible" id="Div_Content">
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;提示：点击处理可将状态变成已读<br/><br/>
<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3"> 
      <td width="4%"><div align="center"><font color="#FFFFFF">序</font></div></td>
      <td width="7%"><div align="center"><font color="#FFFFFF">接收账号</font></div></td>
      <td width="50%"><div align="center"><font color="#FFFFFF">消息内容</font></div></td>
   
      <td width="15%"><div align="center"><font color="#FFFFFF">发送时间</font></div></td>
      <td width="6%"><div align="center"><font color="#FFFFFF">状态</font></div></td>
    </tr>
    {foreach from=$list item=item name=f1}
    <tr class="td4"> 
      <td> 
        <div align="center">{$smarty.foreach.f1.iteration}</div></td>
      <td> 
        <div align="center"><font color="#FF0000">{$item->r_user_id}</font></div></td>

 <td> 
        <div >{$item->content}</div></td>
      <td>
        <div align="center">{$item->add_date}</div></td>
      <td >
        <div align="center">
	{if $item->isdu==0}
	    <a href="index.php?module=Message&action=del&id={$item->id}" onclick="return confirm('确定要处理此条消息吗?')" style="color:red;">处理</a>
	{else}
	 已读
	{/if}
        
        </div></td>
    </tr>
    {/foreach}
  </table>
</td></tr></table><br />

<table align="center"><tr><td>
	{$pagehtml}
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
