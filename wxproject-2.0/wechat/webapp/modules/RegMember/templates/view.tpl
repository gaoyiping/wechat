<html>
<head>
<title>茶馆详细信息</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link type="text/css" rel="stylesheet" href="modpub/css/base.css"/>



</head>
<body background="#ffffff" scroll="yes">

<br />
<form name="form1" method="post">
  

<table width="96%" align="center"  border="0" cellpadding="1" cellspacing="1" >
		

  
   <tr>
	    <td class="table_body table_body_NoWidth">店铺编号：</td>
	    <td class="table_none table_none_NoWidth">{$userinfo->user_id}
	   </td>

	  

  </tr>
  
  <tr>
	  <td   class="table_body table_body_NoWidth">推荐编号：</td>
	    <td class="table_none table_none_NoWidth">
	     {$userinfo->tuijian}
	  </td>

  </tr>
  
  <tr>
      <td class="table_body table_body_NoWidth">店铺名称：</td>
    <td class="table_none table_none_NoWidth">
   {$userinfo->user_name}
    </td>
  
  </tr>
  <tr>
    <td   class="table_body table_body_NoWidth">会员类型：</td>
    <td class="table_none table_none_NoWidth">
    
	<font color="#116600">{if $userinfo->uplevel==0} 微会员{/if}</font>
	<font color="#1166FF">{if  $userinfo->uplevel==1} 县级代理{/if}</font>
	<font color="#966F12">{if $userinfo->uplevel==2} 市级代理{/if}</font>
	<font color="#C40D74">{if  $userinfo->uplevel>=3} 省级代理{/if}</font>
	
      </td>
  
   
  </tr>
  <tr>
      <td class="table_body table_body_NoWidth">联系电话：</td>
    <td class="table_none table_none_NoWidth">{$userinfo->mobile}
    </td>
   </tr>
  <tr>
    <td   class="table_body table_body_NoWidth">联系人：</td>
    <td class="table_none table_none_NoWidth">
     {$userinfo->e_mail}
      </td>
  
  </tr>
 
  <tr>
    <td   class="table_body table_body_NoWidth">所在区域：</td>
    <td class="table_none table_none_NoWidth">
    {$userinfo->s1}{$userinfo->s2}{$userinfo->s3}
    </td>
  
   
  </tr>
  
   
       <tr>
      <td class="table_body table_body_NoWidth">物流地址：</td>
    <td class="table_none table_none_NoWidth" >
    {$userinfo->address}</td>

     
  </tr>


			  </table>
			  <br />
      
   



</form>
<DIV align="center" id="dayinDiv" name="dayinDiv"><input type="button" class="b02" value=" 关闭 " onclick="window.parent.hidePopWin(true);" />
</DIV>
</body>
</html>
