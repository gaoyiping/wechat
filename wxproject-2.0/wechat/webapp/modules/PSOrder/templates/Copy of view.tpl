<html>
<head>
<title>零售订单</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="modpub/css/base.css">

    <link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
</head>
<body scroll="yes"  background="#ffffff">
<form name="form1" method="post">

 
                      	<table width="600" align="center" ><tr bgcolor="">
       
        <td align="center" colspan=6 style="height:30px;font-size:18px;">
	 <b>产品订购单</b>
	</td>
	</tr></table>
		<table width="598" align="center"  border="0" cellpadding="0" cellspacing="0" >
		
	<tr >
        {foreach from=$list item=item12 name=f2} {/foreach}
        <td align="left"  style="height:32px;font-size:14px;">
	 &nbsp;订单号:{$pinfo->sNo}
	</td>
	 <td align="right"  style="height:32px;font-size:14px;">
	 &nbsp;订货日期:{$pinfo->add_date}&nbsp;
	</td>
	
	</tr>
		<tr bgcolor="white">
       
        <td align="left" colspan=2 style="padding:15px; height:260px;border-top:solid 1px #dedede;font-size:14px;" valign="top">
	产品订购明细：<br />&nbsp;
	  <table border="0" cellpadding="3" cellspacing="0" width="98%" style="border-collapse: collapse;">
	     <tr>
           
              <td align="left" style="padding-left:20px;font-size:14px;">
	      <div>
	  {foreach from=$list item=item2 name=f1}
	
        
           <li style="float:left;width:265px;height:28px;">[{$item2->rsNo}] {$item2->rname} {$item2->rnum}{$item2->rdanwei} ￥{$item2->rnum*$item2->shoujia} </li>
        
          
	 
	  {/foreach}
	  </div>
	   </td>
          
            </tr>
          </table>
	
	</tr>
	
	</tr>
		<tr bgcolor="white">
       
        <td align="left"  style="height:32px;border-top:solid 1px #dedede;font-size:14px;">
	 &nbsp;收货人:{$pinfo->post_name}
	</td>
	  <td   style="height:32px;border-top:solid 1px #dedede;font-size:14px;padding-left:200px;">
	 联系电话:{$pinfo->post_tel}
	</td>
	</tr>
	<tr bgcolor="white">
       
        <td align="left"  style="height:27px;font-size:14px;">
	&nbsp;物流地址:{$pinfo->post_address}
	</td>
	<td style="height:27px;font-size:14px;padding-left:200px;" >
	总计金额:￥{$pinfo->emoneys}
	</td>
	
	
	
	</tr>

			  </table>
                   
</form>
   
</body>
</html>