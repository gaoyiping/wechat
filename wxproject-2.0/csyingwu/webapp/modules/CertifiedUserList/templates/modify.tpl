<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>会员列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="modpub/js/check.js"> </script>
    <script type="text/javascript" src="modpub/js/userinfo_check.js"> </script>
    <script type="text/javascript" src="modpub/js/ajax.js"> </script>

    {literal}
        <script type="text/javascript">
            function resetpwd(grade){
                var f = document.form1;
                f.action = "index.php?module=CertifiedUserList&action=resetpwd&grade="+grade;
                f.submit();
            }


            function Init()
            {

                var   dropElement1=document.getElementById("Select1");
                var   dropElement2=document.getElementById("Select2");
                var   dropElement3=document.getElementById("Select3");
                RemoveDropDownList(dropElement1);
                RemoveDropDownList(dropElement2);
                RemoveDropDownList(dropElement3);

                var country;
                var province;
                var city;
                var url = "index.php?module=CertifiedUserList&action=ajax&GroupID=0";
                ajax(url,function(text){
                    var strs= new Array();
                    strs=text.split("|");
                    for(var i=0; i<strs.length-1;   i++)
                    {
                        var opp= new Array();
                        opp=String(strs[i]).split(",");


                        var   eOption=document.createElement("option");
                        eOption.value=opp[1];
                        eOption.text=opp[0];
                        dropElement1.add(eOption);

                    }

                });

            }

            function   selectCity()
            {
                var   dropElement1=document.getElementById("Select1");
                var   dropElement2=document.getElementById("Select2");
                var   dropElement3=document.getElementById("Select3");
                var   name=dropElement1.value;

                RemoveDropDownList(dropElement2);
                RemoveDropDownList(dropElement3);

                if(name!="")
                {

                    var url = "index.php?module=CertifiedUserList&action=ajax&GroupID="+name;

                    ajax(url,function(text){
                        var strs= new Array();
                        strs=text.split("|");
                        for(var i=0; i<strs.length-1;   i++)
                        {
                            var opp= new Array();
                            opp=String(strs[i]).split(",");


                            var   eOption=document.createElement("option");
                            eOption.value=opp[1];
                            eOption.text=opp[0];
                            dropElement2.add(eOption);

                        }

                    });
                }
            }

            function   selectCountry()
            {

                var   dropElement1=document.getElementById("Select1");
                var   dropElement2=document.getElementById("Select2");
                var   dropElement3=document.getElementById("Select3");
                var   name=dropElement2.value;


                RemoveDropDownList(dropElement3);

                if(name!="")
                {

                    var url = "index.php?module=CertifiedUserList&action=ajax&GroupID="+name;

                    ajax(url,function(text){
                        var strs= new Array();
                        strs=text.split("|");
                        for(var i=0; i<strs.length-1;   i++)
                        {
                            var opp= new Array();
                            opp=String(strs[i]).split(",");


                            var   eOption=document.createElement("option");
                            eOption.value=opp[1];
                            eOption.text=opp[0];
                            dropElement3.add(eOption);

                        }

                    });
                }
            }

            function   RemoveDropDownList(obj)
            {
                if(obj)
                {
                    var   len=obj.options.length;
                    if(len>0)
                    {
                        //alert(len);
                        for(var   i=len;i>=1;i--)
                        {
                            obj.remove(i);
                        }
                    }
                }

            }

        </script>
    {/literal}

</head>


<body scroll="yes" onload="Init();">

<div class="place">
    <ul class="placeul">
        <li><a href="#">[会员管理]</a></li>
        <li><a href="#">会员资料修改</a></li>
    </ul>
</div>



