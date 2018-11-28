<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<script type="text/javascript" src="resource/jquery-2.2.1.min.js"></script>
<title>商品详情</title>
</head>
<body>
<header class="top">
    <div class="text-center">{$goods->pname}</div>
    <div class="action">
        <a href="javascript:window.history.back();" class="pull-left"><i class="am-icon-chevron-left"></i></a>
    </div>
</header>
<section class="center">
    <p class="lheight"></p>
    <div class="good-disc">
        <div class="pic-box">
            <a class="goods-banner" href="/upfile/{$goods->imgURL}"><img src="/upfile/{$goods->imgURL}"></a>
        </div>
        <ul>
            <h1>{$goods->pname}</h1>
            <li>原价：<b style="text-decoration:line-through">￥{$goods->guige}</b></li>
            <li>会员价：<strong class="red">￥{$goods->zhuanmaijia}</strong></li>
            <li>积分：<strong class="red">{$goods->jifen}</strong></li>
            <li>库存：<strong {if $goods->good_number<$goods->tixingshu}class="red"{/if}>{$goods->good_number}</strong></li>
            <li>点击量：<strong {$goods->click}次</strong></li>
        </ul>

        <form action="javascript:addToCart({$goods->id})" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
            <input name="price" type="hidden" value="{$goods->promote_price}" />
        </form>
    </div>
    <div class="disc-box">
        <h2>商品详情</h2>
        <div class="box">{$goods->detail}</div>
    </div>
    <p class="lheight"></p>
</section>
<footer>
  <div class="bottom product-detail-action">
    <div class="tool-bar">
        <button id="buygroup" type="button" class="btn btn-block red">立即购买</button>
    </div>
  </div>
</footer>
<script type="text/javascript">
var goodid = {$goods->id};
{literal}
$(document).ready(function() {
    $("#buygroup").on("click", function() {
        $("#buygroup").attr({"disabled":"disabled"});
        $.post("index.php?module=shop&action=addgroup", {goods: goodid}, function(result) {
            if (result) {
                location.href="index.php?module=cart&action=group&goods="+goodid;
            } else {
                alert("无法购买");
                $("#buygroup").removeAttr("disabled");
            }
        });
    });
});
{/literal}
</script>
</body>
</html>
