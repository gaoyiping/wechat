<html>
<head>
<title>修改零售商品</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>

{literal}
<script type="text/javascript">
function check(f){	
  if(Trim(f.bname.value)==""){
    alert("担保人不能为空！");
    f.bname.value = '';
    return false;
  }
  if(Trim(f.bsNo.value)==""){
    alert("身份证号不能为空！");
    f.bsNo.value = '';
    return false;
  }
  f.bsNo.value = Trim(f.bsNo.value);
  if(!/^(([1-9][0-9]*)|0)(\.[0-9]{1,2})?$/.test(f.bsNo.value)){
    alert("身份证号必须为数字，且格式为 ####.## ！");
    f.bsNo.value = '';
    return false;
  }


  if(Trim(f.btel.value)==""){
    alert("担保人联系电话不能为空！");
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
</script>
{/literal}
<link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />
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
                                   &nbsp;<span class="Font_red Font_addbold">[茶馆管理]</span> >> 担保人管理 >> 修改担保人信息
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br /><br/>


<form action="index.php?module=danbao&action=edit" method="post" onsubmit="return check(this);"  enctype="multipart/form-data">
<input type="hidden" name="id" value="{$id}" />
<input type="hidden" name="editable" value="true" />
   <table align="center"  border="0" cellpadding="0" cellspacing="0" width="90%">
  <tr><td>
  
      <td align="left">
      <table cellspacing="1" cellpadding="1" width="100%">
       <tr class="tdTitle" > 
      <td height="25" align="center" colspan=2> 
        <font color="#ffffff" > 修改担保人信息 </font></td>
    </tr>
      
  <tr><td  class="table_body">担保人：</td> <td class="table_none">
	
           <input name="bname" type="text" style="width:140px;" value="{$bname}"/> </td>
	</tr>
	   <tr><td  class="table_body">身份证号：</td> <td class="table_none">
	
           <input name="bsNo" type="text" style="width:140px;ime-mode:disabled" value="{$bsNo}"/></td>
	</tr>
	  <tr><td  class="table_body">联系电话：</td> <td class="table_none">
	
           <input name="btel" type="text" style="width:140px;ime-mode:disabled" value="{$btel}"/> </td>
	</tr>
	   <tr><td  class="table_body">身份：</td> <td class="table_none">
	    
 <select name="btype">
 <option {if $btype==0}selected{/if} value="0">
 茶馆
 </option>
  <option  {if $btype==1}selected{/if}  value="1">
 公务员
 </option>
   <option  {if $btype==2}selected{/if}  value="2">
 特殊人群
 </option>
 </select></td>
	</tr>
	  <tr><td  class="table_body">开户银行：</td> <td class="table_none">
	 <select name="byinhang">
 <option {if $byinhang=="农业银行"}selected{/if}  value="农业银行">
 农业银行
 </option>
  <option {if $byinhang=="工商银行"}selected{/if}   value="工商银行">
 工商银行
 </option>
 </select>
          </td>
	</tr>
	  <tr><td  class="table_body">银行帐号：</td> <td class="table_none">
	
           <input name="byhsNo" type="text" style="width:140px;ime-mode:disabled" value="{$byhsNo}"/> </td>
	</tr>
	   <tr><td  class="table_body">开户名：</td> <td class="table_none"> <input name="byhname" type="text" style="width:140px;" value="{$byhname}"/>
	    
</td>
	</tr>
	   
        <tr><td class="table_body">备注：</td> <td class="table_none">
	 <textarea name="bbeizhu" cols="50" rows="6" >{$bbeizhu}</textarea>
      </td>
	</tr>
	</table>
        <p align="center"> 
          <input type="submit" value="提 交" class="b02">
          &nbsp;&nbsp;&nbsp; 
        
          <input type="button" value="返 回" class="b02" onclick="location.href='index.php?module=danbao';">
        </p>
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
