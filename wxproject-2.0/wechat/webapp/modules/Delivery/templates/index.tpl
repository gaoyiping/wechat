<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
{literal}
<script type='text/javascript'>
function check(f,fprice){
  var prods = f.prodname;
  if ( !prods.length) prods = [prods];
  var c = 0;
  f.selproductname.value = '';
  for(var i = 0;i<prods.length;i++){
    if(prods[i].checked){
      if (f.selproductname.value == ''){
        f.selproductname.value = prods[i].value;
      }else{
        f.selproductname.value += "、" + prods[i].value;
      }
      c ++;
    }
  }  
  if(0 == c){
    alert('请选择礼品！！');
    return false;
  }
  if (fprice == 3900) {
    if (c > 2) { alert('你只能选择 2 种套装'); return false; }
    if (c == 1) { f.selproductname.value += "-2"; }
  } else {
    if (c > 1) { alert('你只能选择 1 种套装'); return false; }
  }  
  if(confirm('您确认提货 | ' + f.selproductname.value + ' | 吗?')){
    var inputs = f.getElementsByTagName("INPUT");
    for(var i=0;i<inputs.length;i++){
      if(inputs[i].type=='submit'){
        inputs[i].disabled = true; break;
      }
    }
    return true;
  }
  return false;
}
</script>
{/literal}
</head>
<body>

<br/><div class="fontTop" align="left">提货申请</div><hr/><br/>

<form action="index.php?module=Delivery" method='post' onsubmit="return check(this, {$fprice});">
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr><td width="100%" align="center">
    <table width="90%" border="0" cellspacing="1" cellpadding="1" style="table-layout:fixed;word-break:break-all;word-wrap:break-word;">
      <tr><td align="center" height="80px"><font size='5'><strong>提货申请</strong></font></td></tr>
      <tr><td><font size="3">{if $fprice == 3900}请选购礼品(<font color="red">可勾选2种套装，如果只勾选一个，则视为2份相同套装</font>){else}请选购礼品{/if}：</font></td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>
        <table border="0">
          {foreach from=$pros item=item}
          <tr>
            <td width="20px;">
              {if $fprice == 3900}
              <input type="checkbox" name="prodname" value="{$item->product_name}">              
              {else}
              <input type="radio" name="prodname" value="{$item->product_name}">
              {/if}
            </td>
            <td width="50px;" align="center">{$item->product_name}</td>
            <td>{$item->product_desc}</td>
          </tr>
          {/foreach}
        <input type='hidden' name = 'selproductname' value='' />
        </table>
      </td></tr>
      <tr><td>
        <p style="line-height:35px;text-indent:4em"><font size='4'>
          尊敬的会员 <strong><u>{$userinfo->user_name}&nbsp;</u></strong>
          ,您的收货姓名为 <strong><u>{$userinfo->card_name}&nbsp;</u></strong>
          ,您的收货地址为 <strong><u>{$userinfo->address}&nbsp;</u></strong>
          ,您的提货通知电话为 <strong><u>{$userinfo->mobile}&nbsp;</u></strong>
          ,请认真核对后确认提交! </font></p></td></tr>
      <tr><td>
        <p style="line-height:25px;color:red;font-size:14px;text-align:center">
          <br/>系统默认的收货姓名为银行开户名,
            如果上面所提示的资料有误,
            请在‘信息修改’中修改后再进行提交！<br/></p></td></tr>
      <tr><td align="center"><br/>
        <input class="button1" type="submit" style="font-size:15px;" 
          {if !$prod_ok} value=" 已提货 " disabled 
          {else}
            {if !$info_ok } value=" 请填写完整提货信息 " disabled 
            {else} value=" 确认提交 " {/if}
          {/if}/><br/><br/></td></tr>
    </table>
  </td></tr>
</table>

<p style="text-align:center;padding-top:20px;"><strong>个人提货情况</strong></p>
<table width="90%" border="1" cellspacing="0" cellpadding="4" align="center" style="table-layout:fixed;word-break:break-all;word-wrap:break-word;">
  <tr>
    <td width="8%"  align="center" bgcolor="#5EA5E6"><font color="#FFFFFF">收货姓名</font></td>
    <td width="22%"  align="center" bgcolor="#5EA5E6"><font color="#FFFFFF">地址</font></td>
    <td width="12%"  align="center" bgcolor="#5EA5E6"><font color="#FFFFFF">电话</font></td>
    <td width="10%"  align="center" bgcolor="#5EA5E6"><font color="#FFFFFF">提货礼品</font></td>
    <td width="18%"  align="center" bgcolor="#5EA5E6"><font color="#FFFFFF">申请时间</font></td>
    <td width="30%"  align="center" bgcolor="#5EA5E6"><font color="#FFFFFF">状态</font></td>
  </tr>
  {if $prodinfo != false}
  <tr>
    <td align=center>{$prodinfo->card_name}</td>
    <td>{$prodinfo->address}</td>
    <td align=center>{$prodinfo->tel}</td>
    <td align=center>{$prodinfo->product_name}</td>
    <td align=center>{$prodinfo->add_date}</td>
    <td align=center>
      {if $prodinfo->status == '1'}<font color="green">已于[{$prodinfo->replay_date}]处理</font>
      {else}<font color="red">处理中</font></td>{/if}
  </tr>
  {else}
  <tr align="center" bgColor=#FFFFFF><td colspan="6" align="center">
    <font color="red">空！</font></td></tr>
  {/if}  
</table>

<br/>
</body>
</html>
