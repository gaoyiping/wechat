<html>
<head>
<title>修改零售产品</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="modpub/css/base.css" />
<script type="text/javascript" src="modpub/js/check.js" > </script>

{literal}
<script type="text/javascript">
function check(f){	
  if(Trim(f.sNo.value)==""){
    alert("产品编号不能为空！");
   
    return false;
  }



  if(Trim(f.pname.value)==""){
    alert("产品名称不能为空！");
    f.pname.value = '';
    return false;
  }


  if(Trim(f.qidingnum.value)==""){
    alert("起订数不能为空！");
  
    return false;
  }

    f.qidingnum.value = Trim(f.qidingnum.value);
   if(!/^(([1-9][0-9]*)|0)(\.[0-9]{1,2})?$/.test(f.qidingnum.value)){
    alert("起订数必须为数字，且格式为 ####.## ！");
    f.qidingnum.value = '';
    return false;
  }



  if(Trim(f.zhuanmaijia.value)==""){
    alert("售价不能为空！");
  
    return false;
  }

    f.zhuanmaijia.value = Trim(f.zhuanmaijia.value);
   if(!/^(([1-9][0-9]*)|0)(\.[0-9]{1,2})?$/.test(f.zhuanmaijia.value)){
    alert("售价货价必须为数字，且格式为 ####.## ！");
    f.zhuanmaijia.value = '';
    return false;
  }







  return true;
}
</script>
{/literal}
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />

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
                                &nbsp;<span class="Font_red Font_addbold">[管理中心]</span> >> 产品管理 >> 修改产品信息
                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br /><br/>


<form action="index.php?module=RProduct&action=edit" method="post" onsubmit="return check(this);"  enctype="multipart/form-data">
<input type="hidden" name="id" value="{$id}" />
<input type="hidden" name="editable" value="true" />
<table align="center"  border="0" cellpadding="0" cellspacing="0" width="90%">
  <tr><td>
  
      <td align="left">
      <table cellspacing="1" cellpadding="1" width="100%">
       <tr class="tdTitle" > 
      <td height="25" align="center" colspan=2> 
        <font color="#ffffff" > 修改产品信息 </font></td>
    </tr>
    <tr>
        <td class="table_body">产品编号：</td>
        <td  class="table_none">   <input name="sNo" class="button1"  type="text" style="width:120px;" value="{$sNo}"/> 注：编号以CP开头 如CP0001 </td>
	</tr>
	
    <tr>
        <td class="table_body">产品名称：</td>
        <td  class="table_none">   <input name="pname" class="button1"  type="text" style="width:200px;" value="{$pname}"/> </td>
	</tr>
	  <tr><td class="table_body">产品类别：</td> <td  class="table_none">  <select id="tbtype" name="tbtype">
        <option selected="selected" value="0">请选择类别</option>
         {foreach from=$rtype item=item name=f1}
   <option  value="{$item->tID}"     {if $item->tID==$typeID} selected="selected" {else}{/if} >{$item->tname}</option>
	  {/foreach}
    </select>
    </select>
	
