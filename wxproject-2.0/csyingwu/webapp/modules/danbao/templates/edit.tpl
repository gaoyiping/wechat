<html>
<head>
<title>修改零售商品</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
{literal}
<script type="text/javascript">
function check(f){	
 if(Trim(f.bname.value)==""){
    alert("姓名不能为空！");
    f.bname.value = '';
    return false;
  }



  if(Trim(f.btel.value)==""){
    alert("联系电话不能为空！");
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
	            }            
	        }
	         
    }
      function ShowDepartID()
        {
            showPopWin('选择所在地区','index.php?module=seleclgroup', 240, 320, AlertMessageBox,true,true)
        }

function resetpwd(grade,userid){
  var f = document.form1;
  f.action = "index.php?module=danbao&action=resetpwd&bloginID="+userid;
  f.submit();
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
                                   &nbsp;<span class="Font_red Font_addbold">[店铺管理]</span> >> 店铺管理 >> 修改店铺信息
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br /><br/>


<form action="index.php?module=danbao&action=edit" name="form1" method="post" onsubmit="return check(this);"  enctype="multipart/form-data">
<input type="hidden" name="id" value="{$info->bID}" />
<input type="hidden" name="editable" value="true" />
   <table align="center"  border="0" cellpadding="0" cellspacing="0" width="90%">
  <tr><td>
  
      <td align="left">
    <table cellspacing="1" cellpadding="1" width="100%">
       <tr class="tdTitle" > 
      <td height="25" align="center" colspan=2> 
        <font color="#ffffff" > 修改店铺信息 </font></td>
    </tr>
       <tr>
    <td class="table_body">归属店铺账号：</td>
    <td class="table_none"> {$info->tuijiansNo}</td>

   
     </tr>
  <tr>
    <td class="table_body">系统账号：</td>
    <td class="table_none"> {$info->bloginID}</td>

   
     </tr>
    
         <tr><td  class="table_body">店主姓名：</td> <td class="table_none">
	
           <input class="button1"  name="bname" type="text" style="width:140px;" value="{$info->bname}"/> </td>
	</tr>

	   <tr><td  class="table_body">店铺类型：</td> <td class="table_none">
	
           <select name="btype" >
 <option  value="1" {if $info->btype==1}selected{/if}>
会员店(30000)
 </option>
 
 <option  value="2" {if $info->btype==2}selected{/if}>
 加盟店(10000)
 </option>
  <option  value="3" {if $info->btype==3}selected{/if}>
 连锁店(30000)
 </option>
  
 
 </select>
  </td></tr>
	 <tr>  <td  class="table_body">身份证号：</td> <td class="table_none">
	
           <input class="button1"  name="dsNo" type="text" style="width:140px;ime-mode:disabled" value="{$info->dsNo}"/></td>
	</tr>
	 <tr><td  class="table_body" >所在地区：</td> <td class="table_none" >
	    <input name='groupname' type="text" class="button1"  readonly style="width:140px;" value="{$diqu->shengname}{$diqu->shiname}{$diqu->xianname}">
	    <input name='groupID'  type="text" style="display:none;" class="button1" value="{$diqu->xianID}" >
	    <input name='ygroupID' type="text" style="display:none;"  class="button1" value="{$diqu->shiID}" >
	    <input name='sgroupID' type="text"  class="button1"  style="display:none;" value="{$diqu->shengID}" >
	    <button onclick="ShowDepartID();">选择</button>

    <div id="divname"></div>
   </td>
	</tr>
	
	  <tr><td  class="table_body">联系电话：</td> <td class="table_none">
	
           <input class="button1"  name="btel" type="text" style="width:140px;ime-mode:disabled" value="{$info->btel}"/> </td></tr>
	 <tr> 
	<td  class="table_body">物流送货地址：</td> <td class="table_none">
	
          <input class="button1"  name="bdizhi" type="text" style="width:180px;" value="{$info->bdizhi}"/></td>
	</tr>
	

	 
		
	
		
		 
	   <tr><td  class="table_body">银行开户名：</td> <td class="table_none"> <input name="byhname" class="button1"  type="text" style="width:140px;" value="{$info->byhname}"/>
	    
</td></tr>
	 <tr> <td  class="table_body">开户银行：</td> <td class="table_none">
	 <select name="byinhang">
 <option selected value="农业银行" {if $info->byinhang=="农业银行"}selected{/if}>
 农业银行
 </option>
  <option  value="工商银行" {if $info->byinhang=="工商银行"}selected{/if}>
 工商银行
 </option>
  <option  value="建设银行" {if $info->byinhang=="建设银行"}selected{/if}>
 建设银行
 </option>
 </select>
          </td>
	</tr>
	  <tr><td  class="table_body">银行帐号：</td> <td class="table_none">
	
           <input class="button1"  name="byhsNo" type="text" style="width:140px;ime-mode:disabled" value="{$info->byhsNo}"/> </td></tr>
	 <tr> 
	   <td  class="table_body">开户银行所在地区：</td> <td class="table_none">
	
           <input class="button1"  name="byinhangdiqu" type="text" style="width:200px;" value="{$info->byinhangdiqu}"/> </td>
	</tr>

	   
        <tr><td class="table_body">详细备注：</td> <td class="table_none">
	 <textarea name="bbeizhu"  class="button1"  style="height:50px;width:99%;"  >{$info->bbeizhu}</textarea>
      </td>
	</tr>
	</table>
        <p align="center"> 
          <input type="submit" value="提 交" class="b02">
          &nbsp;&nbsp;&nbsp; 
        
          <input type="button" value="返 回" class="b02" onclick="location.href='index.php?module=danbao';">
        </p><br />&nbsp;
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
