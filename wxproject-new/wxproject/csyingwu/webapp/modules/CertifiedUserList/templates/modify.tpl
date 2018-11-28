<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>会员列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="modpub/js/check.js"> </script>
    <script type="text/javascript" src="modpub/js/userinfo_check.js"> </script>
    <script type="text/javascript" src="modpub/js/ajax.js"> </script>
</head>
<body scroll="yes">
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
                <input type="text" class="button1" name="pid" value="{$userinfo->pid}"/>
             </td>
        </tr>

        <tr>
            <td class="table_body">会员编号：</td>
            <td class="table_none"><font color="#A63821">{$userinfo->user_id}</td>
        </tr>
        <tr>
            <td class="table_body">微信名称：</td>
            <td class="table_none"><input type="text" class="button1" value="{$userinfo->wxname}" readonly/></td>
        </tr>
        <tr>
            <td class="table_body">会员类型：</td>
            <td class="table_none">
                <font color="#116600">{if $userinfo->uplevel==0} 见习店小二{/if}</font>
                <font color="#1166FF">{if  $userinfo->uplevel==1} 店小二{/if}</font>
                <font color="#1166FF">{if  $userinfo->uplevel==6} 伙计{/if}</font>
                <font color="#1166FF">{if  $userinfo->uplevel==7} 管家{/if}</font>
                <font color="#966F12">{if $userinfo->uplevel==2} 掌柜{/if}</font>
                <font color="#C40D74">{if  $userinfo->uplevel==3} 东家{/if}</font>
                <font color="#C40D74">{if  $userinfo->uplevel==4} 富豪{/if}</font>
                <font color="#C40D74">{if  $userinfo->uplevel==5} 大富豪{/if}</font>
            </td>
        </tr>
        <tr>
            <td class="table_body">升级等级：</td>
            <td class="table_none">
                <select id="select-uplevel" name="uplevel">
                    <option value="-1" >请选择等级</option>
                    <option value="0" >见习店小二</option>
                    <option value="1" >店小二</option>
                    <option value="6" >伙计</option>
                    <option value="7" >管家</option>
                    <option value="2" >掌柜</option>
                    <option value="3" >东家</option>
                     <option value="4" >富豪</option>
                     <option value="5" >大富豪</option>
                </select>

            </td>
        </tr>
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
