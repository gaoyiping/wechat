<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<script type="text/javascript" src="modpub/js/check.js"> </script>
<title></title>
<link href="style/dialog/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="style/dialog/js/jquery.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/dialog.js" type="text/javascript"></script> 

{literal}
<script type="text/javascript">
function SaveVal(f) {
 
  if(Trim(f.cardtype.value) == ''){
      mbox("银行名称未填!");
      return false;
    }
    
    if(Trim(f.cardname.value) == ''){
      mbox("银行开户名未填!");
      return false;
    }

    if(Trim(f.cardnumber.value) == ''){
      mbox("银行帐号未填!");
      return false;
    }
    
    return true;
          
  
}
</script>
{/literal}
</head>

<body class="white">
<header class="top"> 
<div class="text-center">银行卡信息管理</div>
<div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
 </header>
<section class="center">
 <p class="lheight"></p>
 
<div class="new_add">

    <form name="f"  class="am-form" action="index.php?module=ModifyInfo&action=bank" method='post' onsubmit="return SaveVal(this);">

  <fieldset>
    <div class="am-form-group">
      <label for="cardtype">开户银行：</label>
      <input type="text" id="cardtype" name="cardtype" value="{$userinfo->card_type}"  placeholder="" required />
    </div>

    <div class="am-form-group">
      <label for="cardname">银行开户名：</label>
      <input type="text" name="cardname" value="{$userinfo->card_name}"  id="cardname" placeholder="" required/>
    </div>

    <div class="am-form-group">
      <label for="cardnumber">银行帐号：</label>
      <input type="text" name="cardnumber" value="{$userinfo->card_number}"  id="cardnumber" placeholder="" required/>
    </div>

    <div class="am-form-group">
      <label for="provcity">开户行所在地：</label>
      <input type="text" name="provcity" value="{$userinfo->provcity}"  id="provcity" placeholder="" />
    </div>


    <input type="submit" value="保存信息" class="am-btn am-btn-success am-btn-block" />

  </fieldset>
</form>

</div>


 <p class="lheight"></p>
</section>

{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  

</body>
</html>
