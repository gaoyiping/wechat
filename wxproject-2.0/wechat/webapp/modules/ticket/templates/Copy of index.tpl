<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>微优品店铺管理系统-移动版</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;">
<link href="/phone/modpub/css/css.css" type="text/css" rel="stylesheet">
<link href="/phone/modpub/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="/phone/modpub/js/jquery.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/dialog.js" type="text/javascript"></script> 
</head>
<body>
<form method="post" action="" id="form1">
  
  <div>
    <div class="manage_tit">
    <a id="ContentPlaceHolder1_LbtnExit" class="exit" href="index.php">[安全退出]</a>
    <a href="javascript:history.go(-1)" class="return"></a> <span class="linel"></span> <strong>首页信息</strong> </div>
    <div class="content">
      <div class="mem_zshycx">
        <ul>
          <li>
            <div class="l">编号</div>
            <div class="r">{$user->user_id}</div>
          </li>
          <li>
            <div class="l">推荐人</div>
            <div class="r">{$user->pnode}</div>
          </li>
          <li>
            <div class="l">店铺等级</div>
            <div class="r"><font color="#116600">{if $user->uplevel==0} 微会员{/if}</font>
	<font color="#1166FF">{if  $user->uplevel==1} 天使会员{/if}</font>
	<font color="#966F12">{if $user->uplevel==2} 钻石经理{/if}</font>
	<font color="#C40D74">{if  $user->uplevel>=3} 皇冠经销商{/if}</font></div>
          </li>
          
          <li>
            <div class="l">电子币余额</div>
            <div class="r">￥ {$user->z_money|sprintf}</div>
          </li>
          <li>
            <div class="l">当前奖金余额</div>
            <div class="r">￥ {$user->e_money|sprintf}</div>
          </li>
          <li>
            <div class="l">累计奖金金额</div>
            <div class="r">￥ {$tixianjin|sprintf}</div>
          </li>
          <li>
            <div class="l">注册日期</div>
            <div class="r">{$user->add_date}</div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="menu_footer">
    <ul>
      <li class="wid20"><a href="index.php?module=index" class="xxgl">首页</a></li>
      <li class="wid20"><a href="index.php?module=tuijian" class="cwgl">网络部门</a></li>
      <li class="wid20"><a href="index.php?module=swzx" class="hygl">商务中心</a></li>
      <li class="wid20"><a href="index.php?module=cwzx" class="dzhb">财务中心</a></li>
      <li class="bac_no wid20"><a href="index.php?module=grzx" class="xtgl">个人中心</a></li>
    </ul>
  </div>

</form>
</body>
</html>
