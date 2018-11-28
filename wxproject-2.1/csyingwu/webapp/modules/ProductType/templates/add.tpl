<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>添加商品分类</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="modpub/js/check.js" > </script>

    {literal}
        <script type="text/javascript">
            function check(f){
                if(Trim(f.pname.value)==""){
                    alert("产品分类名称不能为空！");
                    f.pname.value = '';
                    return false;
                }
                if(Trim(f.cost.value)==""){
                    alert("分类排序号不能为空！");
                    f.cost.value = '';
                    return false;
                }
                f.cost.value = Trim(f.cost.value);
                if(!/^(([1-9][0-9]*)|0)(\.[0-9]{1,2})?$/.test(f.cost.value)){
                    alert("产品排序号必须为数字，且格式为 ####.## ！");
                    f.cost.value = '';
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
        <li><a href="#">产品分类管理</a></li>
        <li><a href="#">添加分类</a></li>
    </ul>
</div>



<form action="index.php?module=ProductType&action=add" method="post" onsubmit="return check(this);">
    <table width="80%" border='0' cellpadding=4 cellspacing=1 align="center">

        <tr class="tdTitle"  >
            <td height="25" align="center" colspan=2>
                <font color="#141414" > 添加产品分类 </font></td>
        </tr>

        <tr>
            <td class="table_body">名称：</strong></td>
            <td class="table_none"> <input name="pname" type="text" style="height:24px;"  class="button1" value="{$pname}"/></td>
        </tr>

        <tr>
            <td class="table_body">类型：</td><td  class="table_none">
                <select name="ttype">
                    <option selected value="1">
                        注册/零售
                    </option>

                    <option  value="2">
                        VIP升级
                    </option>
                    <option  value="3">
                        重复消费
                    </option>
                </select></td> </tr>

        <tr>
            <td class="table_body">排序号：</td>   <td  class="table_none">
                <input name="cost" type="text" style="width:200px; height:24px;ime-mode:disabled" class="button1" value="100" /></td> </tr>

        <tr>
            <td class="table_body">背景色：</td>   <td  class="table_none">
                <input name="bgcolor" type="text" style="width:200px; height:24px;ime-mode:disabled" class="button1" value="ffffff"/> 建议色值 1: EBF5FD 2: E4E9FF 3: D0F1FE 4: E2FEFA</td></tr>


        <tr>
            <td colspan="2" align="center">
                <input  type="submit" value=" 提 交 " class="scbtn"/> &nbsp; &nbsp; &nbsp;
                <input  type="reset"  value=" 返 回 " class="scbtn" onclick="window.location.href='index.php?module=CertifiedUserList';" />
            </td>
        </tr>
    </table>
</form>

</body>

</html>
