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
 <div class="text-center">我的推广</div>
<div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
 </header>
 <p class="lheight"></p>
<section class="center">
  
  <div class="total-goods">
  <ul>
 

 {foreach from=$list item=item1 name=f1}
  <li style="height:73px">
    <div style="float:left;width:100%">
    <p class="pic"><a href=""><img style="height:50px" src="{$item1->headimgurl}"></a></p>
    <p><span class="blue" >{$item1->wxname}</span></p>
    <p><span style="color: white;
  padding: 2px 10px 2px 10px;
  background-color: rgb(202, 24, 31);
  -webkit-box-shadow: 1px 1px 5px #000;
  -moz-box-shadow: 3px 3px 5px #000;
  -webkit-border-radius: 2px;
  -moz-border-radius: 15px;
  font-size: 12px;">{if $item1->uplevel==0}见习小二{/if}{if $item1->uplevel==1}店小二{/if}{if $item1->uplevel==2}掌柜{/if}{if $item1->uplevel==3}东家{/if}{if $item1->uplevel==4}富豪{/if}{if $item1->uplevel==5}大富豪{/if}{if $item1->uplevel==6}伙计{/if}</span>&nbsp;&nbsp;<span style="color: white;
  padding: 2px 10px 2px 10px;
  background-color: rgb(92, 132, 54);
  -webkit-box-shadow: 1px 1px 5px #000;
  -moz-box-shadow: 3px 3px 5px #000;
  -webkit-border-radius: 2px;
  -moz-border-radius: 15px;
  font-size: 12px;">关注时间：{$item1->add_date}</span></p>
</div>



  </li>
  {/foreach}
  
  
  
    
  
  
  </ul>
  
  </div>
  
  
 
 </div>
</section>
<footer>
  <div class="bottom">
    <div class="fhwszx"  style="text-align: center;"><a style="color:white" href="index.php?module=index"><i class="am-icon-user am-icon-sm"></i></br>返回硒客中心</a></div>
  </div>
</footer>
﻿


</body>
</html>