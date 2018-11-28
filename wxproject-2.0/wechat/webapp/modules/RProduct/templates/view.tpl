<html>
<head>
<title>零售商品详情</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
</head>
<body>
<br/><br/>

<table width="90%" height="10px" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#99FFFF">
  <tr>
    <td width="100%" valign="top">
      <p style="padding:10px;text-align:center;font-size:16px">产品详细信息</p>
      <table width="90%" height="200px" border="0" align="center" bgcolor="#FFFFFF">
        <tr>
          <td align='center' bgcolor="#CCFFFF" height="30px">
            <big><strong>{$rpro->pname}</strong></big></td></tr>      
        <tr>
          <td bgcolor="#CCFFFF" valign="top">
            <span style="line-height:20px;letter-spacing:1px;">{$rpro->detail} </span></td>
        </tr>
      </table>    
      <p align="center"><br/>
        <input value="返回" class="b02" type="button" onclick="history.back();" /><br/><br/><br/></p>
    </td>
  </tr>
</table>

</body>
</html>
