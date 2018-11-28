<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>产品订购单</title>
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
   		 <h3>订单详情</h3>
  	  </div>
  	  
   
</div>	
<section style="width:100%;margin:0px auto 0;overflow:hidden;">
<div class="content">
      <div class="mem_zshycx">
	  
	  
        <ul>
          <li>
            <div class="l">订单号</div>
            <div class="r">{$pinfo->sNo}</div>
          </li>
          <li>
            <div class="l">用户编号</div>
            <div class="r">{$pinfo->user_id}</div>
          </li>
          <li>
            <div class="l">订购日期</div>
            <div class="r">{$pinfo->add_date|date_format:'%Y-%m-%d'}</div>
          </li>
          <li>
            <div class="l">消费类型</div>
            <div class="r">
			{if $pinfo->type==1}<font color="red">注册/零售消费</font>{/if}
			{if $pinfo->type==2 || $pinfo->type==3}<font color="#185A85">升级消费</font>{/if}
			{if $pinfo->type==4}<font color="#B2981F">零售消费</font>{/if}
			{if $pinfo->type==7}<font color="#18950B">奇妙消费</font>{/if}
			</div>
          </li>
          <li>
            <div class="l">金额</div>
            <div class="r">￥{$pinfo->moneys|sprintf}</div>
          </li>
          
          <li >
            <div class="l">产品订购明细</div>
            <div class="r" ><textarea style="width:100%">{foreach from=$list item=item2 name=f1}[{$item2->rsNo}] {$item2->rname} {$item2->rnum}{$item2->rdanwei} ￥{$item2->rnum*$item2->rjiage}&#13{/foreach}</textarea>
			</div>
          </li>
          
          <li>
            <div class="l">收货人</div>
            <div class="r">{$pinfo->post_name}</div>
          </li>
          
          <li>
            <div class="l">联系电话</div>
            <div class="r">{$pinfo->post_tel}</div>
          </li>
          
          <li>
            <div class="l">收货地址</div>
            <div class="r">{$pinfo->s1}{$pinfo->s2}{$pinfo->s3},{$pinfo->post_address}</div>
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
		<div class="paw_icon">
		 <input type="button" value="[返回]" onclick="history.go(-1)" >
		</div>
		{/if}
				  
        
      </div>
    </div>
</section>
﻿
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  


</body>
</html>