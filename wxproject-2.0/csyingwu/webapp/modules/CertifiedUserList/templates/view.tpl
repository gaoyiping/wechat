<html>
<head>
    <title>会员详细信息</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link type="text/css" rel="stylesheet" href="modpub/css/base.css"/>



</head>
<body background="#ffffff" scroll="yes">

<br />
<form name="form1" method="post">

    <table width="96%" align="center"  border="0" cellpadding="1" cellspacing="1" >

        <tr>
            <td class="table_body table_body_NoWidth">会员编号：</td>
            <td class="table_none table_none_NoWidth">{$userinfo->user_id}
            </td>

            <td   class="table_body table_body_NoWidth">推荐编号：</td>
            <td class="table_none table_none_NoWidth">
                {$userinfo->pid}
            </td>



        </tr>

        <tr>
            <td class="table_body table_body_NoWidth">微信名称：</td>
            <td class="table_none table_none_NoWidth">
                {$userinfo->wxname}
            </td>
            <td   class="table_body table_body_NoWidth">性别：</td>
            <td class="table_none table_none_NoWidth">


                <font color="#116600">{if $userinfo->sex==2} 女{/if}</font>
                <font color="#1166FF">{if  $userinfo->sex==1} 男{/if}</font>

            </td>


        </tr>

        <tr>
            <td class="table_body table_body_NoWidth">会员名称：</td>
            <td class="table_none table_none_NoWidth">
                {$userinfo->user_name}
            </td>
            <td   class="table_body table_body_NoWidth">会员等级：</td>
            <td class="table_none table_none_NoWidth">

                <font color="#116600">{if $userinfo->uplevel==0} 见习小二{/if}</font>
                    <font color="#1166FF">{if  $userinfo->uplevel==1} 店小二{/if}</font>
                    {*<font color="#1166FF">{if  $userinfo->uplevel==6} 伙计{/if}</font>*}
                    <font color="#966F12">{if $userinfo->uplevel==2} 掌柜{/if}</font>
                    <font color="#C40D74">{if  $userinfo->uplevel==3} 东家{/if}</font>
                    <font color="#C40D74">{if  $userinfo->uplevel==4} 富豪{/if}</font>
                     <font color="#C40D74">{if  $userinfo->uplevel==5} 大富豪{/if}</font>

            </td>


        </tr>

        <tr>
            <td class="table_body table_body_NoWidth">联系电话：</td>
            <td class="table_none table_none_NoWidth">{$userinfo->mobile}
            </td>
            <td   class="table_body table_body_NoWidth">邮箱：</td>
            <td class="table_none table_none_NoWidth">
                {$userinfo->e_mail}
            </td>


        </tr>

        <tr>
            <td class="table_body table_body_NoWidth">身份证号：</td>
            <td class="table_none table_none_NoWidth" >
                {$userinfo->idno}
            </td>
            <td   class="table_body table_body_NoWidth">所在区域：</td>
            <td class="table_none table_none_NoWidth">
                {$userinfo->s1}{$userinfo->s2}{$userinfo->s3}
            </td>


        </tr>

        <tr>
            <td class="table_body table_body_NoWidth">银行开户名：</td>
            <td class="table_none table_none_NoWidth">
                {$userinfo->card_name}</td>
            <td   class="table_body table_body_NoWidth">开户银行：</td>
            <td class="table_none table_none_NoWidth">
                {$userinfo->card_type}
            </td>


        </tr>
        <tr>
            <td class="table_body table_body_NoWidth">银行开户账号：</td>
            <td class="table_none table_none_NoWidth" colspan=3>
                {$userinfo->card_number} </td>

        </tr>
        <tr>
            <td class="table_body table_body_NoWidth">银行开户地址：</td>
            <td class="table_none table_none_NoWidth" colspan=3>
                {$userinfo->provcity} </td>
        </tr>
        

        <tr>
            <td class="table_body table_body_NoWidth">物流送货地址：</td>
            <td class="table_none table_none_NoWidth" colspan=3>
                {$userinfo->address}
            </td>
        </tr>





    </table>
    <br />





</form>
<DIV align="center" id="dayinDiv" name="dayinDiv"><input type="button" class="b02" value=" 关闭 " onclick="window.parent.hidePopWin(true);" />
</DIV>
</body>
</html>
