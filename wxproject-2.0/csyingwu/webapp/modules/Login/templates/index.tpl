<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录后台管理系统</title>
<link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/new_style/js/jquery.js"></script>
<script src="/new_style/js/cloud.js" type="text/javascript"></script>
    {literal}
    <script language="javascript">
        $(function(){
        $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
        $(window).resize(function(){
        $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
        })
    });
    </script>
    {/literal}


</head>

<body style="background-color:#1c77ac; background-image:url(../new_style/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">


<form name="form1" method="post" action="index.php?module=Login"  >
    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  


<div class="logintop">    
    <span>欢迎登录后台管理界面平台</span>    
    <ul>
    <li><a href="#">回首页</a></li>
    <li><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    </ul>    
    </div>
    
    <div class="loginbody">
    
    <span class="systemlogo"></span> 
       
    <div class="loginbox">
    
    <ul>
    <li><input name="adminid" type="text" class="loginuser" placeholder="用户名" value="" /></li>
    <li><input name="adminpass" type="password" class="loginpwd" placeholder="密码" value="" /></li>
    <li><input name="submit" type="submit" class="loginbtn" value="登录" />
</li>
    </ul>
    </div>
    
    </div>
    
    <div class="loginbm">版权所有  2010-2015  <a href="http://www.csyingwu.com">颖悟科技</a> </div>

   </form>
</body>

</html>
