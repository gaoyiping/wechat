<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>我的消息</title>
    {php}include BASE_PATH."/modules/Top/templates/index.tpl";{/php}  
    <link href="modpub/css/css.css" type="text/css" rel="stylesheet">
    </head>
<body>
	<div class="header_03">
      <div class="back"> <a href="index.php?module=index" class="arrow"></a> </div>
      <div style="" class="tit">
   		 <h3>我的消息</h3>
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
            <div class="l">发送时间</div>
            <div class="r">{$item1->add_date}</div>
          </li>
          <li style="border-bottom-color:Gray;">
            <div class="l">消息内容</div>
            <div class="r">{$item1->content}</div>
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