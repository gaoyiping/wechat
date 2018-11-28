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
<link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<script type="text/javascript" src="modpub/js/check.js"> </script>
    <script type="text/javascript" src="modpub/js/ajax.js"> </script>
    <script type="text/javascript" src="/new_style/css/common.js"></script>
    <script type="text/javascript" src="/new_style/css/GridViewText.js"></script>
    <script type="text/javascript" src="/new_style/css/HashTable.js"></script>
    <script type="text/javascript" src="/new_style/css/ShowColumn.js"></script>
    <script type="text/javascript" src="/new_style/css/Popup.js"></script>
{literal}<script type="text/javascript">

var pid_error = "推荐账号有误或未填×";
var aid_error = "安置账号有误或未填×";
var pid_pass_error  = "请输入推荐账号的一级密码!";
var uid_error = "开通的会员账号有误或未填，格式有误";
var idno_error = "请输入身份证号码!";
function checkpid(u){
  var url = "index.php?module=RegMember&action=checkUser&type=opid&uid=" + u;
  if(Trim(u) == ''){
    document.getElementById('pid_error').innerHTML = pid_error;
    document.getElementById('ppid').value="0";
  } else {
    ajax(url,function(text){
          var strs= new Array(); 
       strs=text.split("|"); 
     if(strs[0]=="2")
       {
            document.getElementById('pid_error').innerHTML =pid_error;
	    document.getElementById('ppid').value="0";
       } 
       else if(strs[0]=="1")
       {
        document.getElementById('pid_error').innerHTML ="推荐账号可以使用 √";
	  document.getElementById('ppid').value="1";
         
       }
       else
       {
         
       }
    });
  }
   
}
function checkaid(u){
  var url = "index.php?module=RegMember&action=checkUser&type=aid&uid=" + u;
   document.getElementById("squyu").value="0";
   document.getElementById("squyu1").value="0";
  if(Trim(u) == ''){
    document.getElementById('aid_error').innerHTML = aid_error;
     document.getElementById('aaid').value="0";
  } else {
    ajax(url,function(text){
       var strs= new Array(); 
       strs=text.split("|"); 
       if(strs[0]=="1")
       {
          document.getElementById('aid_error').innerHTML ="安置账号不存在 ×";
	  document.getElementById('aaid').value="0";
       }
       else if(strs[0]=="5")
       {
         document.getElementById('aid_error').innerHTML = "安置账号左中右区已注册 ×";
	   document.getElementById('aaid').value="0";
       }
        else if(strs[0]=="2")
       {
         document.getElementById('aid_error').innerHTML = "可安置在左区 √";

	     document.getElementById("squyu").value="1";
	     document.getElementById("squyu1").value="1";
	       document.getElementById('aaid').value="1";
       }
        else if(strs[0]=="3")
       {
         document.getElementById('aid_error').innerHTML = "可安置在中区 √";
	 document.getElementById("squyu").value="2";
	 document.getElementById("squyu1").value="2";
	  document.getElementById('aaid').value="1";
       }
        else if(strs[0]=="4")
       {
         document.getElementById('aid_error').innerHTML = "可安置在右区 √";
	 document.getElementById("squyu").value="3";
	 document.getElementById("squyu1").value="3";
	  document.getElementById('aaid').value="1";
       }
       else{}
    });
  }
 
}

