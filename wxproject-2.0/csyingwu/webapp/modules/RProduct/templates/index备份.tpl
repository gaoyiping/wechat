<html>
<head>
<title>产品管理</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
</head>
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
                                &nbsp;<span class="Font_red Font_addbold">[进销存管理]</span> >> 产品管理
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">

<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="RProduct" />

<table width=95% border=0 align="center">
  <tr><td>
    产品关键字
      <input type='text' name='keyword' size='10' value="{$keyword}" class="button1" />
    &nbsp;&nbsp;启用状态<select id="isdelete" name="isdelete">
    <option value='' {if $isdelete==""}selected{/if}  >全部</option>
<option value='0' {if $isdelete=="0"}selected{/if} >启用</option>
<option value='1' {if $isdelete=="1"}selected{/if} >禁用</option>

</select>

     <input type="submit" value="查 询" class="b02">  <input type="button" class="b02" value="添加新产品" onclick="location.href='index.php?module=RProduct&action=add';" />

  </td></tr>
</table>
</form></div>
<br />
<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3"> 
     <td width="3%" align="center">序</td>
     <td width="10%"><div align="center"><font color="#FFFFFF">产品编号</font></div></td>

      <td width="15%"><div align="center"><font color="#FFFFFF">产品名称</font></div></td>
       <td width="12%"><div align="center"><font color="#FFFFFF">规格</font></div></td>
      <td width="6%"><div align="center"><font color="#FFFFFF">起订数</font></div></td>
      <td width="8%"><div align="center"><font color="#FFFFFF">价格</font></div></td>
        
	  <td width="8%"><div align="center"><font color="#FFFFFF">PV值</font></div></td>
	  <td width="8%"><div align="center"><font color="#FFFFFF">利润</font></div></td>
	        <td width="7%"><div align="center"><font color="#FFFFFF">状态</font></div></td>
      <td width="11%"><div align="center"><font color="#FFFFFF">添加时间</font></div></td>
      <td width="13%"><div align="center"><font color="#FFFFFF">操作</font></div></td>
    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr class="td4"> 
    <td align="center">{$smarty.foreach.f1.iteration}</td>
     <td> 
        <div align="center">{$item->sNo}</div></td>

      <td> 
        <div align="center">{$item->pname}</div></td>
	  <td> 
        <div align="center">{$item->guige}</div></td>
      
  <td>
        <div align="center">{$item->qidingnum}</div></td>
	 <td>
        <div align="right">￥{$item->zhuanmaijia}</div></td>
	 
	 <td>
        <div align="right">{$item->jifen} PV</div></td>
     <td>
        <div align="right">￥{$item->lirun}</div></td>
        
	  <td>
        <div align="center">{ if $item->isdelete==1 }<font color="red">禁用</font>{else}启用{/if}</div></td>
      <td >
        <div align="center">{$item->add_date|date_format:'%Y-%m-%d'}</div></td>
      <td>
        <div align="center">
          <a href="index.php?module=RProduct&action=edit&id={$item->id}">修改</a>  |
        {if $item->is_del=='1'}
          <span style="color:red;">已删</span>
        {else}
          <a href="index.php?module=RProduct&action=del&id={$item->id}" onclick="return confirm('确定要删除此零售产品吗?')">删除</a>
        {/if}          
        </div></td>
    </tr>
    {/foreach}
  </table>
</td></tr></table>
<br/>
<table align="center"><tr><td>
	{$pagehtml}
</td></tr></table>

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
