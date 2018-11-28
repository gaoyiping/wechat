/* $Id : common.js 4865 2007-01-31 14:04:10Z paulgao $ */

/* *
 * 添加商品到购物车 
 */
function addToCart(goodsId, cp, parentId)
{
  var goods        = new Object();
  var spec_arr     = new Array();
  var fittings_arr = new Array();
  var number       = 1;
  var formBuy      = document.forms['ECS_FORMBUY'];
  var quick		   = 0;

  if (formBuy)
  {

    if (formBuy.elements['number'])
    {
      number = formBuy.elements['number'].value;
    }

	quick = 1;
  }

  goods.quick    = quick;
  goods.id = goodsId;
  goods.number   = number;
  goods.parent   = (typeof(parentId) == "undefined") ? 0 : parseInt(parentId);

  Ajax.call('index.php?module=shop&action=addtocart', 'cp='+ cp +'&goods=' + $.toJSON(goods), addToCartResponse, 'POST', 'JSON');
}

/**
 * 获得选定的商品属性
 */
function getSelectedAttributes(formBuy)
{
  var spec_arr = new Array();
  var j = 0;

  for (i = 0; i < formBuy.elements.length; i ++ )
  {
    var prefix = formBuy.elements[i].name.substr(0, 5);

    if (prefix == 'spec_' && (
      ((formBuy.elements[i].type == 'radio' || formBuy.elements[i].type == 'checkbox') && formBuy.elements[i].checked) ||
      formBuy.elements[i].tagName == 'SELECT'))
    {
      spec_arr[j] = formBuy.elements[i].value;
      j++ ;
    }
  }

  return spec_arr;
}

/* *
 * 处理添加商品到购物车的反馈信息
 */
function addToCartResponse(result)
{
  if (result.error > 0)
  {
    // 如果需要缺货登记，跳转
    if (result.error == 2)
    {
      if (confirm(result.message))
      {
        //location.href = 'user.php?act=add_booking&id=' + result.goods_id + '&spec=' + result.product_spec;
		location.href = 'index.php?module=shop';
      }
    }
    
    else
    {
      alert(result.message);
    }
  }
  else
  {
    var cart_url = 'index.php?module=cart';

    if (result.ctype == '1')
    {
	  $("#buy_lay").show();
	  $("#buy_lay_frm").show();
	  $("#buy_lay_frm").css({"top":($(window).height()/2-70)+'px'});
    }else{
		location.href = cart_url;
	}
   
  }
}

/* *
 * 添加商品到收藏夹
 */
function collect(goodsId)
{
  Ajax.call('user.php?act=collect', 'id=' + goodsId, collectResponse, 'GET', 'JSON');
}

/* *
 * 处理收藏商品的反馈信息
 */
function collectResponse(result)
{
 //alert(result.message);
  $("#tihuan").html(result.message);
  $("#nologin").show();
}

/* *
 *  返回属性列表
 */
function getAttr(cat_id)
{
  var tbodies = document.getElementsByTagName('tbody');
  for (i = 0; i < tbodies.length; i ++ )
  {
    if (tbodies[i].id.substr(0, 10) == 'goods_type')tbodies[i].style.display = 'none';
  }

  var type_body = 'goods_type_' + cat_id;
  try
  {
    document.getElementById(type_body).style.display = '';
  }
  catch (e)
  {
  }
}