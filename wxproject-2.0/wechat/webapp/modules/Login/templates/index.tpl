<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>冰维斯系统-移动版</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;">
<link href="/phone/modpub/css/css.css" type="text/css" rel="stylesheet">
<link href="/phone/modpub/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="/phone/modpub/js/jquery.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/dialog.js" type="text/javascript"></script> 
</head>
<body class="bluebg">
<form method="post" action="index.php?module=Login"  id="form1">
  
  <div class="mem_tit">会员登录</div>
  <div class="mem_log">
    <div class="log_inp">
      <div class="l"></div>
      <div class="m">
        <label class="txt">用户名：</label>
        <div class="inputwrap">
          <input name="uID" type="text" id="TxtUserNumb" placeholder="请输入账号" autocomplete="off" >
        </div>
      </div>
      <div class="r"></div>
    </div>
    <div class="log_inp">
      <div class="l"></div>
      <div class="m">
        <label class="txt">密　码：</label>
        <div class="inputwrap">
          <input name="uPwd" type="password" id="TxtUserPwd" placeholder="请输入密码" autocomplete="off" >
        </div>
      </div>
      <div class="r"></div>
    </div>
    <div class="w100 fl">
      <div class="log_inp" style="width:80%;">
        <div class="l"></div>
        <div class="m">
          <label class="txt">验证码：</label>
          <div class="inputwrap">
            <input name="validateNum" type="text" id="TxtValCode" placeholder="请输入验证码" autocomplete="off" style="width:98%;">
          </div>
        </div>
        <div class="r"></div>
      </div>
      <div class="yzm"><a href="javascript:reloadCode();"><img id="loginCode" src="authcode.php" border="0" style="height:20px;margin-bottom:-3px;"></a></div>
    </div>
    <div class="mem_icon">
      <div class="l"></div>
      <div class="m">
        <input type="submit" name="BtnLogin" value="手机登录" onclick="return LoginVal();" id="BtnLogin">
      </div>
      <div class="r"></div>
    </div>
  </div>
</form>

{literal}
<script type="text/javascript">
function reloadCode()
{
	var Pnk = document.getElementById("loginCode");
	Pnk.src = "authcode.php?tempstr=" + Math.random();
}

             function LoginVal() {
                 if ($.trim($("#TxtUserNumb").val()).length == 0) {
                     mbox("请输入登录账号!");
                     return false;
                 }
                 if ($.trim($("#TxtUserPwd").val()).length == 0) {
                     mbox("请输入密码!");
                     return false;
                 }
                 if ($.trim($("#TxtValCode").val()).length == 0) {
                     mbox("请输入验证码!");
                     return false;
                 }
                 return true;
             }
     </script>
{/literal}
</body>
</html>
