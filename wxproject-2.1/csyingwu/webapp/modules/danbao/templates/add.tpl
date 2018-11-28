<html>
<head>
<title>添加零售商品</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
</head>
{literal}
<script type="text/javascript">
var pid_error = "请输入推荐账号！";
var pid_pass_error  = "请输入店铺一级密码！";
var uid_error = "请输入正确格式的店铺账号！";
var idno_error = "请输入身份证号码！";

function checkuid(u){
  var url = "index.php?module=danbao&action=checkUser&type=uid&uid=" + u;
  if(!/^[1-9a-z][0-9a-z]{6,12}$/.test(u)){

    document.getElementById('uid_error').innerHTML = uid_error;
  } else {
    ajax(url,function(text){
      document.getElementById('uid_error').innerHTML = text;
    });
  }  
}

function checkuid1(u){
  var url = "index.php?module=danbao&action=checkUser&type=pid&uid=" + u;
  if(u==""){

    document.getElementById('pid_error').innerHTML = "请输入归属店铺账号!";
  } else {
    ajax(url,function(text){
      document.getElementById('pid_error').innerHTML = text;
    });
  }  
}

function check(f){	

  if(Trim(f.pid.value) == ''){
    alert("请输入归属店铺账号！");
    return false;
  }
  if(!/^[1-9a-z][0-9a-z]{6,12}$/.test(f.uid.value))
  {

    alert("请输入正确格式的店铺账号！");
    return false;;
  } 
    if(Trim(f.uid.value) == ''){
    alert("请输入店铺账号！");
    return false;
  }
  if(Trim(f.pwd1.value) == ''){
    alert("请输入账号登陆密码！");
    return false;
  }
  if(Trim(f.repwd1.value) == ''){
    alert("请输入确认登陆密码！");
    return false;
  }


  if(Trim(f.bname.value)==""){
    alert("姓名不能为空！");
    f.bname.value = '';
    return false;
  }



  if(Trim(f.dsNo.value)==""){
    alert("身份证号不能为空！");
    f.dsNo.value = '';
    return false;
  }







  if(Trim(f.bshouji.value)==""){
    alert("联系电话不能为空！");
    f.bshouji.value = '';
    return false;
  }

  if(Trim(f.btel.value)==""){
    alert("手机号不能为空！");
    f.btel.value = '';
    return false;
  }
 
    if(Trim(f.byhsNo.value)==""){
    alert("银行帐号不能为空！");
    f.byhsNo.value = '';
    return false;
  }

    if(Trim(f.byhname.value)==""){
    alert("开户名不能为空！");
    f.byhname.value = '';
    return false;
  }


  return true;
}

  function AlertMessageBox(file_name)
    {

	        if (file_name!=undefined){
	            var ShValues = file_name.split('||');
	            if (ShValues[1]!=0)
	            {
	                document.getElementById("groupname").value=ShValues[0];
	                document.getElementById("groupID").value=ShValues[1];
			document.getElementById("ygroupID").value=ShValues[2];
			document.getElementById("sgroupID").value=ShValues[3];
                         document.getElementById('divname').innerHTML = "";
	
	            }            
	        }
	         
    }
      function ShowDepartID()
        {
            showPopWin('选择所在地区','index.php?module=seleclgroup', 240, 320, AlertMessageBox,true,true)
        }

	
</script>
{/literal}
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />

<body scroll="yes">
<div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        <script>
                                     
                        </script>

                        <div style="margin-top: -1px; height: 30px;  overflow: hidden" id="ctl00_Div_right_top"
                            class="YFTmainright_r1_c2_gj">
                            <div style="position: relative; line-height: 30px; width: 100%">
                                &nbsp;<span class="Font_red Font_addbold">[会员管理]</span> >> 店铺管理 >> 添加新店铺
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br /><br/>

<form action="index.php?module=danbao&action=add" method="post" name="form1" onsubmit="return check(this);" enctype="multipart/form-data">
  <table align="center"  border="0" cellpadding="0" cellspacing="0" width="90%">
  <tr><td>
  
      <td align="left">
      <table cellspacing="1" cellpadding="1" width="100%">
       <tr class="tdTitle" > 
      <td height="25" align="center" colspan=2> 
        <font color="#ffffff" > 添加新店铺 </font></td>
    </tr>
      <tr>
    <td class="table_body">归属店铺账号：</td>
    <td class="table_none"><input name='pid' class='button1' type='text' 
        maxlength='12' onblur="checkuid1(this.value);" value="{$pid}" style="width:90px;"><font color='red' id='pid_error'></font></td>

   
     </tr>
   
  <tr>
    <td class="table_body">店铺账号：</td>
    <td class="table_none"><input name='uid' class='button1' type='text' 
        maxlength='12' onblur="checkuid(this.value);" value="{$uid}" style="width:90px;">
    
