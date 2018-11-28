<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>我的订单</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="telephone=no" name="format-detection" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="viewport" content="width=320, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png"/>
<link href="modpub/css/css.css" type="text/css" rel="stylesheet">
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/xmapp.css"/>
<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />
    </head>
<body>
	<div class="header_03">
      <div style="" class="tit">
   		 <h3>我的订单</h3>
  	  </div>
  	  
</div>
    
<section style="width:100%;margin:45px auto 0;overflow:hidden;">
<div class="content">
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
            <div class="l">消费类型</div>
            <div class="r">
			{if $item1->type==1}<font color="red">注册/零售消费</font>{/if}
							{if $item1->type==2 || $item1->type==3}<font color="#185A85">升级消费</font>{/if}
							{if $item1->type==4}<font color="#B2981F">零售消费</font>{/if}
							{if $item1->type==7}<font color="#18950B">重复消费</font>{/if}
			</div>
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
		
				  
		<div style="font-size:20px;text-align:center;">
          {$pagehtml}
        </div>  
        
      </div>
    </div>
</section>
﻿
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  


</body>
</html>