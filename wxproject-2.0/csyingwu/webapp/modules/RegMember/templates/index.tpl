<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="modpub/css/base.css"/>
        <link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<script type="text/javascript" src="modpub/js/check.js"> </script>
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<script type="text/javascript" src="modpub/js/userinfo_check.js"> </script>


{literal}
<script type="text/javascript">
var pid_error = "请输入推荐账号!";
var aid_error = "请输入安置账号!";
var pid_pass_error  = "请输入推荐账号的一级密码!";
var uid_error = "请输入正确格式的会员账号3-8位!";
var idno_error = "请输入身份证号码!";
function checkpid(u){
  var url = "index.php?module=RegMember&action=checkUser&type=pid&uid=" + u;
  if(Trim(u) == ''){
    document.getElementById('pid_error').innerHTML = pid_error;
  } else {
    ajax(url,function(text){
      document.getElementById('pid_error').innerHTML = text;
    });
  }
}
function checkaid(u){
  var url = "index.php?module=RegMember&action=checkUser&type=aid&uid=" + u;
   document.getElementById("squyu").value="0";
   document.getElementById("squyu1").value="0";
  if(Trim(u) == ''){
    document.getElementById('aid_error').innerHTML = aid_error;
  } else {
    ajax(url,function(text){
       var strs= new Array(); 
       strs=text.split("|"); 
       if(strs[0]=="1")
       {
          document.getElementById('aid_error').innerHTML ="安置账号不存在 ×";
       }
       else if(strs[0]=="2")
       {
         document.getElementById('aid_error').innerHTML = "安置账号左右区已注册 ×";
       }
        else if(strs[0]=="3")
       {
         document.getElementById('aid_error').innerHTML = "可安置在左区 √";

	   document.getElementById("squyu").value="1";
	     document.getElementById("squyu1").value="1";

	   


       }
        else if(strs[0]=="4")
       {
         document.getElementById('aid_error').innerHTML = "可安置在右区 √";
	document.getElementById("squyu").value="2";
	document.getElementById("squyu1").value="2";
       }
       else
       {
        
       }
    });
  }
}

function checkdaili(u){
  var url = "index.php?module=RegMember&action=checkdianpu&uid=" + u;
  if(u==""){
       document.getElementById('daili_error').innerHTML="如果不填写 默认归到公司店铺";
  } else {
    ajax(url,function(text){
      document.getElementById('daili_error').innerHTML = text;
    });
  }  
}


function checkuid(u){
  var url = "index.php?module=RegMember&action=checkUser&type=uid&uid=" + u;
  if(u==""){
    document.getElementById('uid_error').innerHTML = uid_error;
  } else {
    ajax(url,function(text){
      document.getElementById('uid_error').innerHTML = text;
    });
  }  
}
function check(f){
  if(Trim(f.pid.value) == ''){
    alert(pid_error);
    return false;
  }
  if(Trim(f.aid.value) == ''){
    alert(aid_error);
    return false;
  }

  if(Trim(f.squyu1.value) == '0'){
    alert("没有选择安置区域!");
    return false;
  }

  if(Trim(f.uid.value)==''){
    alert(uid_error);
    return false;
  }
      if(Trim(f.idno.value)==''){
    alert(idno_error);
    return false;
  }
      if(Trim(f.mobile.value)==''){
    alert("联系电话必须填写！");
    return false;
  }
  
  if(bind_check(f)){
    var is = f.getElementsByTagName('INPUT');
    for(var i=0;i<is.length;i++){
      if(is[i].type == 'submit'){ is[i].disabled = true; break;}
    }
    return true;
  } else {
    return false;
  }
}
</script>
{/literal}
</head>
<body >

   <div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        <div style="margin-top: -1px; height: 30px;  overflow: hidden" id="ctl00_Div_right_top"
                            class="YFTmainright_r1_c2_gj">
                            <div style="position: relative; line-height: 30px; width: 100%">
                                &nbsp;<span class="Font_red Font_addbold">[会员办公平台]</span> >> 会员注册 
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br/>




<form name="form1" action="index.php?module=RegMember" method="post"
  onsubmit="return check(this);">
<input type='hidden' name="cID" value="{$cID}" />
  
