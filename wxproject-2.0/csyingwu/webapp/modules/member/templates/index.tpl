<html>
<head>
<title>公告</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />

<body scroll="yes">

  <div class="place">
    <ul class="placeul">
        <li><a href="#">[系统管理]</a></li>
        <li><a href="#">管理员列表</a></li>
    </ul>
</div>


<div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br />

<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" class="tablelist"  cellspacing="1" width="100%">
    <tr> 
      <th width="5%">序</th>
      <th width="40%">帐号</th>
      <th width="25%">操作</th>
    </tr>
    {foreach from=$members item=item name=f1}
    <tr class="td4"> 
      <td> 
        <div align="center">{$smarty.foreach.f1.iteration}</div></td>
      <td> 
        <div align="center"><font color="#FF0000">{$item->admin_id}</font></div></td>

      <td>
        <div align="center"><a href="index.php?module=member&action=edit&id={$item->admin_id}">修改</a>  |
          <a href="index.php?module=member&action=del&id={$item->admin_id}" onclick="return confirm('确定要删除吗?')">删除</a>
        </div></td>
    </tr>
    {/foreach}
  </table>
</td></tr></table><br />
<table align="center"  border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td><input type="button" class="b02" value="添加人员" onclick="location.href='index.php?module=member&action=detail';" /></td></tr></table>
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

