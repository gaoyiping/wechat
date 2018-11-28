<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>购物车清单</title>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<script type="text/javascript" src="modpub/js/check.js"> </script>
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<script type="text/javascript">
var baseurl = "index.php?module=RProduct&action=cartSet";
{literal}
function update(id,op)
{
  id = parseInt(id);
  var input = document.getElementById("cart_" + id + "_c");
  var c = parseInt(input.value);
  if (isNaN(id) || id <= 0 || isNaN(c) || c <= 0) { return; }
  if (op == '-') { c = c - 1; }
  if (op == '+') { c = c + 1; }
  if (c < 1 || c > 20) { alert("请选择 1-20 件有效！"); return; }
  var url = baseurl + "&do=update&id=" + id + "&count=" + c;
  ajax(url, function(data){
    var d = eval("(" + data + ")") ;
    if(d.result) { 
      input.value = d.rpro.count;
      document.getElementById("cart_" + id + "_m").innerHTML = d.rpro.money;
      document.getElementById("cart_counts").innerHTML = d.base.counts;
      document.getElementById("cart_moneys").innerHTML = d.base.moneys;
      document.getElementById("cart_emoneys").innerHTML = d.base.emoneys;
    } else { alert("操作失败！"); }
  });
}
function withinfo(id,checkin)
{
  id = parseInt(id);
  if (id <= 0) { return; }
  var withinfo = '0';
  if (checkin.checked) {  withinfo = '1'; }
  var url = baseurl + "&do=withinfo&id=" + id + "&withinfo=" + withinfo;
  ajax(url, function(data){
    var d = eval("(" + data + ")") ;
    if(! d.result) {  alert("操作失败！"); }
  });
}
function del(id)
{
  id = parseInt(id);
  if (id <= 0) { return; }
  var url = baseurl + "&do=del&id=" + id ;
  ajax(url, function(data){
    var d = eval("(" + data + ")") ;
    if(d.result) {
      var ttr = document.getElementById("_cart_line_" + id);
      ttr.parentNode.removeChild(ttr);
      document.getElementById("cart_counts").innerHTML = d.base.counts;
      document.getElementById("cart_moneys").innerHTML = d.base.moneys;
      document.getElementById("cart_emoneys").innerHTML = d.base.emoneys;
    } else { alert("操作失败！"); }
  });
}
function okbuy() 
{
  var cartt = document.getElementById("cart_table");
  if (!cartt) { return; }
  var carttlines = cartt.tBodies[0];
  if (carttlines.rows.length <= 0) {
    alert("还未选购商品，无法下单！");
    return ;
  }
  location.href='index.php?module=Order';;
}
{/literal}
</script>
</head>
<body>
<br/><div class="fontTop">购物车清单</div><hr/><br/>

<div style="border: 1px solid #B0D1EE;padding: 10px;margin: 10px;">
<table align="center" width="90%" border="0" bgcolor="#B0D1EE" border="0" cellpadding="0" cellspacing="0"><tr><td>
  <table width="100%" id="cart_table" border="0" cellpadding="5" cellspacing="2">
    <thead>
      <tr class="td3" height="25px">
        <td align="center"><strong>已放在购物车中的商品</strong></td>
        <td align="center"><strong>单价</strong></td>
        <td align="center"><strong>数量</strong></td>
        <td align="center"><strong>支付金额</strong></td>
        <td align="center" width="20px">&nbsp;</td>
      </tr>
    </thead>
    <tbody>
{foreach from=$cart->rpros item=item name=f1}
      <tr id="_cart_line_{$item->id}" bgcolor="#FFFFFF" height="35px">
        <td align="center">
          <a href="index.php?module=RProduct&action=view&id={$item->id}">{$item->pname}</a></td>
        <td align="center">{$item->cost}</td>
        <td align="center">
          <input class="b02" type="button" style="width:30px" value="减" onclick="update({$item->id},'-');"/>
          <input type="input" id="cart_{$item->id}_c" readonly value="{$item->count}"
            style="text-align:center;width:40px;"/>
          <input class="b02" type="button" style="width:30px" value="加" onclick="update({$item->id},'+');"/></td>
        <td align="center"><span id="cart_{$item->id}_m">{$item->money}</span></td>
        <td align="center">
          <input class="b02" type="button" value="删除" onclick="del({$item->id});"/></td>
      </tr>
{/foreach}
    </tbody>
    <tfoot>
      <tr bgcolor="#EBF4FB" height="30px">
        <td align="right">&nbsp;</td>
        <td colspan="4">
          本次合计：&nbsp;&nbsp;购买总数：<font color="red"><span id="cart_counts">{$cart->base.counts}</span></font>，
          总价：<font color="red">￥<span id="cart_moneys">{$cart->base.moneys}</span></font>，
          支付电子货币：<font color="red">￥<span id="cart_emoneys">{$cart->base.emoneys}</span></font></td>
      </tr>
    </tfoot>
  </table>
</td></tr></table>

<p><br/>  
  <input style="cursor: pointer;border:1px solid black;" type="button" 
    onclick="location.href='index.php?module=RProduct';" value="←继续购买"/>
  <input style="cursor: pointer;border:1px solid black;" type="button" 
    onclick="location.href='index.php?module=RProduct&action=cartView';" value="↔刷新购物车"/>
  <input style="cursor: pointer;border:1px solid black;" type="button" 
    onclick="location.href='index.php?module=RProduct&action=cartView&clear=true';" value="×清空购物车"/>
  <input style="cursor: pointer;background-color:red;color:white;" type="button" 
    onclick="javascript:okbuy();" value="确定购买"/> </p>
</div>

</body>
</html>