function checkuid(u){
  var url = "index.php?module=RegMember&action=checkUser&type=ouid&uid=" + u;
  if(!/^[1-9a-zA-Z][0-9a-zA-Z]{7,7}$/.test(u)){
    document.getElementById('uid_error').innerHTML = uid_error;
     document.getElementById('uuid').value="0";
  } else {
    ajax(url,function(text){
        var strs= new Array(); 
       strs=text.split("|"); 
     if(strs[0]=="2")
       {
            document.getElementById('uid_error').innerHTML ="会员账号可以使用 √";
	    document.getElementById('uuid').value="1";
       } 
       else if(strs[0]=="1")
       {
        document.getElementById('uid_error').innerHTML ="会员账号已经存在 ×";
	  document.getElementById('uuid').value="0";
         
       }
       else
       {
         
       }
   
    });
  }  

}
function check(f){
	  if(Trim(f.pid.value) == ''){
	    alert(pid_error);
	    return false;
	  }
	  
	  if(!/^[1-9a-zA-Z][0-9a-zA-Z]{7,7}$/.test(f.uid.value)){
	    alert(uid_error);
	    return false;
	  }
  
	 var reg = /^[\u4e00-\u9fa5]{2,100}$/i; 
	 if (!reg.test(f.username.value)) 
	 {
	 	alert('店铺名称至少2个中文字符!');
    	return false;
	 }
	 
	 var reg = /^[\u4e00-\u9fa5]{2,100}$/i; 
	 if (!reg.test(f.email.value)) 
	 {
	 	alert('联系人姓名至少2个中文字符!');
    	return false;
	 }
	 
	 
	 if(!IdCardValidate(f.idno.value)){
	 	alert('请输入正确的身份证号码!');
    	return false;
	 }

     var money=parseInt(document.getElementById("ctl00_ContentPlaceHolder1_lbtotalmoney").innerHTML);

	var ppid=  document.getElementById('ppid').value;
	var uuid=  document.getElementById('uuid').value;
    
	if(ppid!="1")
	{
	   alert("推荐账号异常!");
       return false;
	}
	
	

	if(uuid!="1")
	{
	   alert("会员账号异常!");
       return false;
	}
        
	if((money)>parseInt(f.spemoney.value))
	{
	   alert("您的电子币不足!");
       return false;
	}

	var boo= confirm("系统将扣除您 ￥"+money+"电子币 ,开通的会员为"+f.uid.value+", 确定支付吗？");
    return boo;
 
}


  function Init()
  {
  
    var   dropElement1=document.getElementById("Select1"); 
    var   dropElement2=document.getElementById("Select2"); 
    var   dropElement3=document.getElementById("Select3");   
    RemoveDropDownList(dropElement1);
    RemoveDropDownList(dropElement2);
    RemoveDropDownList(dropElement3);

      var country;
        var province;
        var city;
     var url = "index.php?module=showping&action=ajax&GroupID=0";
     ajax(url,function(text){
        var strs= new Array(); 
        strs=text.split("|"); 
        for(var i=0; i<strs.length-1;   i++)
        {
	     var opp= new Array(); 
             opp=String(strs[i]).split(","); 

	
              var   eOption=document.createElement("option");   
              eOption.value=opp[1];
              eOption.text=opp[0];
              dropElement1.add(eOption);
	       
        }
   
    });
    
  }   
   
  function   selectCity()   
  {       
          var   dropElement1=document.getElementById("Select1"); 
          var   dropElement2=document.getElementById("Select2"); 
	  var   dropElement3=document.getElementById("Select3"); 
          var   name=dropElement1.value;
          
	  RemoveDropDownList(dropElement2);
          RemoveDropDownList(dropElement3);

	  if(name!="")
	  {
	 
           var url = "index.php?module=showping&action=ajax&GroupID="+name;

			ajax(url,function(text){
			var strs= new Array(); 
			strs=text.split("|"); 
			for(var i=0; i<strs.length-1;   i++)
			{
			     var opp= new Array(); 
			     opp=String(strs[i]).split(","); 

			
			      var   eOption=document.createElement("option");   
			      eOption.value=opp[1];
			      eOption.text=opp[0];
			      dropElement2.add(eOption);
			       
			}
		   
		    });
            }
  } 
  
  function   selectCountry()   
  {   
     
          var   dropElement1=document.getElementById("Select1"); 
          var   dropElement2=document.getElementById("Select2"); 
	  var   dropElement3=document.getElementById("Select3"); 
          var   name=dropElement2.value;
          
	
          RemoveDropDownList(dropElement3);

	  if(name!="")
	  {
	 
           var url = "index.php?module=showping&action=ajax&GroupID="+name;

			ajax(url,function(text){
			var strs= new Array(); 
			strs=text.split("|"); 
			for(var i=0; i<strs.length-1;   i++)
			{
			     var opp= new Array(); 
			     opp=String(strs[i]).split(","); 

			
			      var   eOption=document.createElement("option");   
			      eOption.value=opp[1];
			      eOption.text=opp[0];
			      dropElement3.add(eOption);
			       
			}
		   
		    });
            }
  }

  function   RemoveDropDownList(obj)   
  {   
      if(obj)
      {
          var   len=obj.options.length;   
          if(len>0)
          {
            //alert(len);   
            for(var   i=len;i>=1;i--)   
            {   
                  obj.remove(i);   
            }
          }
       }
            
  }  
    </script>{/literal}
