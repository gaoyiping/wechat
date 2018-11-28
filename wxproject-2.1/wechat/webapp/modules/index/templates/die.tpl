<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>我的人气</title>
    {php}include BASE_PATH."/modules/Top/templates/index.tpl";{/php}  
    
    <link rel="stylesheet" href="jquery_mobile/css/themes/default/jquery.mobile-1.4.5.css">
	<script src="jquery_mobile/js/jquery.js"></script>
	<script src="jquery_mobile/js/jquery.mobile-1.4.5.min.js"></script>
	</head>
    <body>


<section style="width:100%;margin:10px auto 0;overflow:hidden;">
<div class="user"> 
<ul data-role="listview" data-inset="true">{foreach from=$list item=item1 name=f1}<li data-icon="false"><a href="index.php?module=index&action=rq&pid={$item1->user_id}"  rel="external" ><img src="{$item1->headimgurl}" class="ui-li-icon ui-corner-none">{$item1->wxname}<span class="ui-li-count"> ( 查看 )</span></a></li>{/foreach}
</ul>    
</div>
</section>
﻿
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  


</body>
</html>