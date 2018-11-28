<html>
<title>二级密码</title>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css"/>
{literal}
<script type="text/javascript">
function check(f){
  if(f.spwd.value == ''){
    alert("请输入你的二级密码 !");
    f.spwd.focus();
    return false;
  }
  return true;
}
</script>
{/literal}	
</head>
<body>

<form name="form1" method='post' onsubmit="return check(this);"
  action="index.php?module=SecondLogin&action=sed">
  <table width='100%' height='70%' align='center' border='0'>
    <tr><td align="center" valign="middle">
      <font size='2pt'>二级密码:</font> 
      <input name="spwd" type="password" size="20"/> 
      <input class='button1' type="submit" value="提交"/>  
      <p style="color:red;">{$error}</p>
    </td></tr>
  </table>
</form>

</body>
</html>
