<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/new_style/js/jquery.js"></script>

<script type="text/javascript">
{literal}
$(function(){
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});

	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
})
</script>
{/literal}

</head>

<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>通讯录</div>

    <dl class="leftmenu">

    <dd>
        <div class="title">
            <a href ="index.php?module=index"  target="rightFrame"><span><img src="/new_style/images/leftico01.png" /></span>系统首页</a>
        </div>
    </dd>

    <dd>
        <div class="title">
            <span><img src="/new_style/images/leftico02.png" /></span>店铺管理
        </div>
        <ul class="menuson" style="display:block">
            <li><cite></cite><a href="index.php?module=CertifiedUserList" target="rightFrame">已开通店铺</a><i></i></li>
            <li><cite></cite><a href="index.php?module=tuijian"  target="rightFrame">推荐关系图</a><i></i></li>
            <li><cite></cite><a href="index.php?module=CaiWu" target="rightFrame">店铺账户状况</a><i></i></li>
            <li><cite></cite><a href="index.php?module=salary&action=list" target="rightFrame">工资表</a><i></i></li>
            <li><cite></cite><a href="index.php?module=TiXianmember" target="rightFrame">提现处理</a><i></i></li>
            <li><cite></cite><a href="index.php?module=Recharge&type=user" target="rightFrame">积分充值</a><i></i></li>
            <li><cite></cite><a href="index.php?module=Benefit&type=user" target="rightFrame">周期返还</a><i></i></li>
            <li><cite></cite><a href="index.php?module=fenhongjiang" target="rightFrame">全球分红结算</a><i></i></li>
            </ul>
        </dd> 


    <dd><div class="title"><span><img src="/new_style/images/leftico03.png" /></span>微信配置</div>
    <ul class="menuson">
        <li><cite></cite><a href="index.php?module=weixin" target="rightFrame">微信接口</a><i></i></li>
        <li><cite></cite><a href="index.php?module=weixin&action=regmsg" target="rightFrame">关注回复设置</a><i></i></li>
        <li><cite></cite><a href="index.php?module=weixin&action=keywords" target="rightFrame">关键词自动回复</a><i></i></li>
        <li><cite></cite><a href="index.php?module=weixin&action=menu" target="rightFrame">自定义菜单</a><i></i></li>
    </ul>
    </dd>


    <dd><div class="title"><span><img src="/new_style/images/leftico04.png" /></span>进▪ 销▪ 存</div>
    <ul class="menuson">
        <li><cite></cite><a href="index.php?module=ProductType" target="rightFrame">产品分类管理</a><i></i></li>
        <li><cite></cite><a href="index.php?module=RProduct" target="rightFrame">产品信息管理</a><i></i></li>
        <li><cite></cite><a href="index.php?module=HandleOrder" target="rightFrame">发货单管理</a><i></i></li>
    </ul>

    </dd>

    <dd><div class="title"><span><img src="/new_style/images/leftico04.png" /></span>综合管理</div>
        <ul class="menuson">
            <li><cite></cite><a href="index.php?module=QueryNotice" target="rightFrame">公告管理</a><i></i></li>
            <li><cite></cite><a href="index.php?module=Message" target="rightFrame">系统消息</a><i></i></li>
            <li><cite></cite><a href="index.php?module=UpdatePwd" target="rightFrame">密码修改</a><i></i></li>
            <li><cite></cite><a href="index.php?module=bochu" target="rightFrame">综合统计</a><i></i></li>
            <li><cite></cite><a href="index.php?module=FinanceLog" target="rightFrame">财务记录</a><i></i></li>
            <li><cite></cite><a href="index.php?module=log" target="rightFrame">登录日志</a><i></i></li>
            <li><cite></cite><a href="index.php?module=zblog" target="rightFrame">转币日志</a><i></i></li>
        </ul>

    </dd>

    <dd><div class="title"><span><img src="/new_style/images/leftico04.png" /></span>系统管理</div>
        <ul class="menuson">
            <li><cite></cite><a href="index.php?module=backup" target="rightFrame">数据备份</a><i></i></li>
            <li><cite></cite><a href="index.php?module=system" target="rightFrame">系统参数</a><i></i></li>
            <li><cite></cite><a href="index.php?module=kefu" target="rightFrame">在线客服</a><i></i></li>
            <li><cite></cite><a href="index.php?module=member" target="rightFrame">管理员列表</a><i></i></li>
        </ul>

    </dd>

    <dd><div class="title"><span><img src="/new_style/images/leftico04.png" /></span>新闻管理 </div>
        <ul class="menuson">
            <li><cite></cite><a href="index.php?module=newsclass" target="rightFrame">新闻分类管理</a><i></i></li>
            <li><cite></cite><a href="index.php?module=newslist" target="rightFrame">新闻列表管理</a><i></i></li>
            <li><cite></cite><a href="index.php?module=guanggao" target="rightFrame">广告位管理</a><i></i></li>
        </ul>

    </dd>



    </dl>

</body>
</html>