</td>
	</tr>
 <tr><td class="table_body">单位：</td> <td  class="table_none">
	
 <select name="danwei">
 <option {if $danwei=="盒"}selected{/if} value="盒">
 盒
 </option>
 <option {if $danwei=="篓"}selected{/if} value="篓">
 篓
 </option>
  <option {if $danwei=="箱"}selected{/if} value="箱">
 箱
 </option>
 <option {if $danwei=="盒"}selected{/if} value="盒">
 盒
 </option>
  <option {if $danwei=="个"}selected{/if} value="个">
 个
 </option>
  <option {if $danwei=="套"}selected{/if} value="套">
 套
 </option>
   <option {if $danwei=="包"}selected{/if} value="包">
 包
 </option>
    <option {if $danwei=="支"}selected{/if} value="支">
 支
 </option>
    <option {if $danwei=="条"}selected{/if} value="条">
 条
 </option>
     <option {if $danwei=="根"}selected{/if} value="根">
 根
 </option>
  <option {if $danwei=="本"}selected{/if} value="本">
 本
 </option>
   <option {if $danwei=="瓶"}selected{/if} value="瓶">
 瓶
 </option>
  <option {if $danwei=="块"}selected{/if} value="块">
 块
 </option>
 <option {if $danwei=="片"}selected{/if} value="片">
 片
 </option>
 <option {if $danwei=="把"}selected{/if} value="把">
 把
 </option>
 </select></td>
	</tr>
	 <tr>
        <td class="table_body">产品规格：</td>
        <td  class="table_none">   <input name="guige" class="button1"  type="text" style="width:200px;" value="{$guige}"/>  </td>
	</tr>
	 <tr>
        <td class="table_body">装箱数：</td>
        <td  class="table_none">   <input name="zhuangxiangshu" class="button1"  type="text" style="width:100px;" value="{$zhuangxiangshu}"/>  </td>
	</tr>
	 <tr>
        <td class="table_body">起订数：</td>
        <td  class="table_none">   <input name="qidingnum" class="button1"  type="text" style="width:100px;" value="{$qidingnum}"/>  </td>
	</tr>
	<tr style="display:none;"><td class="table_body">建议销售价：</td> <td  class="table_none">
	
           <input name="jianyijia" class="button1"  type="text" style="width:100px;ime-mode:disabled" value="{$jianyijia}"/> ￥</td>
	</tr>
         <tr><td class="table_body">价格：</td> <td  class="table_none">
	
           <input name="zhuanmaijia" class="button1"  type="text" style="width:100px;ime-mode:disabled" value="{$zhuanmaijia}"/> ￥</td>
	</tr>
	
	<tr ><td class="table_body">PV值：</td> <td  class="table_none">
	
           <input name="jifen" class="button1"  type="text" style="width:100px;ime-mode:disabled" value="{$jifen}"/></td>
	</tr>
	
	  <tr><td class="table_body">产品折扣：</td> <td  class="table_none">
	
           <input name="zhekou" class="button1"  type="text" style="width:100px;ime-mode:disabled" value="{$zhekou}"/> % 代理折扣 默认为100%</td>
	</tr>
	
	<tr ><td class="table_body">产品利润：</td> <td  class="table_none">
	
           <input name="lirun" class="button1"  type="text" style="width:100px;ime-mode:disabled" value="{$lirun}"/> ￥</td>
	</tr>
	
	 <tr><td class="table_body">排序号：</td> <td  class="table_none">
	
           <input name="sorder" class="button1"  type="text" style="width:100px;ime-mode:disabled" value="{$sorder}"/></td>
	</tr>
	 <tr><td class="table_body">剩余数量提醒：</td> <td  class="table_none">

           <input name="tixingshu" type="text" style="width:100px;ime-mode:disabled" value="{$tixingshu}"/> 产品少于某个数字时 显示红色</td>
	</tr>
	   <tr><td class="table_body">启用状态：</td> <td  class="table_none">
	    
    <select name="isdelete">
 <option {if $isdelete==0}selected{/if} value="0">
 启用
 </option>
  <option {if $isdelete==1}selected{/if} value="1">
 禁用
 </option>
 </select></td>
	</tr>
	   <tr><td class="table_body">产品图片：</td> <td  class="table_none">
	<input type="file" class="button1"  name="photo_dir" size="15" accept="upload_image/x-png,image/gif,image/jpeg">  注意图片名称请不要带中文。

</td>
	</tr>
        <tr><td class="table_body">产品描述：</td> <td  class="table_none">
	 {php}
			$fckroot = './fckeditor/';
            include($fckroot . 'fckeditor.php');
            $fck = new FCKeditor('detail') ;
            $fck->BasePath = $fckroot;
            $fck->ToolbarSet = 'Default';
            $fck->Height='350px';
            $fck->Value=$this->_tpl_vars['detail'];
            $fck->Create();  
          {/php}
      </td>
	</tr>
	</table>
        <p align="center" style="padding-top:10px;"> 
          <input type="submit" value="提 交" class="b02">
          &nbsp;&nbsp;&nbsp; 
          <input type="reset"  value="重 填" class="b02">
          &nbsp;&nbsp;&nbsp; 
          <input type="button" value="返 回" class="b02" onclick="location.href='index.php?module=RProduct';">
        </p><br />
     
  </td></tr></table>
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
    </div>
    <script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>
</html>
