<html>
<head>
<title>添加仓库</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>

{literal}
<script type="text/javascript">
function check(f){
  if(Trim(f.csNO.value)==""){
    alert("仓库编号不能为空！");
    f.csNO.value = '';
    return false;
  }
  if(Trim(f.cname.value)==""){
    alert("仓库名不能为空！");
    f.cname.value = '';
    return false;
  }


  return true;
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
                                &nbsp;<span class="Font_red Font_addbold">[管理中心]</span> >> 仓库管理 >> 添加仓库
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br /><br/>

<form action="index.php?module=cangku&action=add" method="post" onsubmit="return check(this);">
  <table align="center"  border="0" cellpadding="0" cellspacing="0" width="90%">
  <tr><td>
  
      <td align="left">
      <table cellspacing="1" cellpadding="1" width="100%">
       <tr class="tdTitle" > 
      <td height="25" align="center" colspan=2> 
        <font color="#ffffff" > 添加仓库 </font></td>
    </tr><tr>
        <td class="table_body">
        仓库编号：</td>   <td  class="table_none">
          <input name="csNo" type="text" style="width:200px" value="{$csNO}"/></td> </tr>
        <tr>
	<tr>
        <td class="table_body">
        仓库名称：</td>   <td  class="table_none">
          <input name="cname" type="text" style="width:200px" value="{$cname}"/></td> </tr>
       
	  </table>
        <p align="center" style="padding-top:10px;"> 
          <input type="submit" value="提 交" class="b02">
          &nbsp;&nbsp;&nbsp; 
          <input type="reset"  value="重 填" class="b02">
          &nbsp;&nbsp;&nbsp; 
          <input type="button" value="返 回" class="b02" onclick="location.href='index.php?module=cangku';">
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
