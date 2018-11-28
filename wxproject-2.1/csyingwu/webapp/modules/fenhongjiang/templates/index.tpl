<html>
<head>
<title>结算奖金</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link type="text/css" rel="stylesheet" href="modpub/css/base.css"/>
<link href="/new_style/css/style.css" rel="stylesheet" type="text/css"/>
<link href="/new_style/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/new_style/js/jquery.js"></script>
{literal}
<script type="text/javascript">
function ok() {
	if (confirm('确定要结算本期奖金吗？')) {
		$(".textmode").html('<img src="/new_style/images/loading_circle.gif"/> 结算中请稍候...');
		$("#jsbutton").hide();
		return 1;
	}
	return 0;
}
</script>
{/literal}
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
<link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
</head>
<body scroll="yes">
	<div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
		<table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">
                        <div class="place">
	                        <ul class="placeul">
	                            <li><a href="#">[店铺管理]</a></li>
	                            <li><a href="#">商城分红</a></li>
	                        </ul>
	                    </div>
                        <div style="width: 100%; padding:5px; height: auto !important; overflow: visible" id="Div_Content">
                        	<div id="ctl00_ContentPlaceHolder1_UpdatePanel1" style="width:100%;text-align:center;">
                        		<br/><br/><br/><br/>
                        		<div class="YFT_fenhongjiang_bg" style="padding-top:45px;" id="div1">
                                    <br/>
                        			<form method="post" action="">
                        				<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0" id="table1">
                        					<tr><td style="padding-left: 230px; padding-top: 4px;">
                        						上期期数：{$Paper->sNo}期
                        					</td></tr>
                        					<tr><td style="padding-left: 230px; padding-top: 4px;">
                        						结算日期：{$Paper->add_date}
                        					</td></tr>
                        					<tr><td style="padding-left: 230px; padding-top: 4px;"><span class="textmode">
                        						本期业绩：{$Money->count}积分
                        					</span></td></tr>
                        					<tr><td style="padding-left: 230px; padding-top: 4px;font-weight:bold;">
                        						掌柜总数：{$Total2->count}人。
                        					</td></tr>
                        					<tr><td style="padding-left: 230px; padding-top: 4px;font-weight:bold;">
                        						东家总数：{$Total3->count}人。
                        					</td></tr>
                        					<tr><td style="padding-left: 230px; padding-top: 4px;font-weight:bold;">
                        						富豪总数：{$Total4->count}人。
                        					</td></tr>
                        					<tr><td style="padding-left: 230px; padding-top: 4px;font-weight:bold;">
                        						大富豪总数：{$Total5->count}人。
                        					</td></tr>
                        					<tr>
                        						<td height="25" style="padding-top: 10px; padding-left: 230px;" >
                        							掌柜：<input type="text" name="Normal2" value="0" /> 元/人<br/>
                        							<br/>
                        							东家：<input type="text" name="Normal3" value="0" /> 元/人<br/>
                        							<br/>
                        							富豪：<input type="text" name="Normal4" value="0" /> 元/人<br/>
                        							<br/>
                        							大富豪：<input type="text" name="Normal5" value="0" /> 元/人<br/>
                        							<br/>
                        							二级密码： <input type="password" name="password" class="button1">
                        						</td>
                        					</tr>
                                            <tr>
                                                <td height="25" style="padding-top: 20px; padding-left: 230px;" >
                                                    <input type="hidden" name="sNo" value="{$Paper->sNo+1}"/>
                                                    <span id="jsbutton"><input type="submit" value="本期奖金结算" onclick="return ok();" class="b02" /></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                    </td>
                                </tr>
                            </table>
                            <br />
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="YFTmainright_r3_c2_gj" height="1"></td>
    </tr>
</tbody>
</table>
</div>
<script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>
</html>
