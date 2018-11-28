<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>系统消息</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script language="javascript"  src="modpub/js/check.js"> </script>

    {literal}
        <script language="javascript">
            function show(obj){
                if(obj.value=='1'){
                    document.getElementById('txt').style.display = "";
                    document.getElementById('pic1').style.display = "none";
                    document.getElementById('pic2').style.display = "none";
                    document.getElementById('pic3').style.display = "none";
                    document.getElementById('desc').style.display = "none";
                }else{
                    document.getElementById('txt').style.display = "none";
                    document.getElementById('pic1').style.display = "";
                    document.getElementById('pic2').style.display = "";
                    document.getElementById('pic3').style.display = "";
                    document.getElementById('desc').style.display = "";
                }
            }
        </script>
    {/literal}

</head>


<body scroll="yes">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[微信配置]</a></li>
        <li><a href="#">添加新规则</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">


    <form name="form1" action="index.php?module=weixin&action=addkeyword"  method="post"  enctype="multipart/form-data" >
        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="80%">
            <tr><td>
                    <table width=100% class="tablelist_s" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                        <tr>
                            <th>添加新规则</th>
                        </tr>

                        <tr>
                            <td height="56" valign="top">
                                <table align="center" bgcolor="#DDDDDD" width="100%" border="0" cellpadding="5" cellspacing="1" >

                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">规则名称：</td>
                                        <td>
                                            <input name="name" value="" class="dfinput" type="text" style='width:500px;' />
                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">关键词(KEY值)：</td>
                                        <td>
                                            <input name="keyword" value="" class="dfinput" type="text" style='width:500px;' />
                                        </td>
                                    </tr>
                                    <tr  bgcolor="#FFFFFF" >
                                        <td width="98" align="right">消息类型：</td>
                                        <td>
                                            <input name="type" type="radio" value="1" checked="checked" onClick="show(this)"/>文字
                                            <input name="type" type="radio" value="2" onClick="show(this)"/>图文
                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF" id="txt">
                                        <td width="168" align="right">文字内容：</td>
                                        <td>
                                            <textarea name="contents" id="contents" style="width:580px;height:180px">{$system->lang_value}</textarea>
                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF"  id="pic1" style="display:none;">
                                        <td width="168" align="right">上传图片：</td>
                                        <td><input type="file" name="pic" id="pic" size="45"></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF"  id="pic2" style="display:none;">
                                        <td width="168" align="right">图片标题：</td>
                                        <td><input type="text" name="pic_tit" class="dfinput" value="" style='width:500px;' /></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF"  id="desc" style="display:none;">
                                        <td width="168" align="right">消息描述：</td>
                                        <td><textarea rows="8" cols="50" id="desc" name="desc" style="width:580px;height:180px"></textarea></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF"  id="pic3" style="display:none;">
                                        <td width="168" align="right">文章链接：</td>
                                        <td><input type="text" name="pic_url" class="dfinput" value="" style='width:500px;' /></td>
                                    </tr>


                                    <tr align="center" bgcolor="#FFFFFF">
                                        <td height="45" colspan="2">
                                            <input type="submit" name="Submit" value="提 交" class="scbtn">
                                            <input type="reset" name="reset" value="重 写"  class="scbtn">
                                        </td>
                                    </tr>
                        </thead>
                    </table>
                </td></tr>
            <tr>
                <td bgColor="#F2F2F2" height="1"></td>
            </tr>
        </table>
    </form>

</div>
<script language="javascript" src="/new_style/css/webjs.js"> </script>

</body>

</html>
