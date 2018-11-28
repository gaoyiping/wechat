<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>会员列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="modpub/js/ajax.js"> </script>
    <script type="text/javascript" src="/FineMessBox/js/common.js"></script>
    <script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
    <script type="text/javascript" src="/new_style/js/jquery.js"></script>

</head>

{literal}
    <script type="text/javascript">
        function AlertMessageBox()
        {



        }
        function Showopen(f)
        {

            showPopWin('还原数据库,请不要关闭这个窗口!',"index.php?module=backup&action=callback&file="+f, 800, 400, AlertMessageBox,true,true);
        }

        function backup(){
            var url = "index.php?module=backup&action=backup";
            document.getElementById("bck").value="备份中...";
            document.getElementById("bck").disabled="disabled";
            ajax(url,function(text){
                alert("备份成功!");
                window.location.reload();
            });

        }

    </script>
{/literal}

<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[系统管理]</a></li>
        <li><a href="#">数据备份</a></li>
    </ul>
</div>

<div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
     id="Div_Content">


    <table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="99%">
        <tr><td>
                <table width=100% class="tablelist" cellpadding="5" cellspacing="1" border="0">
                    <thead>
                    <tr>
                        <th>序</th>
                        <th>备份文件</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$nodes item=item name=f1}
                        <tr class="td4">
                            <td>
                                <div align="center">{$smarty.foreach.f1.iteration}</div></td>
                            <td>
                                <div align="center"><font color="#FF0000">{$item}</font></div></td>

                            <td>
                                <div align="center">
                                    
                                </div></td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </td></tr>
    </table>
    <br />
    <table align="center"  border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td><input id="bck" type="button" class="scbtn" value="备份"  onclick="backup()" /></td></tr></table>

</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>

</html>
