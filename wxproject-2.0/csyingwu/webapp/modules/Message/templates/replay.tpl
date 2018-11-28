<html>
<head>
<title>回复留言</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link type="text/css" rel="stylesheet" href="modpub/css/base.css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>
</head>
{literal}
<script type="text/javascript">
function check(f){
	if(Trim(f.content.value)==""){
		alert("回复的内容不能为空！");
    f.content.value = '';
    return false;
	}
  return true;
}
</script>
{/literal}
<body>
<br/><br/>

<form name="form1" method="post" action="index.php?module=Message&action=replay" onsubmit="return check(this);">
<input type="hidden" name="id" value="{$id}" />
<table width="70%" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr><td height="35" align="center" bgcolor="0F9BF4"> 
    <strong><font color="#ffffff" size="2">回 复 留 言</font></strong></td></tr>
  <tr><td>
    <table width="100%" border="0" cellspacing=1 cellpadding=5 bgcolor="B5B5B5">
      <tr  bgcolor="ffffff"> 
        <td height="30" align="right" width="100"><strong>主题：</strong></td>
        <td height="30">{$msg->title}</td>
      </tr>
      <tr bgcolor="ffffff"> 
        <td height="30" align="right"><strong>留言人：</strong></td>
        <td height="30">{$msg->user_id}</td>
      </tr>
      <tr bgcolor="ffffff"> 
        <td height="30" align="right"><strong>留言内容：</strong></td>
        <td height="30">{$msg->content}</td>
      </tr>
      <tr bgcolor="ffffff"> 
        <td height="30" align="right"><strong>回复内容：</strong></td>
        <td height="30">
          <textarea name="content" cols="50" rows="8" >{$msg->r_content}</textarea></td>
      </tr>
      <tr bgcolor="ffffff"> 
        <td height="30" align="center" colspan=2>
          <input type="submit" name="Submit" value="提 交" class="b02" /> 
          <input type="reset" name="reset" value="重 写"  class="b02" />
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</form>

</body>
</html>
