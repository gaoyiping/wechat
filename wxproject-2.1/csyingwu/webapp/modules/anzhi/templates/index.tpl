<html>
<head>
<title>茶馆安置图</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="modpub/css/base.css" />
<link type="text/css" rel="stylesheet" href="modpub/css/boardview.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/yofoto.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
{literal}
<script type="text/javascript">
function fenxi(no){
  if (document.getElementById('fenxi')) {
    var url = 'index.php?module=BoardStatus&action=back&boardno='+no;
    ajax(url,function(text){
      document.getElementById('fenxi').style.display = 'none';
      document.getElementById('showFenXi').innerHTML = text;
    });
    document.getElementById('fenxi').innerHTML = 'Loading...';  
  }
}
</script>
{/literal}
</head>
<body>
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
                                &nbsp;<span class="Font_red Font_addbold">[茶馆管理]</span> >> 茶馆安置图
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%;padding:5px; height: auto !important; overflow: visible"
                            id="Div_Content">
			 
<br />

			    {$userlist_str}
			 
</DIV>
   
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
