<html>
<title>修改公告</title>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>
<script type="text/javascript" src="modpub/js/ajax.js"> </script>

{literal}
<script type="text/javascript">
function check(f){	
	if(Trim(f.admin_id.value)==""){
		alert("帐号不能为空!");
		f.admin_id.value = '';
		return false;
	}
  return true;
}

function checkcheck(id){
  var url = "index.php?module=member&action=ajax&id="+id;
  ajax(url,function(text){
     var array=eval(text);
     for(var i=0;i<array.length;i++){
     	document.getElementById(array[i]).checked=true;
     }
  });
  
}



</script>
{/literal}
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />


<body scroll="yes">

  <div class="place">
    <ul class="placeul">
        <li><a href="#">[系统管理]</a></li>
        <li><a href="#">管理员列表 >> 修改</a></li>
    </ul>
</div>


<div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br />
  
<form action="index.php?module=member&action=edit" method="post" onsubmit="return check(this)">
<input type="hidden" name="id" value="{$id}" />
  <table align="center"  border="0" cellpadding="0" cellspacing="0" width="90%">
  <tr><td>
  
      <td align="left">
      <table cellspacing="1" cellpadding="1" width="100%">
       <tr class="tdTitle" > 
      <td height="25" align="center" colspan=2> 
        <font > 修改人员 </font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
       <td  class="table_body">帐号：</td> <td class="table_none"> <input name="admin_id"  class="button1"  type="text" id="title"  value="{$id}" style="width:260px;" /></td>
  	</tr>
   <tr bgcolor="#FFFFFF">
       <td  class="table_body">一级密码：</td> <td class="table_none"> <input name="first_pwd"  class="button1"  type="text" id="title"   style="width:260px;" /> *留空不修改</td>
  	</tr>
  	<tr bgcolor="#FFFFFF">
       <td  class="table_body">二级密码：</td> <td class="table_none"> <input name="second_pwd"  class="button1"  type="text" id="title"   style="width:260px;" /> *留空不修改</td>
  	</tr>
  	
  	<tr>
  	<td></td>
  	</tr>
  </table>
  
  
  
  
  <table cellspacing="1" cellpadding="1" width="100%">
       <tr class="tdTitle" > 
      <td height="25" align="center" colspan=2> 
        <font >权限分配</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
       <td  class="table_body">店铺管理：</td>
       <td class="table_none">
        <input type="checkbox" name="permission[]"  value="CertifiedUserList" id='CertifiedUserList' /> 已开通店铺查询  
        <input type="checkbox" name="permission[]"  value="tuijian" id='tuijian' /> 推荐关系图 
        <input type="checkbox" name="permission[]"  value="CaiWu" id='CaiWu' /> 店铺帐户状况  
        <input type="checkbox" name="permission[]"  value="salary" id='salary' /> 工资表
        <input type="checkbox" name="permission[]"  value="TiXianmember" id='TiXianmember' /> 提现处理
        <input type="checkbox" name="permission[]"  value="nochizhi"  id='nochizhi' /> 购物币充值
       </td>
    </tr>
   <tr bgcolor="#FFFFFF">
       <td  class="table_body">微信配置：</td>
       <td class="table_none">
       <input type="checkbox" name="permission[]"  value="weixin" id='weixin' /> 微信配置
       </td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
       <td  class="table_body">进销存：</td>
       <td class="table_none">
       <input type="checkbox" name="permission[]"  value="ProductType" id='ProductType' /> 产品分类管理
       <input type="checkbox" name="permission[]"  value="RProduct"  id='RProduct' /> 产品信息管理
       <input type="checkbox" name="permission[]"  value="HandleOrder" id='HandleOrder' /> 发货单管理
       </td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
       <td  class="table_body">综合管理：</td>
       <td class="table_none">
       <input type="checkbox" name="permission[]"  value="QueryNotice"  id='QueryNotice' /> 公告管理
       <input type="checkbox" name="permission[]"  value="Message" id='Message' /> 系统消息
       <input type="checkbox" name="permission[]"  value="UpdatePwd" id='UpdatePwd' /> 密码修改
       <input type="checkbox" name="permission[]"  value="bochu"  id='bochu' /> 综合统计
       <input type="checkbox" name="permission[]"  value="FinanceLog" id='FinanceLog'  /> 财务记录
       <input type="checkbox" name="permission[]"  value="log"  id='log' /> 登录日志
       <input type="checkbox" name="permission[]"  value="zblog"  id='zblog' /> 转币日志
       </td>
    </tr>

    <tr bgcolor="#FFFFFF">
       <td  class="table_body">新闻管理：</td>
       <td class="table_none">
       <input type="checkbox" name="permission[]"  value="newsclass"  id='newsclass' /> 新闻分类管理
       <input type="checkbox" name="permission[]"  value="newslist" id='newslist' /> 新闻列表管理
       <input type="checkbox" name="permission[]"  value="guanggao" id='guanggao' /> 广告位管理
       </td>
    </tr>
    
    <tr>
    <td></td>
    </tr>
  </table>

  
   <p align="center"> 
          <input type="submit" name="Submit" value="修 改" class="b02">
          &nbsp;&nbsp;&nbsp; 
        <input type="button" name="Submit2" value="返 回" class="b02" onclick="window.location.href='index.php?module=member';">
        </p>
  </td></tr></table>
</form>

 </div>
                    </td>
                </tr>
                <tr>
                    <td class="YFTmainright_r3_c2_gj" height="1">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>checkcheck('{$id}');</script>
    
</body>
</html>
