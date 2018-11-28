<html>
<title>修改公告</title>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>

{literal}
<script type="text/javascript">
function check(f){	
	if(Trim(f.admin_id.value)==""){
		alert("帐号不能为空!");
		f.admin_id.value = '';
		return false;
	}
	
	if(Trim(f.first_pwd.value)==""){
		alert("一级密码不能为空!");
		f.first_pwd.value = '';
		return false;
	}
  return true;
}
</script>
{/literal}
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />

<body scroll="yes">

  <div class="place">
    <ul class="placeul">
        <li><a href="#">[系统管理]</a></li>
        <li><a href="#">管理员列表 >> 新增</a></li>
    </ul>
</div>

<div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br />
  
<form action="index.php?module=member&action=detail" method="post" onsubmit="return check(this)">
  <table align="center"  border="0" cellpadding="0" cellspacing="0" width="90%">
  <tr><td>
  
      <td align="left">
      <table cellspacing="1" cellpadding="1" width="100%">
       <tr class="tdTitle" > 
      <th height="25" align="center" colspan=2> 
        <font  > 新增人员 </font></th>
    </tr>
    <tr bgcolor="#FFFFFF">
       <td  class="table_body">帐号：</td> <td class="table_none"> <input name="admin_id"  class="button1"  type="text" id="title"  value="{$id}" style="width:260px;" /></td>
  	</tr>
   <tr bgcolor="#FFFFFF">
       <td  class="table_body">一级密码：</td> <td class="table_none"> <input name="first_pwd"  class="button1"  type="text" id="title"   style="width:260px;" /> </td>
  	</tr>
  	<tr bgcolor="#FFFFFF">
       <td  class="table_body">二级密码：</td> <td class="table_none"> <input name="second_pwd"  class="button1"  type="text" id="title"   style="width:260px;" /> </td>
  	</tr>
  </table> <p align="center"> 
          <input type="submit" name="Submit" value="新增" class="b02">
          &nbsp;&nbsp;&nbsp; 
        <input type="button" name="Submit2" value="返 回" class="b02" onclick="window.location.href='index.php?module=member';">
        </p>
  </td></tr></table>
</form>

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
