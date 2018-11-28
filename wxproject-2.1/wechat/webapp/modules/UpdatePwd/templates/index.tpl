<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>微优品店铺管理系统-移动版</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;">
<link href="/phone/modpub/css/css.css" type="text/css" rel="stylesheet">
<link href="/phone/modpub/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="/phone/modpub/js/jquery.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/dialog.js" type="text/javascript"></script> 
{literal}
<script type="text/javascript">
           
           function SaveVal(f) {
		   
		   
			if($.trim($("#oldpwd").val()).length == 0){
				mbox("请输入旧密码！");
				f.oldpwd.focus();
				return false;
			  }
			  if(!/.{6,}/.test(f.pwd1.value)){
				mbox("新密码长度至少为6位！");
				f.pwd1.focus();
				return false;
			  }
			 
			  if(f.pwd1.value != f.pwd2.value){
				mbox("两次输入密码不同，请重新输入！");
				f.pwd1.focus();
				return false;
			  }
			  return true;
  
              
           }
    </script>
{/literal}	
</head>
<body>
<form name="f" action="index.php?module=UpdatePwd" method='post' onsubmit="return SaveVal(this);">

  
  <div>
    <div class="manage_tit">
    <a id="ContentPlaceHolder1_LbtnExit" class="exit" href="index.php">[安全退出]</a>
    <a href="javascript:history.go(-1)" class="return"></a> <span class="linel"></span> <strong>密码修改</strong> </div>
    <div class="content">
      <div class="paw_change">
        <ul>
          <li>
            <p>原密码：</p>
            <p>
              <input  name="oldpwd" id="oldpwd" type='password' maxlength="20" id="TxtPwd1" class="paw_inp" placeholder="必填项:请输入原密码">
            </p>
          </li>
          <li>
            <p>新密码：</p>
            <p>
              <input name="pwd1" type='password' maxlength="20" id="TxtNewPwd1" class="paw_inp" placeholder="必填项:请输入新密码">
            </p>
          </li>
          <li>
            <p>确认新密码：</p>
            <p>
              <input name="pwd2" type='password' maxlength="20" id="TxtConfirmNewPwd1" class="paw_inp" placeholder="必填项:请再次输入新密码">
            </p>
          </li>
        </ul>
      </div>
	  
	  <div class="paw_icon">
		 <input type="submit" value=""  class="sub">
		  
      </div>
	  
    </div>
  </div>
  <div class="menu_footer">
    <ul>
      <li class="wid20"><a href="index.php?module=index" class="xxgl">首页</a></li>
      <li class="wid20"><a href="index.php?module=tuijian" class="cwgl">网络部门</a></li>
      <li class="wid20"><a href="index.php?module=swzx" class="hygl">商务中心</a></li>
      <li class="wid20"><a href="index.php?module=cwzx" class="dzhb">财务中心</a></li>
      <li class="bac_no wid20"><a href="index.php?module=grzx" class="xtgl">个人中心</a></li>
    </ul>
  </div>

</form>
</body>
</html>
