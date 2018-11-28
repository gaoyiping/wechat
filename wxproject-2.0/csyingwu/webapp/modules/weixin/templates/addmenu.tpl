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
                if(obj.value=='0'){
                    document.getElementById('weixin_view').style.display = "";
                    document.getElementById('weixin_click').style.display = "none";
                }else{
                    document.getElementById('weixin_view').style.display = "none";
                    document.getElementById('weixin_click').style.display = "";
                }
            }
        </script>

    {/literal}

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[微信配置]</a></li>
        <li><a href="#">添加新菜单</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">




    <form name="form1" action="index.php?module=weixin&action=addmenu"  method="post" >
        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="80%">
            <tr><td>
                    <table width=100% class="tablelist_s" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                        <tr>
                            <th>添加新菜单</th>
                        </tr>

                        <tr>
                            <td height="56" valign="top">
                                <table align="center" bgcolor="#DDDDDD" width="100%" border="0" cellpadding="5" cellspacing="1" >


                                    <tr bgcolor="#FFFFFF">
                                        <td width="168" align="right" >上级菜单</td>
                                        <td>
                                            <select name="parent_id"  >
                                                <option value="0">顶级菜单</option>
                                                {foreach from=$parent_menu item=item name=f1}
                                                    <option value="{$item->cat_id}">{$item->cat_name}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">菜单名称：</td>
                                        <td>
                                            <input name="cat_name" value="{$cat.cat_name|escape}" class="dfinput" type="text" style='width:360px;' />
                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">排序：</td>
                                        <td>
                                            <input name="sort_order" {if $cat.sort_order}value='{$cat.sort_order}'{else} value="5"{/if} class='dfinput' type="text" style='width:240px;'  />
                                        </td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF">
                                        <td class="label"  align="right" >菜单动作类型:</td>
                                        <td>
                                            <input type="radio" name="weixin_type" value="0" {if $cat.weixin_type eq 0} checked="true"{/if}  onClick="show(this)" /> click类型
                                            <input type="radio" name="weixin_type" value="1" {if $cat.weixin_type eq 1} checked="true"{/if}  onClick="show(this)" /> view类型
                                        </td>
                                    </tr>

                                    <tbody id="weixin_view" {if $cat.weixin_type eq 1}style="display:none"{/if}>
                                    <tr bgcolor="#FFFFFF" >
                                        <td class="label"  align="right"  >(关键词)KEY值:</td>
                                        <td><input type="text" name="weixin_key" class='dfinput' maxlength="60" style='width:420px;' value="{$cat.weixin_key|escape}" /></td>
                                    </tr>
                                    </tbody>

                                    <tbody id="weixin_click" {if $cat.weixin_type eq 0}style="display:none"{/if}>
                                    <tr bgcolor="#FFFFFF">
                                        <td class="label"  align="right" >链接URL:</td>
                                        <td><input type="text" name="links"  class='dfinput' style='width:600px;' value="{$cat.links|escape}" /></td>
                                    </tr>
                                    </tbody>

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