</head>
<body>
<form method="post" action="" id="form1">
  
  <div>
    <div class="manage_tit">
    <a id="ContentPlaceHolder1_LbtnExit" class="exit" href="index.php">[安全退出]</a>
    <a href="javascript:history.go(-1)" class="return"></a> <span class="linel"></span> <strong>注册消费</strong> </div>
    <div class="content">
      <div class="mem_zshycx">
        
        <table style="width: 100%" id="tb_product">
            <tbody>
                                                                <tr class="YFTProductListBg">
                                                                    <td>
                                                                        <div style="margin-top: 5px; display: inline; float: left" class="YFTProductListImg ML5">
                                                                            &nbsp;</div>
                                                                        <div style="display: inline; float: left" class="YFTProductListFont ">
                                                                            &nbsp;产品列表</div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 160px;">
                                                                        <div style="width: 100%" id="ctl00_ContentPlaceHolder1_ProductList1_palShowProduct">
                                                                            {$strMenu}
                                                                        </div>
                                                                        <div style="z-index: 100; position: absolute; background-color: #000000; display: none;
                                                                            color: #ffffff" id="PopupDiv">
                                                                        </div>
                                                                        
                                </div>
                    </td>
                </tr>
            </tbody>
        </table>
        
        
        <!-------------------->
        
        <table width="100%" cellspacing="1" cellpadding="1">
	        
                <tr>
                    <td class="table_body">
                        推荐店铺编号：</td>
                    <td class="table_none">
                        <input name='pid' class='button1' type='text' maxlength='12' onblur="checkpid(this.value);"
                            value="{$pid}">   <input name='ppid' id='ppid' class='button1' type='text'   value="{$ppid}" style="display:none;">
                        <font color='red'>*</font> <font color='red' id="pid_error"></font>
                    </td>
                </tr>
                
                <tr>
                    <td class="table_body">
                        要开通的店铺编号：</td>
                    <td class="table_none">
                        <input name='uid' class='button1' type='text' maxlength='8' onblur="checkuid(this.value);"
                            value="{$uid}">
			    <input name='uuid' id="uuid" class='button1' type='text'   value="{$uuid}" style="display:none;">
                        <font color='red'>*8位字母组成</font> <font color='red' id='uid_error'></font>
                    </td>
                </tr>
                <tr>
                    <td class="table_body">
                        店铺名称：</td>
                    <td class="table_none">
                        <input name='username' class='button1' type='text' value="产品体验馆">
                        <font color="red">*</font> <span id='span_username'></span>
                    </td>
                </tr>
                <tr>
                    <td class="table_body">
                        联系人姓名：</td>
                    <td class="table_none">
                        <input name='email' type="text" class="button1" value="{$email}">
                        <font color="red">*</font> <span id='span_email'></span>
                    </td>
                </tr>
             	<tr>
                    <td class="table_body">
                        联系电话：</td>
                    <td class="table_none">
                        <input name='mobile' type="text" class="button1" value="">
                        <font color="red">*</font> <span id='span_mobile'></span>
                    </td>
                </tr>
                
                <tr>
                    <td class="table_body">
                        身份证号：</td>
                    <td class="table_none">
                        <input name='idno' maxlength='19' class='button1' type='text' value="">
                        <font color="red">*</font> <font color='red'></font>
                    </td>
                </tr>
		      <tr>
                    <td class="table_body">
                        所在地区：</td>
                    <td class="table_none">
                          <select id="Select1" name="Select1" runat="server" onchange="selectCity();">
		 <option value="" selected="true">省/直辖市</option>
	</select>
    <select id="Select2" name="Select2" runat="server" onchange="selectCountry()">
		<option value="" selected="true">请选择</option>
	</select>
    <select id="Select3" name="Select3" runat="server" >
		<option value="" selected="true">请选择</option>
	</select>
                        <font color="red">*</font> <font color='red'></font>
                    </td>
                </tr>

		
                <tr>
                    <td class="table_body">
                        详细街道地址：</td>
                    <td class="table_none">
                        <textarea name='address' cols="35" rows="4" class="button1">{$address}</textarea></td>
                </tr>
                <tr>
                    <td class="table_body">
                        银行开户名：</td>
                    <td class="table_none">
                        <input name='cardname' type="text" class="button1" value="{$cardname}"></td>
                </tr>
                <tr>
                    <td class="table_body">
                        银行帐号：</td>
                    <td class="table_none">
                        <input name='cardnumber' type="text" class="button1" value="{$cardnumber}">
                        <span id='span_cardnumber'></span>
                    </td>
                </tr>
                <tr>
                    <td class="table_body">
                        开户银行：</td>
                    <td class="table_none">
                        <input name='cardtype' type="text" class="button1" value="{$cardtype}"></td>
                </tr>
                <tr>
                    <td class="table_body">
                        开户行所在省市：</td>
                    <td class="table_none">
                        <input name='provcity' maxlength='10' type="text" class="button1" value="{$provcity}"></td>
                </tr>
                <tr style="display: none;">
                    <td class="table_body">
                        座 机：</td>
                    <td class="table_none">
                        <input name='tel' type="text" class="button1" value="{$tel}">
                        <span id='span_tel'></span>
                    </td>
                </tr>
                
                <tr>
                    <td class="table_body">
                        登陆密码：</td>
                    <td class="table_none">
                        <input name='pwd1' type="password" class="button1" value="000000">
                        <font color="red">*</font> <span id='span_pwd1'>默认为000000</span></td>
                </tr>
                <tr>
                    <td class="table_body">
                        请再次输入：</td>
                    <td class="table_none">
                        <input name='repwd1' type="password" class="button1" value="000000">
                        <font color="red">*</font> <span id='span_repwd1'></span>
                    </td>
                </tr>
                <tr style="display: none;">
                    <td class="table_body">
                        二级密码：</td>
                    <td class="table_none">
                        <input name='pwd2' type="password" class="button1" value="000000">
                        <font color="red">*</font> <span id='span_pwd2'>默认为6个0</span></td>
                </tr>
                <tr style="display: none;">
                    <td class="table_body">
                        请再次输入：</td>
                    <td class="table_none">
                        <input name='repwd2' type="password" class="button1" value="000000">
                        <font color="red">*</font> <span id='span_repwd2'></span>
                    </td>
                </tr>
            </table>
            
            
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
