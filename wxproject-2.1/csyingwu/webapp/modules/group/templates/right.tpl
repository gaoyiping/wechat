
<html>
<head>
<title>
区域代理
</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
</head>

<body>
  <table width="100%" border="0" cellspacing="1" cellpadding="3" align="center">
						<tr class="tdTitle">
							<td colspan="2"><span id="ctl00_PageBody_CatListTitle">地区列表 {$G_CName}</span></td>
						</tr>
						<tr>
							<td class="table_body">
                                地区</td>
							<td class="table_none">
								<span id="ctl00_PageBody_CatNameTxt">地区列表</span></td>
						</tr>
                      <tr>
                          <td class="table_body">
                              下级地区</td>
                          <td class="table_none">
								<span id="ctl00_PageBody_CatCountTxt">{$G_ChildCount}</span></td>
                      </tr>
						
						<tr>
							<td colspan="2" class="tdTitle">下级地区</td>
						</tr>
						<tr class="table_body">
							<td>
                                地区</td>
							<td>下级地区数</td>
						</tr>
						

						   {foreach from=$rpros item=item name=f1}

								<tr class="table_none">
									<td width="50%">{$item->G_CName}</td>
									<td width="50%">{$item->num}</td>
								</tr>
    {/foreach}


								
						
					</table>
					<div align="center" style="padding-top:10px;"> <input type="button" class="b02" value="添加地区" onclick="location.href='index.php?module=group&action=add&GroupID={$G_ParentID}';" />
					<input type="button" class="b02" value="修改地区" {if $GroupID==""}style="display:none;"{/if} onclick="location.href='index.php?module=group&action=edit&GroupID={$GroupID}';" />
					<input type="button" class="b02" value="删除地区" {if $GroupID==""}style="display:none;"{/if} onclick="location.href='index.php?module=group&action=del&id={$GroupID}';" />
					</div>
</body>
</html>
