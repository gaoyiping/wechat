<html>
<head>
<title>零售订单</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
<script type="text/javascript" src="/new_style/css/yuGridViewText.js"></script>
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
{literal}
<script type="text/javascript">
function ok(number)
{
   if(number==1)
   {
      document.getElementById("dp2").style.display="none";
        document.getElementById("dp1").style.display="";
   }
   else
   {
      document.getElementById("dp1").style.display="none";
       document.getElementById("dp2").style.display="";
   }
}

    function AlertMessageBox()
    {         
    }
        function Showopen(cID)
        {
	
            showPopWin('促销活动详情',"index.php?module=cuxiao&action=detail&id="+cID, 620, 400, AlertMessageBox,true,true)
        }

	
        function Showopen1(userid)
        {
	
            showPopWin("店铺"+userid+"库存情况","index.php?module=userkucun&userid="+userid, 640, 400, AlertMessageBox,true,true)
        }

	    function sssAlertMessageBox(file_name)
	   {

	        if (file_name!=undefined){
	            var ShValues = file_name.split('||');
	            if (ShValues[0]!=0)
	            {
	                document.getElementById("tiaoma").value=ShValues[0];
	            
	            }            
	        }
	         
	 }

	function loadchanpin(file_name)
	{
	    var arr = file_name.split('||');
	   GetChooseGoods(arr[0],arr[1],arr[2],arr[3],arr[4],arr[6]);
	}
        function ShowDepartIDchanpin()
        {
            showPopWin('选择产品','index.php?module=yuseleclchanpin', 500, 400, loadchanpin,true,true)
        }


</script>
{/literal}
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
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
                                &nbsp;<span class="Font_red Font_addbold">[进销存管理]</span> >> 预订单管理 >> 审核订单
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">

<table width="98%" border=0 align="center">
  <tr><td>
   
店铺账号：{$pinfo->user_id}
    
  </td>
 </tr>
</table>

</div>
<form name="form1" method="post">
  <input type="text" name="sNo" value="{$pinfo->sNo}" style="display:none;">
    <input type="text" name="userid" value="{$pinfo->user_id}" style="display:none;">
    <input type="text" name="emoney" value="{$pinfo->emoneys}" style="display:none;">
    <input type="text" name="shengID" value="{$diqu->shengID}" style="display:none;">
    <input type="text" name="shiID" value="{$diqu->shiID}" style="display:none;">
                      	<table width="620" align="center" ><tr bgcolor="">
       
        <td align="center" colspan=6 style="height:30px;font-size:18px;">
	 <b>产品预订单</b>
	</td>
	</tr></table>
		<table width="618" align="center"  border="0" cellpadding="0" cellspacing="0" >
		
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
       
        <td align="left" colspan=2 style="padding:15px; {if $num<5}height:200px;{/if}border:solid 1px #dedede;font-size:14px;" valign="top">
	产品订购明细：<br />&nbsp;
	  <table border="0" cellpadding="3" cellspacing="0" width="98%" style="border-collapse: collapse;">
	     <tr>
           
              <td align="left" style="padding-left:20px;font-size:14px;">
	      <div>
	  {foreach from=$list item=item2 name=f1}
	
       
           <li style="float:left;width:275px;height:27px;">[{$item2->rsNo}] {$item2->rname} {$item2->rnum}{$item2->rdanwei} ￥{$item2->rnum*$item2->rjiage} </li>
   	 

	  {/foreach}
	  </div>
	   </td>
          
            </tr>
          </table>
	
	</tr>
	
	</tr>
		<tr bgcolor="white">
       
        <td align="left"  style="height:32px;font-size:14px;width:420px;">
	 &nbsp;收货人:{$pinfo->post_name}
	</td>
	  <td   style="height:32px;font-size:14px;padding-left:40px;">
	 联系电话:{$pinfo->post_tel}
	</td>
	</tr>
	<tr bgcolor="white">
       
        <td align="left"  style="height:27px;font-size:14px;">
	&nbsp;物流地址:{$pinfo->post_address}
	</td>
	<td style="height:27px;font-size:14px;padding-left:40px;" >
	总计金额:￥{$pinfo->emoneys}
	</td>
	
	
	
	</tr>

			  </table>

			  <div style="border-top:solid 1px #dedede;padding-top:10px;text-align:center;">
			  <div style="width:620px;text-align:left;">
			 <label><input type="radio" name="sex" id="sex1" value="0" onclick="ok(1);document.getElementById('sex3').value='0';" Checked/> 审核通过</label>
                      <label><input type="radio" name="sex" id="sex2" value="1" onclick="ok(2);document.getElementById('sex3').value='1';" /> 不同意 </label>
		      <input name="sex3" id="sex3"  value="0"  type="text"  class="button1" style="display:none;" />
		      &nbsp;&nbsp;&nbsp;<span style="display:none;" id="dp2">建议：<input name="yuanyin"  value="{$yuanyin}" size="65"  class="button1" />
		      </span>
		      <span  id="dp1">{if $cuxiao->cID!=""}系统检测有本地区有未截止的促销活动&nbsp;&nbsp;&nbsp;&nbsp;
		      <a href="#" onclick="Showopen('{$cuxiao->cID}')" >活动详情</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="ShowDepartIDchanpin();">添加活动赠品</a><br />
		 <br />
		   <div id="ctl00_ContentPlaceHolder1_UpdatePanel2">
                                                                                        <div style="width: 100%; overflow: hidden" class="prd_border">
                                                                                          <table bgcolor="#dedede" width="100%">
											<tr>
											<td width="50" align="center">序号</td>
											<td width="100" align="center">编号</td>
											<td width="200" align="center">产品名称</td>
											
											<td width="80" align="center">赠送</td>
											<td width="80" align="center">数量</td>
											<td width="80" align="center">操作</td>
											
											</tr>
											</table>
											  
                                                                                            <div style="border-bottom: #cccccc 1px solid; overflow-x: hidden; overflow-y: scroll;
                                                                                                width: 100%; height: 120px; word-break: break-all" class="Width_per100 AlgintoLeft">
                                                                                                <div id="ctl00_ContentPlaceHolder1_PanelProductList">
                                                                                               
											  <table width="600" border="0" cellpadding="2" cellspacing="1" id="SignFrame">
    
  </table>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div style="float: right">
                                                                                                赠送的产品会自动从公司库存减除,且不参与业绩计算
                                                                                            </div>
                                                                                        </div>
										
                                                                                        <input style="display: none" id="ctl00_ContentPlaceHolder1_btnAddPro" type="submit"
                                                                                            name="ctl00$ContentPlaceHolder1$btnAddPro">
                                                                                        <input style="display: none" id="ctl00_ContentPlaceHolder1_btnDelePro" type="submit"
                                                                                            name="ctl00$ContentPlaceHolder1$btnDelePro">
											      <input name='txtTRLastIndex' type='hidden' id='txtTRLastIndex' value="1" />
                                                                                    </div>  {/if} 
		 </span>
		
                                                                                
                                                                               
		      <div style="padding-top:10px;text-align:center;">
		      &nbsp;&nbsp;&nbsp;  <input type="submit" value="提 交" class="b02">  <input type="button" value="返 回" class="b02" 
		      onclick="location.href='index.php?module=yudingdan&ok=3';">
		      </div>

                   </div>
		  
</form>
<br />
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