<html>
<head>
<title>添加零售商品</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
</head>
{literal}
<script type="text/javascript">
function checkuid(){

  var url = "index.php?module=kucun&action=checkUser&bianhao=" + document.getElementById('tiaoma').value;
  
  if(document.getElementById('tiaoma').value == ''){
 
    document.getElementById('tiaoma').value = "";
    alert("产品编号或条形码未填写！");
  } else {

    ajax(url,function(text){
    arr=text.split("|");
     

     if(arr[0]=="no")
     {
       alert("产品编号或条形码不存在！")
     }
     else
     {
        document.getElementById('tiaoma').value = arr[1];
        document.getElementById('rsNo').value = arr[0];
	document.getElementById('rname').value = arr[2];
	document.getElementById('rdanwei').value = arr[3];
	document.getElementById('tname').value = arr[4];
        document.getElementById('typeID').value = arr[5];
	
     }

  
      
    });
  }
}
function check(f){	
  if(Trim(f.rname.value)==""){
    alert("您没有载入要入库的产品信息！");
    f.rname.value = '';
    return false;
  }



  return true;
}
 function AlertMessageBox(file_name)
    {

	        if (file_name!=undefined){
	            var ShValues = file_name.split('||');
	            if (ShValues[0]!=0)
	            {
	                document.getElementById("tiaoma").value=ShValues[0];
	            
	            }            
	        }
	         
    }
      function ShowDepartID()
        {
            showPopWin('选择产品','index.php?module=seleclchanpin', 500, 400, AlertMessageBox,true,true)
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
                                &nbsp;<span class="Font_red Font_addbold">[进销存管理]</span> >> 库存管理 >> 产品出库
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br /><br/>

<form action="index.php?module=kucun1&action=add" method="post" onsubmit="return check(this);" enctype="multipart/form-data">
  <table align="center"  border="0" cellpadding="0" cellspacing="0" width="90%">
  <tr><td>
  
      <td align="left">
      <table cellspacing="1" cellpadding="1" width="100%">
       <tr class="tdTitle" > 
      <td height="25" align="center" colspan=2> 
        <font color="#ffffff" > 产品出库 </font></td>
    </tr>
      

         <tr><td  class="table_body">编号/条码：</td> <td class="table_none">
	
           <input name="tiaoma" class="button1" type="text" style="width:140px;" value="{$tiaoma}"/>  <button onclick="ShowDepartID();" class="b02">选择产品</button> 
	   <input type="button" class="b02" value="载入信息" onclick="checkuid(this.value);" /> </td>
	</tr>
	<tr><td  class="table_body">商品编号：</td> <td class="table_none">
	
           <input class="button1" name="rsNo" type="text" style="width:140px;" readonly value="{$rsNo}"/></td>
	</tr>
	<tr><td  class="table_body">产品类别：</td> <td class="table_none">
	
           <input name="tname" class="button1" type="text" style="width:140px;ime-mode:disabled" readonly value="{$tname}"/> <input name="typeID" type="text" style="width:140px;ime-mode:disabled;display:none;"  /></td>
	</tr>
	  <tr><td  class="table_body">产品名称：</td> <td class="table_none">
	
           <input class="button1" name="rname" type="text" style="width:140px;ime-mode:disabled" readonly value="{$rname}"/> </td>
	</tr>
	  <tr><td  class="table_body">计量单位：</td> <td class="table_none">
	
           <input class="button1" name="rdanwei" type="text" style="width:140px;ime-mode:disabled" readonly value="{$rdanwei}"/> </td>
	</tr>
	   
	
	  <tr><td  class="table_body">出库数量：</td> <td class="table_none">
	
           <input name="rnum" type="text" style="width:60px;ime-mode:disabled" class="button1"  value="{$rnum}"/> </td>
	</tr>
        <tr><td  class="table_body">出库类型：</td> <td class="table_none">
	 <select id="rleixing" name="rleixing">
<option value='1' selectedIndex >产品损耗</option>
<option value='2'  >内部消耗</option>
<option value='3'  >退换货</option>
</select> </td>
	</tr>
	  <tr><td  class="table_body">备注：</td> <td class="table_none">
	 <input name='rbeizhu'   type="text" maxlength="30" style="width:200px;" value="{$rbeizhu}" class="button1" /> </td>
	</tr>

	
	</table>
        <p align="center"> 
          <input type="submit" value="提 交" class="b02">
          &nbsp;&nbsp;&nbsp; 
        
          <input type="button" value="返 回" class="b02" onclick="location.href='index.php?module=kucun1';">
        </p>
      </td>
    </tr>
  </table>
 
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

