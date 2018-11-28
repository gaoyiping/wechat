<html>
<head>
<title>复消录入</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
</head>
{literal}
<script type="text/javascript"><!--
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
/*
function check(f){	
  if(Trim(f.rname.value)==""){
    alert("您没有载入要入库的产品信息！");
    f.rname.value = '';
    return false;
  }



  return true;
}*/

function check(){

	var ownz_money = document.getElementById("ownz_money").value;
	var hmonth = document.getElementById("hmonth").value;
	if(hmonth.length == 0){
		alert("请填写月份");
		return false;
	}else{
		if(isNaN(hmonth) || hmonth<0 ){
			alert("请输入正确的月份");
			return false;
		}else if(parseInt(hmonth)*360 > parseInt(ownz_money) ){
			alert("你的注册金不足");
			return false;
		}else{
			return true;
		}
	}
		
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

--></script>
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
                                &nbsp;<span class="Font_red Font_addbold">[复消专区]</span> >> 复消录入
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br /><br/>

<form action="index.php?module=fuxiao&action=add" method="post" onsubmit="return check();" enctype="multipart/form-data">
  <table align="center"  border="0" cellpadding="0" cellspacing="0" width="90%">
  <tr><td>
  
      <td align="left">
      <table cellspacing="1" cellpadding="1" width="100%">
       <tr class="tdTitle" > 
      <td height="25" align="center" colspan=2> 
        <font color="#ffffff" > 复消录入 </font></td>
    </tr>
      

      
         <tr><td  class="table_body">月需要注册金值：</td> <td class="table_none">
	
           <input name="z_money" class="button1" type="text" style="width:140px;" value="360" readonly="readonly"/> 折算方式：360元/月/360pv   
           您当前拥有<span style="color: red">{$z_money}</span>注册金
           <input id="ownz_money" type="hidden" value="{$z_money}" />
	   </td>
	</tr>
	<tr><td  class="table_body">购买：</td> <td class="table_none">
	
           <input class="button1" id="hmonth" name="hmonth" type="text" style="width:140px;" value="{$hmonth}"/>月</td>
	</tr>


	 
	</table>
        <p align="center"> 
          <input type="submit" value="提 交" class="b02">
          &nbsp;&nbsp;&nbsp; 
        
          <input type="button" value="返 回" class="b02" onclick="location.href='index.php?module=kucun';">
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

