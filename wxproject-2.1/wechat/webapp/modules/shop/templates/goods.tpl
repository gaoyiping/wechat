<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="js/jquery.json.js" type="text/javascript"></script>
<script src="js/common.js" type="text/javascript"></script>
<script src="js/transport.js" type="text/javascript"></script>
<script type="text/javascript" src="js/fbi.js"></script>
{literal}
<script type="text/javascript">
$(function() {
    
    $("#btn_continue").click(function(){
        $("#buy_lay").hide();
        $("#buy_lay_frm").hide();
    });
    $("#btn_check").click(function(){
        window.location='index.php?module=cart';
    });  
    $(document).bind("click",function(){
        $("#buy_lay").hide();
        $("#buy_lay_frm").hide();
    });
    $("#queding").click(function(){
        $("#nologin").hide();
        
    });
});
</script>
<script type="text/javascript">
var $$ = function (obj) {
    if (obj != null && obj != undefined && obj.toString().length > 0) {
        if (obj[0] == '#') {
            return document.getElementById(obj.substr(1, obj.length - 1));
        }
    }
}
function chgNum(a) {
    var number = $$("#number");
    var p = parseInt(number.value);
    if (a >= 1) {
        if (p < 1038) number.value = a+p;
    }
    else {
        if (p > 1) number.value = p+a;
    }
}
</script>
<style>
    .no-collect{
    float:left;
    }
    .icon1{
    float:left;
    margin-right:3px;}
</style>
{/literal}
<title>商品详情</title>
</head>
<body>
<header class="top"> 
<div class="text-center">{$goods_info.pname}</div>
<div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
 </header>
<section class="center">
 <p class="lheight"></p>


<div class="good-disc">

<div class="pic-box">

    <a href="/upfile/{$goods_info.imgURL}"><img src="/upfile/{$goods_info.imgURL}" alt="'{$goods_info.pname}" title="{$goods_info.pname}"></a>

</div>




<ul>
<h1>{$goods_info.pname}</h1>
<li>原价：<strong class="red" style="text-decoration:line-through">￥{$goods_info.guige}</strong></li>
<li>会员价：<strong class="red">￥{$goods_info.zhuanmaijia}</strong></li>
<li>积分：<strong class="red">{$goods_info.jifen}</strong></li>
<li>商品总价：
<span class="shopcount" id="ECS_GOODS_AMOUNT">￥{$goods_info.total}</span>
</li>
<li>库存：<strong {if $goods_info.good_number<$goods_info.tixingshu}class="red"{/if}>{$goods_info.good_number}</strong></li>
<li>点击量：<strong {if $goods_info.good_number<$goods_info.tixingshu}class="red"{/if}>{$goods_info.click}次</strong></li>
</ul>

<form action="javascript:addToCart({$goods_info.id})" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
<input name="price" type="hidden" value="{$goods_info.promote_price}" />
<ul>
<li><label>数&nbsp;&nbsp;量：</label>
      
                <input type="button" style="background-color: #ccc;" value="-" class="btn" onClick="chgNum(-{$goods_info.qidingnum});changePrice();" /> 
                <input type="text" id='number' name="number" onblur="changePrice()" value="{$goods_info.qidingnum}" size='3' class="text"/>  
                <input type="button" style="background-color: #ccc;"  value="+" class="btn" onClick="chgNum({$goods_info.qidingnum});changePrice();" />

</li>
</ul>
</form>
</div>

<div class="disc-box">
<h2>商品详情</h2>
<div class="box">{$goods_info.detail}</div>
</div>


 <p class="lheight"></p>
</section>
<footer>
  <div class="bottom product-detail-action">
    <a href="javascript:window.history.back();" class="action pull-left">
        <span class="am-icon-star-o"></span><br>返回
    </a>
    <a href="index.php?module=cart" class="action pull-right">
        <span class="am-icon-shopping-cart"></span><br>购物车
    </a>
    <div class="tool-bar">
        <button type="button" onclick="javascript:addToCart({$goods_info.id}, 'add_cart');" data-bind="enable:enableBtn,click:postShoppingCart" class="btn btn-block red">加入购物车</button>
    </div>
  </div>
</footer>

<div id="buy_lay"></div>
<div id="buy_lay_frm">
    <div class="frm">
        <div class="tips">商品已添加到购物车！</div>
        <div class="btns">
            <input id="btn_continue" class="btn" type="button" value=" 再逛会 " />
            <input id="btn_check" class="btn" type="button" value=" 去结算 " />
        </div>
    </div>
</div>


<div id="masklayer" class="masklayer " ontouchmove="return true;" onclick="$(this).toggleClass('on');">
    <img src="./images/share.png" alt="" style="width:260px;">
</div>

{literal}
<script>
$('.icon1').click(function(){
$('#masklayer').addClass('on');

})


</script>
<style type="text/css">
    .masklayer{
        display:none;
        position:fixed;
        top:0;
        left:0;
        z-index:2000;
        width:100%;
        height:100%;
        background-color:rgba(0,0,0,0.5);
        text-align:right;
    }
    .masklayer.on{
        display:block;
    }
    .masklayer img{
        margin-top:10px;
        margin-right:30px;
        width:160px;
    }
</style>

{/literal}

    </div>
</div>
</section>

{literal}   


<script type="text/javascript">
var addto_cart_success = "该商品已添加到购物车。";

function changePrice()
{
    var number = parseInt(document.forms['ECS_FORMBUY'].elements['number'].value);
    var price =  parseFloat(document.forms['ECS_FORMBUY'].elements['price'].value);
    if (document.getElementById('ECS_GOODS_AMOUNT'))
    document.getElementById('ECS_GOODS_AMOUNT').innerHTML = "￥"+number*price;
      
}

</script>
{/literal} 

</body>
</html>
