<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<title></title>
</head>
<body>
<header class="top">
 <div class="text-center">{if $type==0}推广提成{/if}{if $type==1}绩效提成{/if}{if $type==2}分红福利{/if}</div>
<div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
 </header>
<section class="center">
 <p class="lheight"></p>
 
 <div class="list-menu">

  <ul>
  {foreach from=$rpros item=item name=f1}
   <div class="padding">
    <li >
      {$item->noid}、
      {$item->wxname}
      （{$item->money|sprintf}）
      <span style="float:right">{$item->add_date}</span>
    </li>
  </div>
  {/foreach}
</ul>

<div style="text-align:center;margin-top:10px">
          {$pagehtml}
        </div>  
 
 
 </div>
 
 <p class="lheight"></p>
</section>


{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  


</body>
</html>
