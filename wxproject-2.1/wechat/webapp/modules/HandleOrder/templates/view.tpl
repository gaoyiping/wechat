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
 <div class="text-center">订单详情</div>
<div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
 </header>
<section class="center">
 <p class="lheight"></p>
 


  <div class="mem_zshycx">
    
        <ul>
          <li>
            <div class="l">订单号</div>
            <div class="r">{$pinfo->sNo}</div>
          </li>
          
          <li>
            <div class="l">订购日期</div>
            <div class="r">{$pinfo->add_date|date_format:'%Y-%m-%d'}</div>
          </li>
          
          <li>
            <div class="l">金额</div>
            <div class="r">￥{$pinfo->moneys|sprintf}</div>
          </li>
          
          <li >
            <textarea style="width:100%">{foreach from=$list item=item2 name=f1}[{$item2->rsNo}] {$item2->rname} {$item2->rnum}{$item2->rdanwei} ￥{$item2->rnum*$item2->rjiage}&#13{/foreach}</textarea>
         
          </li>


          
          <li  style="border-bottom-color:Gray;">
            <div class="l">状态</div>
            <div class="r">
      {if $pinfo->status==2}<font color="#B2981F">已签收</font>{/if}
      {if $pinfo->status==0}<font color="red">未发货</font>{/if}
      {if $pinfo->status==1}<font color="#B2981F">已发货</font>{/if}
      </div>
          </li>
          
         
          
        </ul>

        
        {if $pinfo->status==1}
        <div class="paw_icon">
         <input  type="button" value="[确认收货]" onclick="window.location.href='index.php?module=HandleOrder&action=confirm&sNo={$pinfo->sNo}'" >
         <input type="button" value="[返回]" onclick="history.go(-1)" >
        </div>
        {else}
        &nbsp;
        <div class="paw_icon">
         <input type="button" value="[返回]" onclick="history.go(-1)" >
        </div>
        {/if}
    
          
    
        
</div> 
 


 
 <p class="lheight"></p>
</section>


{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  


</body>
</html>
