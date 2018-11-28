<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="modpub/css/base.css">
 <link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<script type="text/javascript" src="modpub/js/check.js"> </script>
<script type="text/javascript" src="modpub/js/userinfo_check.js"> </script>
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
{literal}
<script language="JavaScript" >
function choose(c,size){
  for(var i=0;i<size;i++){
    document.getElementById('div_'+i).style.display = 'none';
  }
  document.getElementById('div_'+c).style.display = '';
}

function check(f){
  if(isNaN(f.money.value)){
  		alert("请输入数字!");
  		return false;
  }
  return true;
}
</script> 
{/literal}
</head> 
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
                                &nbsp;<span class="">[财务中心]</span> >> 汇款信息提交
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content">
 <div class="titl_bg ">
                                                                </div><br />

<form name="form1" action="index.php?module=OfflinePay" method="post" onsubmit="return check(this)">

<table align="center" width="70%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" height="52">
  <tr class="tdTitle">
    <td height="28" align="center"> 
      <strong><font color="#FFFFFF" size="2">汇款信息提交</font></strong>
    </td>
  </tr>
  <tr> 
    <td height="56" valign="top">
      <table align="center" bgcolor="#DDDDDD" width="100%" border="0" cellpadding="5" cellspacing="1" >

        <tr bgcolor="#FFFFFF"> 
          <td width="98" height="35" align="center">汇款金额：</td>
          <td height="35"> 
       			<input name="money" type="text" value="" style='width:200px;' />
      	  </td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="98" height="35" align="center">汇款户名：</td>
          <td height="35"> 
       			<input name="username" type="text" value="" style='width:200px;' />
      	  </td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="98" height="35" align="center">汇款银行：</td>
          <td height="35"> 
       			<select name="bankname">
       				<option value="中国工商银行">中国工商银行</option>
       				<option value="中国招商银行">中国招商银行</option>
       				<option value="中国农业银行">中国农业银行</option>
       				<option value="中国建设银行">中国建设银行</option>
       				<option value="中国银行">中国银行</option>
       				<option value="中国光大银行">中国光大银行</option>
       				<option value="中国中信银行">中国中信银行</option>
       				<option value="中国交通银行">中国交通银行</option>
       				<option value="中国兴业银行">中国兴业银行</option>
       				<option value="中国邮政储蓄银行">中国邮政储蓄银行</option>
       			</select>

      	  </td>
        </tr>
        
        <tr bgcolor="#FFFFFF"> 
          <td width="98" height="35" align="center">汇款日期：</td>
          <td height="35"> 
       			 <input name="pay_date" size="8" readonly class="button1"/>
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.pay_date);" />
        
      	  </td>
        </tr>
        
       
        <tr align="center" bgcolor="#FFFFFF"> 
          <td height="30" colspan="2"> 
            <input type="submit" name="Submit" value="提 交" class="b02"> 
            <input type="reset" name="reset" value="重 写"  class="b02"> 
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td bgColor="#F2F2F2" height="1"></td>
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
