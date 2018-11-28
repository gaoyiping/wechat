<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />

<script type="text/javascript" src="modpub/js/check.js" > </script>
{literal}
<script type='text/javascript'>
function check(f){
  if(Trim(f.toid.value) == ''){
    alert("请输入要转入的茶馆账号！");
    return false;
  }
  if(Trim(f.amount.value) == ''){
    alert("请输入转账金额！");
		return false;
  }


  if(!/^[1-9][0-9]*$/.test(Trim(f.amount.value))){
    alert("请输入正确格式的金额，且金额不能是负数！");
    f.amount.value = 0;
    return false;
  }

  var s = "系统提示：\n您确认将账户上的电子货币 "+f.amount.value + 
    " 转账至茶馆 "+f.toid.value+" 帐户吗？";  
  if(confirm(s)){
    var inputs = f.getElementsByTagName("INPUT");
    for(var i=0;i<inputs.length;i++){
      if(inputs[i].type=='submit'){
        inputs[i].disabled = true; break;
      }
    }
    return true;
  }
  return false;
}
</script>
{/literal}
</head>
<body scroll="yes">

  
	
         <br />
<form action="index.php?module=Exchange&action=add" method='post' onsubmit="return check(this);">

     <table border="0" cellspacing="1" cellpadding="1" class="query" width="90%" align="center">
                    <tr>
                        <td  class="table_body">
                            可用电子货币：
                        </td>
                        <td class="table_none">
                            {$emoney}.00     <input type="text" value="{$emoney}" id="emoney" name="emoney" class="button1" style='display:none;'/>
                        </td>
                    </tr>
                    <tr>
                        <td class="table_body">
                            转出账号：
                        </td>
                        <td class="table_none">
                            <input type="text" value="{$userid}" id="TransferFromAccount" readonly name="TransferFromAccount" class='button1' autocomplete="off"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="table_body">
                            转入账号：
                        </td>
                        <td class="table_none">
                            <input type="text" value="" id="toid" name="toid" class="button1" autocomplete="off"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="table_body">
                            转账金额：
                        </td>
                        <td class="table_none">
                            <input type="text" value="0" id="amount" name="amount" onkeyup="document.getElementById('amount1').value=document.getElementById('amount').value;"  class="button1" maxlength="10" autocomplete="off"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="table_body">
                            实收金额：
                        </td>
                        <td class="table_none">
                            <input type="text" value="0" id="amount1" readonly name="amount1" class="button1" maxlength="10" autocomplete="off"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="table_body">
                            备注：
                        </td>
                        <td class="table_none">
                            <textarea id="cfnumber" name="cfnumber" class="button1" rows="5" cols="40"></textarea>
                        </td>
                    </tr>
		    <tr>
<td colspan="2" align="center" style='color:red;'>{$error}</td>
		    </tr>
                </table>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" >
 
      <tr><td align="center"><br/><br/>
        <input class="b02" type="submit" style="font-size:14px;" value=" 提交 "/>&nbsp;&nbsp;
        <input type="button" class="b02" value=" 关闭 " onclick="window.parent.hidePopWin(true);" />
        <br/><br/><br/></td></tr>
    </table>
  </td></tr>
</table>
   </form>
</body>
</html>
