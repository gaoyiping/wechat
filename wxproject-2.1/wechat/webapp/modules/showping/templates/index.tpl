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
		   
		   if($.trim($("#pid").val()).length == 0){
				mbox('推荐账号有误或未填×');
				return false;
			  }
			  
			  if(!/^[1-9a-zA-Z][0-9a-zA-Z]{7,7}$/.test(f.uid.value)){
				mbox('开通的店铺账号有误或未填，格式有误');
				return false;
			  }
		  
			 var reg = /^[\u4e00-\u9fa5]{2,100}$/i; 
			 if (!reg.test(f.username.value)) 
			 {
				mbox('店铺名称至少2个中文字符!');
				return false;
			 }
			 
			 var reg = /^[\u4e00-\u9fa5]{2,100}$/i; 
			 if (!reg.test(f.email.value)) 
			 {
				mbox('联系人姓名至少2个中文字符!');
				return false;
			 }
			 
			 
			 if($.trim($("#mobile").val()).length == 0){
				mbox('联系电话未填×');
				return false;
			  }
			  
			  if(!/.{6,}/.test(f.pwd1.value)){
				mbox("新密码长度至少为6位！");
				return false;
			  }
			 
			  if(f.pwd1.value != f.pwd2.value){
				mbox("两次输入密码不同，请重新输入！");
				return false;
			  }
			 
			 
	 
			  return true;
  
              
           }
    </script>
{/literal}	
</head>
<body>
<form name="f"  method='post' onsubmit="return SaveVal(this);">

  
  <div>
    <div class="manage_tit">
    <a id="ContentPlaceHolder1_LbtnExit" class="exit" href="index.php">[安全退出]</a>
    <a href="javascript:history.go(-1)" class="return"></a> <span class="linel"></span> <strong>注册会员</strong> </div>
    <div class="content">
      <div class="paw_change">
        <ul>
		  <li>
            <p>推荐店铺编号：</p>
            <p>
              <input name="pid" id="pid" type="text" maxlength="30"  class="paw_inp" placeholder="必填项">
            </p>
          </li>
		  
          <li>
            <p>店铺编码(8位字母组成)：</p>
            <p>
              <input name="uid" id="uid" type="text" maxlength="8"  class="paw_inp" placeholder="必填项">
            </p>
          </li>
          <li>
            <p>店铺名称：</p>
            <p>
			  <input name="username" id="username" type="text" maxlength="30"  class="paw_inp" placeholder="必填项">
            </p>
          </li>
          <li>
            <p>联系人姓名：</p>
            <p>
              <input name="email" id="email" type="text" maxlength="20"  class="paw_inp" placeholder="必填项">
            </p>
          </li>
		  
		  <li>
            <p>联系电话：</p>
            <p>
              <input name="mobile" id="mobile" type="text" maxlength="20" class="paw_inp" placeholder="必填项">
            </p>
          </li>
		  
		  <li>
            <p>身份证号：</p>
            <p>
              <input name="idno" id="idno" type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>银行开户名：</p>
            <p>
              <input name="cardname"  type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>银行帐号：</p>
            <p>
              <input name="cardnumber"  type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>开户银行：</p>
            <p>
              <input name="cardtype"  type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>开户行所在省市：</p>
            <p>
              <input name="provcity"  type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>物流送货地址：</p>
            <p>
              <input name="address"  type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>登陆密码(默认6个0)：</p>
            <p>
              <input name="pwd1" value="000000"  type="password"  class="paw_inp">
            </p>
          </li>
		  
		  
		  <li>
            <p>请再次输入：</p>
            <p>
              <input name="repwd1" value="000000" type="password"  class="paw_inp">
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
