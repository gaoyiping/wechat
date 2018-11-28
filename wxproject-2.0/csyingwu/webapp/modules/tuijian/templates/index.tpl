<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>推荐会员</title>
    <link href="/new_style/css/style.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="modpub/js/ajax.js"> </script>
    <script type="text/javascript" src="/FineMessBox/js/common.js"></script>
    <script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>

    <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />


    {literal}
        <script language="JavaScript" >
            function AlertMessageBox()
            {



            }
            function Showopen(userid)
            {

                showPopWin('查看会员信息',"index.php?module=CertifiedUserList&action=view&userid="+userid, 600, 400, AlertMessageBox,true,true)
            }


            function ShowMenu(img,MenuID,width)
            {

                if(document.getElementById("Menu"+MenuID).style.display=="none")
                {
                    document.getElementById("Menu"+MenuID).style.display="";
                    img.src="../new_style/images/expand.gif";
                    document.getElementById("1Menu"+MenuID).src="../new_style/images/foldopen_1.gif";
                    document.getElementById("Menu"+MenuID).innerHTML="&nbsp;&nbsp;&nbsp;正在加载!";
                    var url = "index.php?module=tuijian&action=ajax&GroupID="+MenuID+"&width="+width;

                    ajax(url,function(text){
                        arr=text.split("[&]");

                        document.getElementById("Menu"+MenuID).innerHTML=arr[0];
                    });

                }
                else
                {
                    document.getElementById("Menu"+MenuID).style.display="none";
                    img.src="../new_style/images/collspand.gif";
                    document.getElementById("1Menu"+MenuID).src="../new_style/images/foldclose.gif";
                }
            }





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

                    <div class="place">
                        <ul class="placeul">
                            <li><a href="#">[店铺管理]</a></li>
                            <li><a href="#">推荐关系图</a></li>
                        </ul>
                    </div>

                    <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                         id="Div_Content"><br/>
                        <form name="form1" action="index.php" method="get">
                            <input type="hidden" name="module" value="tuijian" />
                            <table align="center"  border="0" cellpadding="0" cellspacing="0" width="98%"><tr><td>




          


                                        <input type="text" style="width:20px; height:20px;background-color:#116600" /> 见习小二
                                        <input type="text" style="width:20px; height:20px;background-color:#1166FF" /> 店小二
                                        <input type="text" style="width:20px; height:20px;background-color:#966F12" /> 掌柜
                                        <input type="text" style="width:20px; height:20px;background-color:#C40D74" /> 东家
                                        <input type="text" style="width:20px; height:20px;background-color:#C40D74" /> 富豪
                                        <input type="text" style="width:20px; height:20px;background-color:#C40D74" /> 大富豪
                                    </td></tr></table>

                            <div style="margin-top:10px;padding:10px;height:30px; width:100%;border-bottom:solid 1px #dedede; height:38px;border-top:solid 1px #dedede; border-left:solid 1px #fff;border-right:solid 1px #fff; ">
                                会员账号：<input type="text" name="userid" class='scinput_s' value="{$userid}" style="width:100px;" />       <input class="scbtn"  type="submit" value="查 询"   /> <font color="red">注:点击会员账号可以查看详细信息</font></div>
                        </form>
                        <br />
                        <div style="padding-left:50px;">
                            {$userlist_str}
                            <div id="pid_error"></div>
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