<table cellspacing="1" cellpadding="1" width="80%" align="center">
 <tr class="tdTitle" > 
      <td height="25" align="center" colspan=3> 
        <font color="#ffffff" > 会员注册(带*号为必填项,请认真核对推荐账号及安置账号信息,一旦注册无法修改)
 </font></td>
    </tr>
  <tr>
    <td colspan='2' align="center"><font color='red'>{$error}</font></td>
  </tr>
  <tr>
    <td class="table_body">推荐账号：</td>
    <td class="table_none"><input name='pid' class='button1' type='text' 
        maxlength='8' onblur="checkpid(this.value);" value="{$pid}">
      <font color='red'>*</font>
      <font color='red' id="pid_error"></font></td>
  </tr>
  <tr>
    <td class="table_body">安置账号：</td>
    <td class="table_none"><input name='aid' class='button1' type='text' 
        maxlength='8' onblur="checkaid(this.value);" value="{$aid}" style='width:85px;'> 
	<select disabled name="squyu" id="squyu"><option value='0' selected>安置区</option>
	<option value='1'>左区</option>
	<option value='2'>右区</option></select><input name='squyu1'  type='text' 
         value="0" style='display:none;'>
      <font color='red'>*</font>
     <font color='red' id="aid_error"></font></td>
  </tr>
  <tr>
    <td class="table_body">要开通的会员账号：</td>
    <td class="table_none"><input name='uid' class='button1' type='text' 
        maxlength='8' onblur="checkuid(this.value);" value="{$uid}">
      <font color='red'>*</font><font color='red' id='uid_error'></font></td>
  </tr>
    <tr>
    <td class="table_body">归属店铺账号：</td>
    <td class="table_none"><input name='daili' class='button1' type='text' 
        maxlength='8' onblur="checkdaili(this.value);" value="{$daili}" style='width:85px;'> 
	 <font color='red' id='daili_error'>如果不填写 默认归到公司店铺</font></td>
  </tr>
  <tr>
    <td class="table_body">会员昵称：</td>
    <td class="table_none"><input name='username' class='button1' type='text' value="">
      <font color="red">*</font>
      <span id='span_username'> </span></td>
  </tr>
   <tr>
    <td class="table_body">会员类型：</td>
    <td class="table_none"> <label><input type="radio" name="usertype" id="usertype1" value="1" onclick="" Checked/> 普卡会员(1000)</label>
                      &nbsp;&nbsp;<label><input type="radio" name="usertype" id="usertype2" value="2" onclick="" /> 金卡会员(3000) </label></td>
  </tr>
  
  <tr>
    <td class="table_body">身份证号：</td>
    <td class="table_none"><input name='idno' maxlength='18' class='button1' type='text' value=""> <font color="red">*</font>
     <font color='red'></font></td>
  </tr>

  <tr>
    <td class="table_body">物流送货地址：</td>
    <td class="table_none"><textarea name='address' cols="35" rows="4" class="button1">{$address}</textarea></td>
  </tr>
  <tr>
    <td class="table_body">银行开户名：</td>
    <td class="table_none"><input name='cardname' type="text" class="button1" value="{$cardname}"></td>
  </tr>
  <tr>
    <td class="table_body">银行帐号：</td>
    <td class="table_none"><input name='cardnumber' type="text" class="button1" value="{$cardnumber}">
      <span id='span_cardnumber'></span></td>
  </tr>
  <tr>
    <td class="table_body">开户银行：</td>
    <td class="table_none"><input name='cardtype' type="text" class="button1" value="{$cardtype}"></td>
  </tr>
  <tr>
    <td class="table_body">开户行所在省市：</td>
    <td class="table_none"><input name='provcity' maxlength='10' type="text" class="button1" value="{$provcity}"></td>
  </tr>
  <tr style="display:none;">
    <td class="table_body">座    机：</td>
    <td class="table_none"><input name='tel' type="text" class="button1" value="{$tel}">
      <span id='span_tel'></span></td>
  </tr>
  <tr>
    <td class="table_body">联系电话：</td>
    <td class="table_none"><input name='mobile' type="text" class="button1" value="">
      <font color="red">*</font>
      <span id='span_mobile'></span></td>
  </tr>  
  <tr>
    <td class="table_body">电子邮件：</td>
    <td class="table_none"><input name='email' type="text" class="button1" value="{$email}">
      <span id='span_email'></span></td>
  </tr>
  <tr>
    <td class="table_body">一级密码：</td>
    <td class="table_none"><input name='pwd1' type="password" class="button1" value="000000">
      <font color="red">*</font>
      <span id='span_pwd1'>默认为6个0</span></td>
  </tr>
  <tr>
    <td class="table_body">请再次输入：</td>
    <td class="table_none"><input name='repwd1' type="password" class="button1" value="000000">
      <font color="red">*</font>
      <span id='span_repwd1'></span></td>
  </tr>
  <tr style="display:none;">
    <td class="table_body">二级密码：</td>
    <td class="table_none"><input name='pwd2' type="password" class="button1" value="000000">
      <font color="red">*</font>
      <span id='span_pwd2'>默认为6个0</span></td>
  </tr>
 <tr style="display:none;">
    <td class="table_body">请再次输入：</td>
    <td class="table_none"><input name='repwd2' type="password" class="button1" value="000000">
      <font color="red">*</font>
      <span id='span_repwd2'></span></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <br />
      <input class="b02"  type="submit" value=" 完成注册 "  onclick="return confirm('确定要提交吗？');" /><br />&nbsp;
    </td>
  </tr> 
</table>
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
