<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<link rel="stylesheet" href="style/css/shopping-cart.css" >
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="js/transport2.js" type="text/javascript"></script>
<title>购物车</title>
{literal}

<script type="text/javascript">
    function add_num(rec_id,goods_id){
        document.getElementById("goods_number_"+rec_id+"").value++;
        var number = document.getElementById("goods_number_"+rec_id+"").value;
        Ajax.call('index.php?module=cart&action=update','rec_id=' + rec_id +'&number=' + number+'&goods_id=' + goods_id, changePriceResponse, 'GET', 'JSON');
    }
    
    function red_num(rec_id,goods_id){
        if (document.getElementById("goods_number_"+rec_id+"").value>1){
            document.getElementById("goods_number_"+rec_id+"").value--;
        }
        var number = document.getElementById("goods_number_"+rec_id+"").value;
        Ajax.call('index.php?module=cart&action=update','rec_id=' + rec_id +'&number=' + number+'&goods_id=' + goods_id, changePriceResponse, 'GET', 'JSON');
    }
    
    function change_price(rec_id,goods_id){
        var number = document.getElementById("goods_number_"+rec_id+"").value;
        Ajax.call('index.php?module=cart&action=update','rec_id=' + rec_id +'&number=' + number+'&goods_id=' + goods_id, changePriceResponse, 'GET', 'JSON');
    }
    
    function changePriceResponse(result){
        if(result.error == 1){
            alert(result.content);
            document.getElementById("goods_number_"+result.rec_id+"").value =result.number;
        }else{
            document.getElementById('cart_amount_desc').innerHTML = result.cart_amount_desc;//购物车商品总价说明
        }
    }
    </script>
{/literal}
</head>

<body>
<header class="top">
    <div class="text-center"><b>购物车</b></div>
    <div class="action"> <a href="index.php?module=index" class="pull-left"> <i class="am-icon-user"></i> </a> <a href="index.php?module=cart&action=dropall" class="pull-right"> <i class="am-icon-trash-o"></i> </a> </div>
</header>

<section>
  <div class="main margin-top-15">
    <div class="shopping-cart">

 <!--{if $goods_list}-->
    <!--顶部begin-->
    <div class="top clearfix">
      <div class="pro-num">
        <p>共{$total}件商品</p>
      </div>
      <a class="continue" href="index.php?module=shop">继续购物>></a> </div>
    <!--顶部end-->
    <!--商品列表begin-->

      <!--商品列表begin-->
    <div class="list">
      <ul>
        <!-- {foreach from=$goods_list item=goods} -->
        <li class="clearfix first">
          <div class="container clearfix">
            <div class="show clearfix"> <a  href="#"><img src="/upfile/{$goods.goods_img}" /></a> </div>
            <div class="info">
              <p class="name"><a href="#">{$goods.goods_name}</a></p>
              <p class="price">单&nbsp;&nbsp;&nbsp;价<strong>{$goods.goods_price}</strong></p>
              <div class="num num-edit clearfix" >
                <p>数&nbsp;&nbsp;&nbsp;量</p>
                <!-- {if $goods.goods_id gt 0 && $goods.is_gift eq 0 && $goods.parent_id eq 0} 普通商品可修改数量 -->
                <div>
                  <input onclick="red_num({$goods.rec_id},{$goods.goods_id});" class="edit" type="button" value="-"/>
                </div>
                <div>
                  <input class="number" type="text" name="goods_number[{$goods.rec_id}]" id="goods_number_{$goods.rec_id}" value="{$goods.goods_number}" onblur="change_price({$goods.rec_id},{$goods.goods_id})" />
                </div>
                <div>
                  <input onclick="add_num({$goods.rec_id},{$goods.goods_id})" class="edit" type="button" value="+"/>
                </div>
                <!-- {else} -->
                {$goods.goods_number}
                <!-- {/if} -->
              </div>
            </div>
          </div>
          <a href="index.php?module=cart&action=drop&rec_id={$goods.rec_id}" class=trash> </a> </li>
        <!-- {/foreach} -->
      </ul>
    </div>
    <!--商品列表end-->


    <!--结算begin-->
    <div class="account">
      <div class="delete clearfix"> <a href="index.php?module=cart&action=dropall" class=delete-all><i></i>清空购物车</a> </div>
      <div class="total">
        <div class="final">
          <p>实付金额：<strong id="cart_amount_desc">{$totalmoney}</strong></p>
        </div>
      </div>
      <div class="buy">
          <input type="button" value="立即下单" onclick="location.href='index.php?module=cart&action=order'">
      </div>
    </div>
    <!--结算end-->
    <!--{else}-->
    <ul class="products">
        <li class="item">
          <h4 class="shopping-cart-container text-center" data-got-cart="false"> 您的购物车里还没有商品. <a href="index.php?module=shop" >去逛逛</a></h4>
        </li>
      </ul>
    <!--{/if}-->

    </div>
  </div>
</section>


<!--在这里编写你的代码-->

{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  
</body>
</html>
