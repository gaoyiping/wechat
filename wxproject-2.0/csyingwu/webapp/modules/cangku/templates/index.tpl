<html>
<head>
<title>仓库管理</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />

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
                                &nbsp;<span class="Font_red Font_addbold">[管理中心]</span> >> 仓库管理  
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br /><br/>

<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3"> 
      <td width="35%"><div align="center"><font color="#FFFFFF">仓库名称</font></div></td>
      <td width="15%"><div align="center"><font color="#FFFFFF">仓库编号</font></div></td>
      <td width="25%"><div align="center"><font color="#FFFFFF">添加时间</font></div></td>
      <td width="25%"><div align="center"><font color="#FFFFFF">操作</font></div></td>
    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr class="td4"> 
      <td> 
        <div align="center">{$item->cName}</div></td>
      <td> 
        <div align="center">{$item->csNO}</div></td>
      <td >
        <div align="center">{$item->pubdate}</div></td>
      <td>
        <div align="center">
          <a href="index.php?module=cangku&action=edit&id={$item->cID}">修改</a>  |
        {if $item->tistrue=='1'}
          <span style="color:red;">已删除</span>
        {else}
          <a href="index.php?module=cangku&action=del&id={$item->cID}" onclick="return confirm('确定要删除此分类吗?')">删除</a>
        {/if}          
        </div></td>
    </tr>
    {/foreach}
  </table>
</td></tr></table>
<br/>
<table align="center"><tr><td>
	{$pagehtml}
</td></tr></table>

<table border="0" align="center" width="95%" cellpadding="0" cellspacing="0"><tr><td>
  <input type="button" class="b02" value="添加仓库" onclick="location.href='index.php?module=cangku&action=add';" />
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
