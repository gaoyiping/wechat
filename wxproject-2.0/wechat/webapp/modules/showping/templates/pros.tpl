<html>
<head>
<title>零售商品</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />
{literal}<script type="text/javascript">
function choose()
{
  var cs = document.getElementsByName("proid");
  var proid = "0";
  for (var i=0; i < cs.length; i++) {
    if (cs[i].checked == true) { proid = cs[i].value; break; }
  }
  window.returnValue = proid;
  if (proid != "0") { window.close(); }
  else {    
    if (confirm("你没有选择任何商品，确定将关闭窗口，确定吗？")) { window.close(); }
  }
}
</script>{/literal}
</head>
<body >
<base target="_self" />

 <div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        <script>
                                     
                        </script>

                        <div style="margin-top: -1px; height: 30px;  overflow: hidden" id="ctl00_Div_right_top"
                            class="YFTmainright_r1_c2_gj">
                            <div style="position: relative; line-height: 30px; width: 100%">
                                &nbsp;添加自购商品
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br/>

<table align="center" width="90%" border="0" bgcolor="#B0D1EE" border="0" cellpadding="0" cellspacing="0"><tr><td>
  <table width="100%" border="0" cellpadding="2" cellspacing="1">
    <tr class="td3" height="25px">
      <td align="center">选择</td>
      <td align="center">商品名称</td>
      <td align="center">单价</td>
    </tr> 
{foreach name=f1 from=$list item=item}
    <tr bgcolor="#FFFFFF">
      <td align="center"><input type="radio" name="proid" value="{$item->id}" /></td>
      <td align="center" >{$item->pname}</td>
      <td align="center" >{$item->cost}</td>
    </tr>
{/foreach}
  </table>
</td></tr></table>

<table align="center"><tr><td>{$pagehtml}</td></tr></table>

<br/>
<p style="text-align:center;">
  <input class="button1" type="button" value=" 确 定 " onclick="choose();"/></p>
<br />
</div>
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
   
</body>
</html>
