<html>
<head>
<title>零售商品</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<script type="text/javascript" src="modpub/js/check.js"> </script>
<script type="text/javascript">
var pre_view_name = "_rpro_pre_view";
var baseurl = "index.php?module=RProduct&action=cartSet";
{literal}
function resetPreView()
{
  var imgs = document.getElementsByName(pre_view_name);
  for (var i = 0; i < imgs.length; i++) {
    imgs[i].style.margin = '3px';
    imgs[i].align = 'left';
    if (imgs[i].height > 100) {
      imgs[i].width = parseInt(imgs[i].width * 100 / imgs[i].height);
      imgs[i].height = 100;
    }
  }
}
function add_cart(id)
{
  id = parseInt(id);
  if (isNaN(id) || id <=0 ) return;
  var url = baseurl + "&do=add&id=" + id;
  ajax(url, function(data){ 
    var d = eval("(" + data + ")") ;
    if (d.result) { alert("商品已存至购物车！"); } else { alert("操作失败！"); }
  });
}
{/literal}
</script>
</head>
<body>
<br/><div class="fontTop">零售商品目录表</div><hr/><br/>

<table align="center" width="80%" border="0" bgcolor="#B0D1EE" border="0" cellpadding="0" cellspacing="0"><tr><td>
  <table width="100%" id="cart_table" border="0" cellpadding="5" cellspacing="2">
    <tr class="td3" height="25px">
      <td align="center"><strong>序号</strong></td>
      <td align="center"><strong>商品名称</strong></td>
      <td align="center"><strong>单价</strong></td>
      <td align="center"><strong>商品介绍</strong></td>
      <td align="center"><strong>选购</strong></td>
    </tr>  
    {foreach from=$list item=item name=f1}
    <tr bgcolor="#FFFFFF" height="30px">
      <td align="center">{$smarty.foreach.f1.iteration}</td>
      <td align="center">{$item->pname}</td>
      <td align="center">{$item->cost}</td>
      <td align="center">
        [<a style="color: #228822" href="index.php?module=RProduct&action=view&id={$item->id}">产品说明</a>]
      </td>
      <td align="center">
        <input class="button1" style="cursor: pointer;" type="button" onclick="add_cart({$item->id});"
          value="放入购物车"/>
      </td>
    </tr>
    {/foreach}
  </table>
  <table align="center"><tr><td> {$pagehtml} </td></tr></table>
  <br/>
  <br/>
  <p style="text-align:right;">
    <input style="cursor:pointer;border:1px solid black;" type="button"
      onclick="location.href='index.php?module=RProduct&action=cartView';" value="查看购物车"/></p>
</td></tr></table>

</body>
</html>
