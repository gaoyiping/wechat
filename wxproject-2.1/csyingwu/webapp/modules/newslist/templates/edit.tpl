<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>修改新闻</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="modpub/js/check.js" > </script>

    {literal}
        <script type="text/javascript">
            function check(f){
                if(Trim(f.news_title.value) == "" ){
                    alert('新闻标题不能为空！');
                    return false;
                }
            }

        </script>
    {/literal}

</head>


<body scroll="yes">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[新闻管理]</a></li>
        <li><a href="#">新闻列表管理</a></li>
        <li><a href="#">修改新闻</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">


    <form name="form1" action="index.php?module=newslist&action=edit"  method="post" onsubmit="return check(this);"  enctype="multipart/form-data" >
        <input type="hidden" name="id" value="{$id}" />
        <input type="hidden" name="editable" value="true" />
        <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="80%">
            <tr><td>
                    <table width=100% class="tablelist_s" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                        <tr>
                            <th>修改新闻</th>
                        </tr>

                        <tr>
                            <td height="56" valign="top">
                                <table align="center" bgcolor="#DDDDDD" width="100%" border="0" cellpadding="5" cellspacing="1" >

                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">新闻标题：</td>
                                        <td>
                                            <input name="news_title" value="{$news_title}" type="text" style='width:360px; height:26px;' />
                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">新闻类别：</td>
                                        <td>
                                            <select id="ctype" name="ctype" style="height:24px;">
                                                <option selected="selected" value="0">请选择类别</option>
                                                {foreach from=$ctypes item=item name=f1}
                                                    <option  value="{$item->id}"
                                                            {if $item->id == $ctype} selected="selected"
                                                            {else}{/if}>{$item->name_class}
                                                    </option>
                                                {/foreach}
                                            </select>

                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">排序号：</td>
                                        <td>
                                            <input name="sort" value="{$sort}" class="dfinput" type="text" style='width:60px;height:24px;' />
                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF">
                                        <td width="98" align="right">新闻图片：</td>
                                        <td>
                                            <input type="file" name="imgURL" class="button1" style="height:30px;"  accept="upload_image/x-png,image/gif,image/jpeg">  <font style="color:red">注意图片名称请不要带中文。</font>
                                        </td>
                                    </tr>

                                    <tr bgcolor="#FFFFFF">
                                        <td  width="98" align="right">新闻内容：</td>
                                        <td>
                                            {php}
                                                $fckroot = './fckeditor/';
                                                include($fckroot . 'fckeditor.php');
                                                $fck = new FCKeditor('content') ;
                                                $fck->BasePath = $fckroot;
                                                $fck->ToolbarSet = 'Default';
                                                $fck->Height='350px';
                                                $fck->Value=$this->_tpl_vars['content'];
                                                $fck->Create();
                                            {/php}
                                        </td>
                                    </tr>


                                    <tr align="center" bgcolor="#FFFFFF">
                                        <td height="45" colspan="2">
                                            <input type="submit" name="submit" value="提 交" class="scbtn">
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
