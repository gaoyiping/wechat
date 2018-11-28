<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<title>米粉世界</title>
</head>

<body>
<header class="top">
 <div class="text-center"><b>米粉世界<b/></div>

 </header>
<section class="center">
 <p class="lheight"></p>
 

 <div class="list-menu">
 
 
<ul>
<div class="padding"><li ><a href="index.php?module=index&action=rq&pid={$user->user_id}">米粉解答</a></li></div>
<div class="padding"><li ><a href="index.php?module=index&action=tg">米粉保障</a></li></div>
<div class="padding"><li ><a href="index.php?module=salary">售后服务</a></li></div>
</ul>



 </div>
 
 <p class="lheight"></p>
</section>
<script type="text/javascript" charset="utf-8">
document.getElementById("tx").src="{$user->headimgurl}";
</script>

{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  

</body>
</html>
