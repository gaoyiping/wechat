<html>
<head>
<title>零售商品</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
<link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
{literal}
<script type="text/javascript">

</script>
{/literal}
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
                                &nbsp;<span class="Font_red Font_addbold">[会员管理]</span> >> 店铺管理
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><div style="border:solid 1px #dedede;width:100%;height:40px;border-left:solid 0px;border-right:solid 0px;">
<form name="form1" action="index.php" method="get">
<input type="hidden" name="module" value="danbao" />
<table width="95%" border=0 align="center">
  <tr><td>
     账号/姓名
      <input name="bname" value="{$dsNo}" size="8"  class="button1"/>
    级别
    <select id="btype" name="btype">
    <option value='' {if $btype==""}selected{/if}  >全部</option>
<option value='1' {if $btype=="1"}selected{/if} >会员店</option>
<option value='2' {if $btype=="2"}selected{/if} >加盟店</option>
<option value='3' {if $btype=="3"}selected{/if} >形象店</option>
</select>

   <input type="submit" value="查询"  class="b02" />   <input type="button" class="b02" value="添加店铺" onclick="location.href='index.php?module=danbao&action=add';" />
  </td><td align="right">
<p align="right">
 
</p>
  </td></tr>
</table>
</form>
</div><br/>

<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>
  <table border="0" cellpadding="5" cellspacing="1" width="100%">
    <tr class="td3"> 
         <td width="4%" align="center">序</td>
	   <td width="7%"><div align="center"><font color="#FFFFFF">账号</font></div></td>
      <td width="12%"><div align="center"><font color="#FFFFFF">店铺名称</font></div></td>
        <td width="8%"><div align="center"><font color="#FFFFFF">店铺类型</font></div></td>
        <td width="7%"><div align="center"><font color="#FFFFFF">归属店铺</font></div></td>

      <td width="30%"><div align="center"><font color="#FFFFFF">归属区域</font></div></td>
     
      <td width="7%"><div align="center"><font color="#FFFFFF">报单数</font></div></td>
       <td width="7%"><div align="center"><font color="#FFFFFF">注册时间</font></div></td>
      <td width="10%"><div align="center"><font color="#FFFFFF">操作</font></div></td>
    </tr>
    {foreach from=$rpros item=item name=f1}
    <tr class="td4"> 
        <td align="center">{$smarty.foreach.f1.iteration}</td>
	 <td> 
        <div align="center">{$item->bloginID}</div></td>
      <td> 
        <div align="center">{$item->bname}</div></td>
	 <td> 
        <div align="center">  <b>
	{if $item->btype=="1"}会员店{/if}
	{if $item->btype=="2"}加盟店{/if}
	{if $item->btype=="3"}形象店{/if}
        </b> </div></td>
      
   
    <td> 
        <div align="center">{$item->tuijiansNo}</div></td>
 
   
	 <td>
        <div align="left">{$item->shengname} {$item->shiname} {$item->xianname}</div></td>
    

	<td >
        <div align="center">{$item->danbaoshu}</div></td>
	<td >
        <div align="center">{$item->bpubdate|date_format:'%Y-%m-%d'}</div></td>
      <td>
        <div align="center">

          <a href="index.php?module=danbao&action=edit&id={$item->bID}">编辑</a>  
	  
        {if $item->bisdel=='1'}
         | <span style="color:red;">已删</span>
        {else}
	  {if $item->danbaoshu==0}
         | <a href="index.php?module=danbao&action=del&id={$item->bID}" onclick="return confirm('确定要删除此销售员吗?')">删除</a>
	  {else}
	 | <a style="color:#b2b2b2">删除</a>
	  {/if}
        {/if}     
	|
	{if $item->bsuoding=='1'}
        <a style="color:red;" href="index.php?module=danbao&action=suoding&id={$item->bloginID}&is_suoding=0" onclick="return confirm('确定要给此业务员解锁吗?')">解锁</a>

        {else}
                 <span style="color:red;"><a href="index.php?module=danbao&action=suoding&id={$item->bloginID}&is_suoding=1" onclick="return confirm('确定要锁定此业务员的账号吗?')">锁定</a></span>
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
