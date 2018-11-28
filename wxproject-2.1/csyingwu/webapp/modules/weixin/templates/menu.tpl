<html>
<head>
<title>系统消息</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/General.css" />
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />

<script type="text/javascript" src="/treeTable/jquery.js"></script>
<script src="/treeTable/jquery.treeTable.js" type="text/javascript"></script>
{literal}
<style type="text/css">
        table,td,th {  border: 1px solid #cccccc; padding:5px; border-collapse: collapse; }
</style>
        
 <script type="text/javascript">
        $(function(){
            var option = {
                theme:'vsStyle',
                expandLevel : 2,
                beforeExpand : function($treeTable, id) {
                    //判断id是否已经有了孩子节点，如果有了就不再加载，这样就可以起到缓存的作用
                    if ($('.' + id, $treeTable).length) { return; }
                    //这里的html可以是ajax请求
                    var html = '<tr id="8" pId="6"><td>5.1</td><td>可以是ajax请求来的内容</td></tr>'
                             + '<tr id="9" pId="6"><td>5.2</td><td>动态的内容</td></tr>';

                    $treeTable.addChilds(html);
                },
                onSelect : function($treeTable, id) {
                    window.console && console.log('onSelect:' + id);
                    
                }

            };

            option.theme = 'default';
            $('#treeTable2').treeTable(option);
        });
</script>
{/literal}        
</head>
<body scroll="yes">
    <div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">


                        
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content">
 <br />
<table width="100%" border="0" align="center">
  <tbody><tr>
  
  <td ><input type="button" onclick="window.location.href='index.php?module=weixin&action=addmenu'" value="添加菜单" class="b02"></td>

  </tr>
</tbody></table>

<form name="form1" action="index.php?module=weixin&action=regmsg"  method="post" >

<table id="treeTable2" style="width:100%">
  
                <tr>
                    <td >菜单名称</td>
                    <td >菜单类型</td>
                    <td >关键词</td>
                    <td >排序</td>
                    <td width="7%"><div align="center">操作</div></td>
                </tr><tbody>
                 {foreach from=$system item=item name=f1}
                <tr id="{$item->cat_id}" pId="{$item->parent_id}">
                    <td ><span controller="true">{$item->cat_name}</span></td>
                    <td >{if $item->weixin_type eq '0'}click类型{else}<font color=red>view类型</font>{/if}</td>
                    <td ><div style="width:300px;word-wrap: break-word;">{if $item->weixin_key}{$item->weixin_key|escape}{else}<font color=red>{$item->links}</font>{/if}</div></td>
                    <td >{$item->sort_order}</td>
                    <td><a href="index.php?module=weixin&action=editmenu&id={$item->cat_id}" >修改</a> | 
    <a href="index.php?module=weixin&action=deleteMenu&id={$item->cat_id}" onclick="return confirm('你确定要删除吗?')">删除</a></td>
                </tr>
                {/foreach}
               
               <tr>
                    <td colspan="5" align="center" ><input type="button" onclick="window.location.href='index.php?module=weixin&action=createmenu'" value="生成菜单" class="b02"></td></td>
                </tr>
                
                </tbody>
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
    </div></body>
</html>
