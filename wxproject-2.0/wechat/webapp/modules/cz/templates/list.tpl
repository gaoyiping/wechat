<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<title>拨币记录</title>
</head>

<body class="white">


<section class="center">
 
<div class="zhrjl">
  <span class="f-left"><i class="am-icon-retweet"></i>拨币记录</span>
    <button class="f-right shqzhb"><i class="am-icon-plus"></i><a href="index.php?module=cz">申请拨币</a></button>
</div>


 <div class="list-menu">

  <ul>
  {foreach from=$logs item=item name=f1}
   <div class="padding">
    <li >
      {if $item->amount<0}转出 {$item->accepter}{/if}
      {if $item->amount>0}转入 {$item->accepter}{/if}

      （{$item->amount|sprintf}）

      <span style="float:right">{$item->add_date}</span>
    </li>
  </div>
  {/foreach}
</ul>


 
 
 </div>
 

 <p class="lheight"></p>
</section>


{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  


</body>
</html>
