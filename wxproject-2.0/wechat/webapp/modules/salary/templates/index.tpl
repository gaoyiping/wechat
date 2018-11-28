<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="style/css/amazeui.min.css">
    <link rel="stylesheet" href="style/css/css.css">
    <title></title>
</head>
<body>
<header class="top">
    <div class="text-center">我的积分</div>
    <div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
</header>
<p class="lheight"></p>
<section class="center">

    <div class="list-menu">

        <ul>
            <div class="padding">
                <li class="m2" id="img_w" style="background:none;padding-left:0px"><a href="javascript:void(-1)">1、累计订单积分<span>￥{$cj|sprintf}</span></a></li>
            </div>

            <div class="padding">
                <li class="m2" id="img_w" style="background:none;padding-left:0px"><a href="javascript:void(-1)">2、累计硒粉积分<span>￥{$jdj|sprintf}</span></a></li>
            </div>

            <div class="padding">
                <li class="m2" id="img_w" style="background:none;padding-left:0px"><a href="javascript:void(-1)">3、累计硒钻积分<span>￥{$fxj|sprintf}</span></a></li>
            </div>


            <div class="padding">
                <li class="m2" id="img_w" style="background:none;padding-left:0px"><a href="javascript:void(-1)">4、累计投资劵<span>￥{$gwb|sprintf}</span></a></li>
            </div>


            <div class="padding">
                <li class="m2" id="img_w" style="background:none;padding-left:0px"><a href="javascript:void(-1)">5、累计梦想劵<span>￥{$sj|sprintf}</span></a></li>
            </div>

            <div class="padding">
                <li class="m2" style="background:none;padding-left:0px"><a href="index.php?module=Cash&action=List">6、当前可兑换积分<span>￥{$user->j_money|sprintf}</span></a>
                </li>
            </div>
        </ul>

    </div>

    <p class="lheight"></p>
</section>


{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}


</body>
</html>
