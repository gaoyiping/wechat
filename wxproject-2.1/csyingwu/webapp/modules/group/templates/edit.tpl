<html>
<head>
<title>
区域代理
</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
</head>
{literal}
<script type="text/javascript">
function check(f){	

  if(document.getElementById("G_CName").value==""){
    alert("代理区域不能为空！");
  
    return false;
  }



  return true;
}
</script>
{/literal}
<body scroll="no">
<form action="index.php?module=group&action=edit" method="post" onsubmit="return check(this);" enctype="multipart/form-data">
<input type="hidden" name="GroupID" value="{$GroupID}" />
<input type="hidden" name="G_Level" value="{$G_Level}" />
  <table width="100%" border="0" cellspacing="1" cellpadding="3" align="center">
						<tr class="tdTitle">
							<td colspan="2"><span id="ctl00_PageBody_CatListTitle">地区列表</span></td>
						</tr>
						<tr style="display:none;">
							<td class="table_body">
                                上级地区</td>
							<td class="table_none">
								<span id="ctl00_PageBody_CatNameTxt"> {if $G_CName==""}顶级地区{else}{$G_CName}{/if}</span></td>
						</tr>
                      <tr>
                          <td class="table_body">
                              地区</td>
                          <td class="table_none">
								<span id="ctl00_PageBody_CatCountTxt"> <input name="G_CName" type="text" style="width:140px;" value="{$G_CName}"/></span></td>
                      </tr>
						
						
						


								
						
					</table>
					<div align="center" style="padding-top:10px;"> <input type="submit" class="b02" value="提交"/>
					<input type="button" class="b02" value="返回" {if $GroupID==""}style="display:none;"{/if} onclick="location.href='index.php?module=group&action=right&GroupID={$GroupID}';" /></div>
</form>
</body>
</html>
