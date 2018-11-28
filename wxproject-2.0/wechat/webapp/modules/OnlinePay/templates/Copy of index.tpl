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
               
               if ($.trim($("#TxtMoney").val()).length == 0) {
                   mbox("请输入充值金额!");
                   return false;
               }
			   
			   
				
			  return true;
           }
    </script>
{/literal}	
</head>
<body>
<form name="f" action="index.php?module=OnlinePay" method='post' onsubmit="return SaveVal(this);">

  
  <div>
    <div class="manage_tit">
    <a id="ContentPlaceHolder1_LbtnExit" class="exit" href="index.php">[安全退出]</a>
    <a href="javascript:history.go(-1)" class="return"></a> <span class="linel"></span> <strong>在线充值</strong> </div>
    <div class="content">
      <div class="paw_change">
        <ul>
          
          <li>
            <p>当前积分余额：</p>
            <p>
             ￥<strong><u>{$emoney|sprintf}<input name="emoney" type="hidden" id="emoney" value="{$emoney}" >
            </p>
          </li>
          
          <li>
            <p>充值金额：</p>
            <p>
              <input name="amount" type="text" id="TxtMoney" class="paw_inp" placeholder="必填项" onkeypress="if ((event.keyCode < 48 || event.keyCode > 57) &amp;&amp; (event.keyCode != 46)) event.returnValue = false;">
            </p>
          </li>
          
        </ul>
      </div>
	  
	  <div class="paw_icon">
		  <input type="submit" value=""  class="sub" >
		  
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
