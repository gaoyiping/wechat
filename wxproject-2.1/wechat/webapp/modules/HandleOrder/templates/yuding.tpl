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
 <div class="text-center">订单管理</div>
<div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
 </header>
<section class="center">
 <p class="lheight"></p>
 


  <div class="mem_zshycx">
    
        {foreach from=$list item=item1 name=f1}
    
        <ul>
          <li>
            <div class="l">序号</div>
            <div class="r">{$smarty.foreach.f1.iteration}</div>
          </li>
          <li>
            <div class="l">订单号</div>
            <div class="r">{$item1->sNo}</div>
          </li>
          <li>
            <div class="l">消费日期</div>
            <div class="r">{$item1->add_date|date_format:'%Y-%m-%d'}</div>
          </li>
        
        <li>
            <div class="l">金额</div>
            <div class="r">￥{$item1->moneys|sprintf}</div>
        </li>
        <li style="border-bottom-color:Gray;">
            <div class="l">状态</div>
            <div class="r">
          {if $item1->status==2}<font >已签收</font>{/if}
          {if $item1->status==0}<font color="red" >未发货</font>{/if}
          {if $item1->status==1}<font color="#B2981F">已发货</font> <a href="index.php?module=HandleOrder&action=confirm&sNo={$item1->sNo}" onclick="return confirm('确定收货吗？')">[确认收货]</a>{/if}
          <a href="index.php?module=HandleOrder&action=view&sNo={$item1->sNo}">[查看明细]</a>
          </div>
        </li>
          
        </ul>
    
    {/foreach}
    
          
    
        
</div> 
 

 <div style="text-align:center;">
          {$pagehtml}
  </div>  

 
 <p class="lheight"></p>
</section>


{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  


</body>
</html>
