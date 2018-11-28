<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
</head>
{literal}
<script type="text/javascript">
  function AlertMessageBox(file_name)
    {

	        if (file_name!=undefined){
	            var ShValues = file_name.split('||');
	            if (ShValues[1]!=0)
	            {
	                document.getElementById("groupname").value=ShValues[0];
	                document.getElementById("groupID").value=ShValues[1];
			document.getElementById("ygroupID").value=ShValues[2];
			document.getElementById("sgroupID").value=ShValues[3];
                         document.getElementById('divname').innerHTML = "";
			document.getElementById("btype").disabled=false;
	            }            
	        }
	         
    }
      function ShowDepartID()
        {
            showPopWin('选择所在地区','index.php?module=seleclgroup', 240, 320, AlertMessageBox,true,true)
        }

	function ok()
	{
		if(document.getElementById("btype").value==3)
		 {
		       var url = "index.php?module=danbao&action=get&GroupID=" + document.getElementById("sgroupID").value;
			 
			 ajax(url,function(text){
		      document.getElementById('divname').innerHTML = text;
			});
		  }
		 else if(document.getElementById("btype").value==1)
		 {
		       var url = "index.php?module=danbao&action=get&GroupID=" + document.getElementById("ygroupID").value;
			 
			 ajax(url,function(text){
		      document.getElementById('divname').innerHTML = text;
			});
		  }
		  else
		  {
		    document.getElementById('divname').innerHTML = "";
		  }
		  
	}
</script>
{/literal}
<link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />
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
                                &nbsp;<span class="Font_red Font_addbold">[店铺管理]</span> >> 销售员管理
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content">
<form action="index.php?module=danbao&action=set" method="post" name="form1" onsubmit="return check(this);" enctype="multipart/form-data">
<input type="hidden" name="module" value="danbao" />
<input type="hidden" name="id" value="{$userID}" />
<br />

<table width="80%" border=0 align="center">
  <tr><td class="table_body">
     账号：{$userID}&nbsp;&nbsp;&nbsp;&nbsp;姓名：{$name}&nbsp;&nbsp;&nbsp;&nbsp;岗位：{if $btype=="0"}业务员{/if} 
	{if $btype=="1"}主管{/if}
	{if $btype=="2"}经理{/if}
	{if $btype=="3"}部长{/if}
        {if $btype=="4"}总监{/if}
	{if $btype=="5"}其他{/if} {$bshuoming}
  </td></tr>
   <tr><td class="table_body">
    <input name='groupname' type="text" class="button1"  readonly style="width:140px;" value="">
	    <input name='groupID' style="display:none;"  type="text" class="button1" ><input name='ygroupID' type="text" style="display:none;"  class="button1" >
	    <input name='sgroupID' type="text"  class="button1"  style="display:none;" ><button onclick="ShowDepartID();">选择</button>
&nbsp; <select name="btype" disabled onchange="ok();">
 <option  value="" selected>
==岗位==
 </option>
 
 <option  value="0">
 业务员
 </option>
  <option  value="1">
 主管
 </option>
   <option  value="2">
 经理
 </option>
    <option  value="3">
 部长
 </option>
    <option  value="4">
 总监
 </option>
    <option  value="5">
 其他
 </option>
 </select> 
    <div id="divname"></div>
  </td></tr>
</table>
 <p align="center"> 
          <input type="submit" value="提 交" class="b02">
          &nbsp;&nbsp;&nbsp; 
        
          <input type="button" value="返 回" class="b02" onclick="location.href='index.php?module=danbao';">
        </p> <br />&nbsp;
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