<font color='red' id='uid_error'></font></td>

   
     </tr>
    <tr>
    <td class="table_body">登陆密码：</td>
    <td class="table_none"><input name='pwd1' type="password" style="width:90px;" class="button1" >
      <font color="red">*</font>
      <span id='span_pwd1'></span></td>
   </tr>
  <tr>
    <td class="table_body">请再次输入：</td>
    <td class="table_none"><input name='repwd1' style="width:90px;" type="password" class="button1" >
      <font color="red">*</font>
      <span id='span_repwd1'></span></td>
  </tr>
         <tr><td  class="table_body">店主姓名：</td> <td class="table_none">
	
           <input class="button1"  name="bname" type="text" style="width:140px;" value="{$bname}"/> </td>
	</tr>

	   <tr><td  class="table_body">店铺类型：</td> <td class="table_none">
	
           <select name="btype" >
 <option  value="1" selected>
会员店(10000)
 </option>
 
 <option  value="2">
 加盟店(10000)
 </option>
  <option  value="3">
 形象店(30000)
 </option>
  
 
 </select>
  </td></tr>
	 <tr>  <td  class="table_body">身份证号：</td> <td class="table_none">
	
           <input class="button1"  name="dsNo" type="text" style="width:140px;ime-mode:disabled" value="{$dsNo}"/></td>
	</tr>
	 <tr><td  class="table_body" >所在地区：</td> <td class="table_none" >
	    <input name='groupname' type="text" class="button1"  readonly style="width:140px;" value="">
	    <input name='groupID' style="display:none;"  type="text" class="button1" ><input name='ygroupID' type="text" style="display:none;"  class="button1" >
	    <input name='sgroupID' type="text"  class="button1"  style="display:none;" ><button onclick="ShowDepartID();">选择</button>

    <div id="divname"></div>
   </td>
	</tr>
	
	  <tr><td  class="table_body">联系电话：</td> <td class="table_none">
	
           <input class="button1"  name="btel" type="text" style="width:140px;ime-mode:disabled" value="{$btel}"/> </td></tr>
	 <tr> 
	<td  class="table_body">物流送货地址：</td> <td class="table_none">
	
          <input class="button1"  name="bdizhi" type="text" style="width:180px;" value="{$bdizhi}"/></td>
	</tr>
	

	 
		
	
		
		 
	   <tr><td  class="table_body">银行开户名：</td> <td class="table_none"> <input name="byhname" class="button1"  type="text" style="width:140px;" value="{$byhname}"/>
	    
</td></tr>
	 <tr> <td  class="table_body">开户银行：</td> <td class="table_none">
	 <select name="byinhang">
 <option selected value="农业银行">
 农业银行
 </option>
  <option  value="工商银行">
 工商银行
 </option>
  <option  value="建设银行">
 建设银行
 </option>
 </select>
          </td>
	</tr>
	  <tr><td  class="table_body">银行帐号：</td> <td class="table_none">
	
           <input class="button1"  name="byhsNo" type="text" style="width:140px;ime-mode:disabled" value="{$byhsNo}"/> </td></tr>
	 <tr> 
	   <td  class="table_body">开户银行所在地区：</td> <td class="table_none">
	
           <input class="button1"  name="byinhangdiqu" type="text" style="width:200px;" value="{$byhsNo}"/> </td>
	</tr>

	   
        <tr><td class="table_body">详细备注：</td> <td class="table_none">
	 <textarea name="bbeizhu"  class="button1"  style="height:50px;width:99%;"  >{$bbeizhu}</textarea>
      </td>
	</tr>
	</table>
        <p align="center"> 
          <input type="submit" value="提 交" class="b02">
          &nbsp;&nbsp;&nbsp; 
        
          <input type="button" value="返 回" class="b02" onclick="location.href='index.php?module=danbao';">
        </p> <br />&nbsp;
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

