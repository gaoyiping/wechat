<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>公告</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[综合中心]</a></li>
        <li><a href="#">公告管理</a></li>
        <li><a href="#">查看公告</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content"><br />
    <br/><br/>

    <table width="90%" height="10px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EBF3FB" style="border:solid 1px #2D96F2">
        <tr>
            <td width="100%" valign="top">
                <p style="padding:10px;text-align:center;font-size:16px">公告内容</p>
                <table width="90%" height="200px" border="0" align="center" bgcolor="">
                    <tr>
                        <td align='center' bgcolor="" height="30px">
                            <big><strong>{$notice->title}</strong></big></td></tr>
                    <tr>
                        <td bgcolor="" valign="top">
                            <span style="line-height:20px;letter-spacing:1px;">{$notice->content}</span></td>
                    </tr>
                </table>
                <p align="center"><br/>
                    <input value="返回" class="scbtn" type="button" onclick="history.back();" /><br/>
                    &nbsp; </p>
            </td>
        </tr>
    </table>

    <tr>
        <td
                class="YFTmainright_r3_c2_gj" height="1">
        </td>
    </tr>

</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>

</html>