<form name="form1" action="index.php?module=CertifiedUserList&action=modify"
      method="post" onsubmit="return bind_check(this);" enctype="multipart/form-data">
    <input type='hidden' name="id" value="{$userid}" />
    <br />
    <table width="80%" border='0' cellpadding=4 cellspacing=1 align="center">

        <tr class="tdTitle"  >
            <td height="25" align="center" colspan=2>
                <font color="#141414" > 会员 {$userid}资料修改 </font></td>
        </tr>
        <tr>
            <td class="table_body">推荐编号：</td>
            <td class="table_none">
                <input type="text" class="button1" name="pid" value="{$userinfo->pid}" readonly/>
             </td>
        </tr>

        <tr>
            <td class="table_body">会员编号：</td>
            <td class="table_none"><font color="#A63821">{$userinfo->user_id}</td>
        </tr>



        <tr>
            <td class="table_body">会员类型：</td>
            <td class="table_none">
                <font color="#116600">{if $userinfo->uplevel==0} 见习小二{/if}</font>
                <font color="#1166FF">{if  $userinfo->uplevel==1} 店小二{/if}</font>
                {*<font color="#1166FF">{if  $userinfo->uplevel==6} 伙计{/if}</font>*}
                <font color="#966F12">{if $userinfo->uplevel==2} 掌柜{/if}</font>
                <font color="#C40D74">{if  $userinfo->uplevel==3} 东家{/if}</font>
                <font color="#C40D74">{if  $userinfo->uplevel==4} 富豪{/if}</font>
                <font color="#C40D74">{if  $userinfo->uplevel==5} 大富豪{/if}</font>
                <input type="hidden" name="oldlevel" value="{$userinfo->uplevel}" />
            </td>
        </tr>

        <tr>
            <td class="table_body">升级等级：</td>
            <td class="table_none">
                <select name="uplevel">
                    <option value="-1" >请选择等级</option>
                    <option value="1" >店小二</option>
                     {*<option value="6" >伙计</option>*}
                    <option value="2" >掌柜</option>
                    <option value="3" >东家</option>
                     <option value="4" >富豪</option>
                     <option value="5" >大富豪</option>
                </select>

            </td>
        </tr>



        <tr>
            <td class="table_body">微信名称：</td>
            <td class="table_none"><input type="text" class="button1" name="wxname" value="{$userinfo->wxname}"/></td>
        </tr>

        <tr>
            <td class="table_body">会员名称：</td>
            <td class="table_none"><input type="text" class="button1" name="username" value="{$userinfo->user_name}"/></td>
        </tr>
        <tr>
            <td class="table_body">邮箱：</strong></td>
            <td class="table_none"><input type="text" class="button1" name="email" value="{$userinfo->e_mail}"/>
                <span id="span_email"> </span></td>
        </tr>

        <tr>
            <td class="table_body">所在区域：</strong></td>
            <td class="table_none">{$userinfo->s1}{$userinfo->s2}{$userinfo->s3}
                <input type="hidden" name="sheng" value="{$userinfo->sheng}" />
                <input type="hidden" name="shi" value="{$userinfo->shi}" />
                <input type="hidden" name="xian" value="{$userinfo->xian}" />
                <span id="span_email"> </span></td>
        </tr>

        </tr>
        <tr>
            <td class="table_body">区域变更：</strong></td>
            <td class="table_none">
                <select id="Select1" name="Select1" onchange="selectCity();">
                    <option value="0" selected="true">省/直辖市</option>
                </select>
                <select id="Select2" name="Select2" onchange="selectCountry()">
                    <option value="0" selected="true">请选择</option>
                </select>
                <select id="Select3" name="Select3" >
                    <option value="0" selected="true">请选择</option>
                </select>
                <span id="span_email"> </span></td>
        </tr>


        <tr>
            <td class="table_body">身份证号：</td>
            <td class="table_none"><input type="text" class="button1" name="idno" value="{$userinfo->idno}"/></td>
        </tr>

        <tr>
            <td class="table_body">联系电话：</td>
            <td class="table_none"><input type="text" class="button1" name="mobile" value="{$userinfo->mobile}"/>
                <font color=red>*联系电话必须填写！</font></td>
        </tr>
        <tr>
            <td class="table_body">银行开户名：</td>
            <td class="table_none"><input type="text" class="button1" name="cardname" value="{$userinfo->card_name}"/></td>
        </tr>
        <tr>
            <td class="table_body">银行帐号：</td>
            <td class="table_none"><input type="text" class="button1" name="cardnumber" value="{$userinfo->card_number}"/>
                <span id="span_cardnumber"> </span></td>
        </tr>
        <tr>
            <td class="table_body">开户银行：</td>
            <td class="table_none"><input type="text" class=button1 name="cardtype" value="{$userinfo->card_type}"/></td>
        </tr>
        <tr>
            <td class="table_body">开户行所在省市：</td>
            <td class="table_none"><input name='provcity' type="text" class="button1" value="{$userinfo->provcity}"></td>
        </tr>


        <tr>
            <td class="table_body">物流送货地址：</td>
            <td class="table_none"><textarea cols="35" rows="4" class="button1" name="address">{$userinfo->address}</textarea></td>
        </tr>

        
        <tr>
            <td colspan="2" align="center">
                <input  type="button" value="重置一级密码" onclick="resetpwd(1);" class="scbtn" style="width:100px;" />
                <input type="button" value="重置二级密码" onclick="resetpwd(2);" class="scbtn" style="width:100px;" />
                <input  type="button" value="重置所有密码" onclick="resetpwd(3);" class="scbtn" style="width:100px;" /></td>
        </tr>
        <br />
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
