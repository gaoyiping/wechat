<html>
<head>
<title>零售订单</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="modpub/css/base.css">

    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
<script type='text/javascript' src='modpub/js/calendar.js'> </script>
{literal}<script type="text/javascript">

function check(f){
    return confirm("您确认要提交到下一步吗？");
  }
</script>{/literal}

</head>
<body scroll="yes">
<div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        <script>
                                     
                        </script>

                        <div style="margin-top: -1px; height: 30px;  overflow: hidden" id="ctl00_Div_right_top"
                            class="YFTmainright_r1_c2_gj">
                            <div style="position: relative; line-height: 30px; width: 100%">
                                &nbsp;<span class="Font_red Font_addbold">[进销存管理]</span> >> 产品订购 >> 第二步 <font color="red">（确认产品订购单）</font>
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:35px;border-left:solid 0px;border-right:solid 0px;padding-top:5px;">
<font color="red"> &nbsp;*温馨提示：</font> 请确认您所选购的产品及物流信息的正确性,如产品订购信息有误请点上一步重新选购。
</div><br />
<form action="index.php?module=caigou&action=ok2" method="post" onsubmit="return check(this);">
 
                      	<table width="600" align="center" ><tr bgcolor="">
       
        <td align="center" colspan=6 style="height:30px;font-size:18px;">
	 <b>确认产品订购单</b>
	</td>
	</tr></table>
		<table width="598" align="center"  border="0" cellpadding="0" cellspacing="0" >
		
	<tr>
        {foreach from=$list item=item12 name=f2} {/foreach}
        <td align="left"  style="height:32px;font-size:14px;border-top:solid 1px #dedede;border-left:solid 1px #dedede;">
	 &nbsp;订单号:{$pinfo->sNo}
	</td>
	 <td align="right"  style="height:32px;font-size:14px;border-top:solid 1px #dedede;border-right:solid 1px #dedede;">
	 &nbsp;订货日期:{$pinfo->add_date}&nbsp;
	</td>
	
	</tr>
		<tr bgcolor="white">
       
        <td align="left" colspan=2 style="padding:15px; height:260px;border-top:solid 1px #dedede;font-size:14px;border-right:solid 1px #dedede;border-left:solid 1px #dedede;" valign="top">
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
       
        <td align="left"  style="height:32px;border-top:solid 1px #dedede;border-left:solid 1px #dedede;font-size:14px;">
	 &nbsp;收货人:<input type="text" name="post_name" id="post_name" value="{$pinfo->post_name}" style="border-top:solid 1px #ffffff;border-left:solid 0px #dedede;border-right:solid 0px #dedede;border-bottom:solid 1px #dedede;height:20px;font-size:14px;padding-top:3px;width:100px;"/>
	</td>
	  <td   style="height:32px;border-top:solid 1px #dedede;border-right:solid 1px #dedede;font-size:14px;padding-left:160px;">
	 联系电话:<input type="text" name="post_tel" id="post_tel" value="{$pinfo->post_tel}" style="border-top:solid 1px #ffffff;border-left:solid 0px #dedede;border-right:solid 0px #dedede;border-bottom:solid 1px #dedede;height:20px;font-size:14px;padding-top:3px;width:100px;"/>
	</td>
	</tr>
	<tr bgcolor="white">
       
        <td align="left"  style="height:27px;font-size:14px; border-top:solid 1px #dedede;border-left:solid 1px #dedede;border-bottom:solid 1px #dedede;">
	&nbsp;物流地址:<input type="text" name="post_address" id="post_address" value="{$pinfo->post_address}" style="border-top:solid 1px #ffffff;border-left:solid 0px #dedede;border-right:solid 0px #dedede;border-bottom:solid 1px #dedede;height:20px;font-size:14px;padding-top:3px;width:200px;"/>
	</td>
	<td style="height:27px;font-size:14px;padding-left:160px;border-top:solid 1px #dedede;border-right:solid 1px #dedede;border-bottom:solid 1px #dedede;" >
	总计金额:￥{$pinfo->emoneys}<input type="text" name="jine" id="jine" value="{$pinfo->emoneys}" style="display:none;"/><input type="text" name="sNo" id="sNo" value="{$pinfo->sNo}" style="display:none;"/>
	</td>
	
	
	
	</tr>

			  </table><br />
			   <div style="text-align:center;">
 <input type="button" value=" 上一步 " class="b02" onclick="window.location.href='index.php?module=caigou&delete=yes&sNo={$item2->rliushui}'"  >  <input type="submit" value=" 完成订购 " class="b02"  >
 </div>
                   
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
    <script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>
</html>
