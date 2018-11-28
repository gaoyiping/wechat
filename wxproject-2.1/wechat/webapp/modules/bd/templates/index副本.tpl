<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>积分互转</title>
    {php}include BASE_PATH."/modules/Top/templates/index.tpl";{/php}  
        <link href="modpub/css/css.css" type="text/css" rel="stylesheet">
<link href="/phone/modpub/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="/phone/modpub/js/jquery.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/dialog.js" type="text/javascript"></script> 
{literal}
<script type="text/javascript">
           
           function SaveVal(f) {
               
               if ($.trim($("#TxtNumb").val()).length == 0) {
					mbox("请输入转入帐户!");
					return false;
				}
				if ($.trim($("#TxtMoney").val()).length == 0) {
					mbox("请输入转账金额!");
					return false;
				}
				
  
              if(confirm("系统提示：\n你确定要给账号 " + 
				f.userid.value + " 充值 ￥" + f.amount.value + " 吗？")){
				var es = document.form1.elements;
				for(var i=0;i<es.length;i++){
				  if(es[i].type == 'submit'){
					es[i].disabled = true;
				  }
				}
				return true;
			  }
			  return false;
			  
           }
    </script>
{/literal}	
    </head>
    <body>
	<div class="header_03">
      <div class="back"> <a href="index.php?module=index" class="arrow"></a> </div>
      <div style="" class="tit">
    <h3>积分互转</h3>
  </div>
      {php}include BASE_PATH."/modules/Menu/templates/index.tpl";{/php}
</div>
<section style="width:100%;margin:45px auto 0;overflow:hidden;">


<form name="f" action="index.php?module=nochizhi" method='post' onsubmit="return SaveVal(this);">
<input type="hidden" name="type" value="user">
  
  <div>
   
    <div class="content">
      <div class="paw_change">
        <ul>
          
          <li>
            <p>积分余额：</p>
            <p>
             ￥<strong><u>{$user->z_money|sprintf}<input name="z_money" type="hidden"  value="{$user->z_money}" >
            </p>
          </li>
          
          <li>
            <p>转入帐户编号：</p>
            <p>
              <input name="userid" type="text"  id="TxtNumb" class="paw_inp" placeholder="必填项" >
            </p>
          </li>
		  
		  
		  <li>
            <p>交易金额：</p>
            <p>
              <input name="amount" type="text"  id="TxtMoney" class="paw_inp" placeholder="必填项" onkeypress="if ((event.keyCode < 48 || event.keyCode > 57) &amp;&amp; (event.keyCode != 46)) event.returnValue = false;">
            </p>
          </li>
          
        </ul>
      </div>
	  
	  <div class="paw_icon">
		  <input type="submit" value=""  class="sub">
		  
      </div>
	  
    </div>
  </div>
  

</form>

</section>
﻿
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  


</body>
</html>