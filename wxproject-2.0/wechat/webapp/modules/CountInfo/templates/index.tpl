<html>
<head>
<title>统计信息</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
</head>
<body>

<br/><div class="fontTop">信息统计</div><hr/><br/>

<table align="center" width="70%" border="1" cellpadding="0" cellspacing="0" bgcolor="#99FFFF">
  <tr><td align="center">
    <p style="padding:30px;font-size:14px;"><u>信息统计</u></p>
    <form name="form1" action="index.php?module=CountInfo" method="post">
      日期
      <input name="start" value="{$start}" size="8" readonly />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.start);" />
      至
      <input name="end" value="{$end}" size="8" readonly />
      <img src="modpub/images/datetime.gif" style="cursor:pointer;" onclick="new Calendar().show(document.form1.end);" />
      <input type="submit" class="b02" value="查询"/>
    </form>
    <table align="center" width="80%" border="0" bgcolor="#FFFFFF">
      <!--
      <tr><td height="25" bgcolor="#CCFFFF">报单总数：<strong>{$totals|default:'0'}</strong>单</td></tr>
      -->
      <tr>
        <td height="25"  bgcolor="#CCFFFF">销售会员：{$directlist} </td>
      </tr>
      <tr><td height="25" bgcolor="#CCFFFF">当周销售：<strong>{$weeks|default:'0'}</strong></td></tr>
      <!--
      <tr><td height="25" bgcolor="#CCFFFF">当月销售：<strong>{$months|default:'0'}</strong></td></tr>
      -->
      {php}
      $day = intval(date('d')); $hour = intval(date('H'));
      $this->assign('open', false);
      if ( ($day == 1 || $day % 10 == 6) && $hour == 19 ) $this->assign('open', true);
      {/php}
      {if $open == true}
      <tr><td height="25" bgcolor="#CCFFFF">销售查询：<strong>{$datebar|default:'0'}</strong></td></tr>
      {/if}
      <tr><td height="25" bgcolor="#CCFFFF">零售查询：<strong>￥{$retails|default:'0'}</strong></td></tr>
    </table>
    <p style="height:50px;"></p>
  </td></tr>
</table>

</body>
</html>
