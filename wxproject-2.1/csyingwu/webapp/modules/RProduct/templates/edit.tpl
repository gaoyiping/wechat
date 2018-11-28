<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>添加零售商品</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />

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

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[管理中心]</a></li>
        <li><a href="#">产品管理</a></li>
        <li><a href="#">修改产品信息</a></li>
    </ul>
</div>


<form action="index.php?module=RProduct&action=edit" method="post" onsubmit="return check(this);"  enctype="multipart/form-data">
    <input type="hidden" name="id" value="{$id}" />
    <input type="hidden" name="editable" value="true" />
    <br />
    <table width="80%" border='0' cellpadding=4 cellspacing=1 align="center">
        <tr class="tdTitle"  >
            <td height="25" align="center" colspan=2>
                <font color="#141414" > 修改产品信息 </font></td>
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
            <td class="table_body">原价：</td>
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
        <tr><td class="table_body">会员价：</td> <td  class="table_none">

                <input name="zhuanmaijia" class="button1"  type="text" style="width:100px;ime-mode:disabled" value="{$zhuanmaijia}"/> ￥</td>
        </tr>

        <tr ><td class="table_body">PV：</td> <td  class="table_none">

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

                <input name="tixingshu" class="button1" type="text" style="width:100px;ime-mode:disabled" value="{$tixingshu}"/> 产品少于某个数字时 显示红色</td>
        </tr>
        <tr><td class="table_body">库存：</td> <td  class="table_none">
                <input name="good_number" type="text" class="button1"  style="width:100px;ime-mode:disabled" value="{$good_number}"/></td>
        <tr><td class="table_body">新品推荐：</td> <td  class="table_none">
		<label><input type="radio"  name="recommend" value='0' {if $isrec==0}checked{/if}>否</label>
		<label><input type="radio"  name="recommend" value='1' {if $isrec==1}checked{/if}>是</label>
          </td>
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


        <tr>
            <td colspan="3" align="center">
                <input  type="submit" value=" 提 交 " class="scbtn"/> &nbsp; &nbsp; &nbsp;
                <input  type="reset"  value=" 重 填 " class="scbtn">&nbsp;&nbsp;&nbsp;
                <input  type="button" value=" 返 回 " class="scbtn" onclick="location.href='index.php?module=RProduct';">
            </td>
        </tr>
    </table>
</form>

</body>

</html>
