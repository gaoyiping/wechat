<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>配送中心</title>
    {php}include BASE_PATH."/modules/Top/templates/index.tpl";{/php}  
    <link href="modpub/css/css.css" type="text/css" rel="stylesheet">
    </head>
<body>
	<div class="header_03">
      <div class="back"> <a href="index.php?module=index" class="arrow"></a> </div>
      <div style="" class="tit">
   		 <h3>配送中心</h3>
  	  </div>
  	  
    {php}include BASE_PATH."/modules/Menu/templates/index.tpl";{/php}  
  	
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
            <div class="l">用户编号</div>
            <div class="r">{$item1->user_id}</div>
          </li>
          <li>
            <div class="l">消费日期</div>
            <div class="r">{$item1->add_date|date_format:'%Y-%m-%d'}</div>
          </li>
          <li>
            <div class="l">消费类型</div>
            <div class="r">
			{if $item1->type==1}<font color="red">注册消费</font>{/if}
			{if $item1->type==2 || $item1->type==3}<font color="#185A85">升级消费</font>{/if}
			{if $item1->type==4}<font color="#B2981F">零售消费</font>{/if}
			{if $item1->type==7}<font color="#18950B">重复消费</font>{/if}
			</div>
          </li>
          <li>
            <div class="l">金额</div>
            <div class="r">￥{$item1->moneys|sprintf}</div>
          </li>
          <li >
            <div class="l">状态</div>
            <div class="r">
			{if $item1->status==2}<font color="#B2981F">已签收</font>{/if}
			{if $item1->status==0}<font color="red">未发货</font>{/if}
			{if $item1->status==1}<font color="#B2981F">已发货</font>{/if}
			</div>
          </li>
          
          <li style="border-bottom-color:Gray;">
            <div class="l">操作</div>
            <div class="r">
			[<a href="index.php?module=PSOrder&action=view&sNo={$item1->sNo}">查看明细</a>] 
			{if $item1->status==0}<font >[<a href="index.php?module=PSOrder&action=view&sNo={$item1->sNo}">我要发货</a></font>]{/if}
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